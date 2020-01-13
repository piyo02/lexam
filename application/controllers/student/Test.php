<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends Student_Controller {
	private $user_id = null;
	private $services = null;
    private $name = null;
    private $parent_page = 'student';
	private $current_page = 'student/test/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Test_services');
		$this->services = new Test_services;
		$this->load->model(array(
			'test_model',
			'question_model',
			'question_answer_model',
			'questionnaire_model',
			'question_reference_model',
			'student_profile_model',
			'solve_test_model',
			'student_answer_model',
			'test_result_model',
		));
		$this->data[ "menu_list_id" ] =  'test_index';
		$this->user_id = $this->session->userdata('user_id');
	}

	public function index()
	{
		$student = $this->student_profile_model->student_profile( $this->user_id )->row();

		#################################################################3
		$table = $this->services->get_table_config( $this->current_page );
		$table[ "rows" ] = $this->test_model->test_by_classroom_id( $student->classroom_id, $student->school_id )->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Ulangan";
		$this->data["header"] = "Daftar Ulangan";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "student/test" );
	}

	public function solve()
	{
		$test_id = $this->input->post( 'id' );
		
		//session test id
		$session['test_id'] = $test_id;
		$this->session->set_userdata( $session );
		
		// apakah siswa sudah pernah mengerjakan atau belum
		$solve_test = $this->solve_test_model->solve_test_by_student_id( $test_id, $this->user_id )->row();
		if( $solve_test ){
			redirect('student/test/test');
		}

		// input db solve test siswa
		$solve_test = [
			'user_id' => $this->user_id,
			'test_id' => $test_id,
			'time_start' => time(),
		];
		// die;
		$solve_id = $this->solve_test_model->create( $solve_test );
		
		// mendapatkan questionnaire_id dari test
		$references = $this->question_reference_model->question_reference_by_test_id( $test_id )->result();
		
		$lists_mc = []; //multiple choice (mc)
		$lists_sa = []; //short answer (sa)
		$lists_es = []; //essay (es)

		foreach ($references as $key => $reference) {
			$total = $this->question_reference_model->get_total_references( $test_id, $reference->questionnaire_id )->row();
			$lists_mc = array_merge($lists_mc, $this->question_answer_model->question_id_mc( $reference->questionnaire_id, $total->multiple_choice )->result()); 
			$lists_sa = array_merge($lists_sa, $this->question_answer_model->question_id_sa( $reference->questionnaire_id, $total->short_answer )->result()); 
			$lists_es = array_merge($lists_es, $this->question_answer_model->question_id_es( $reference->questionnaire_id, $total->essay )->result()); 
		}

		// merge lists
		$questions = array_merge( $lists_mc, $lists_sa );
		$questions = array_merge( $questions, $lists_es );

		foreach ($questions as $key => $question) {
			$data[] = array(
				'user_id' => $this->user_id,
				'test_id' => $test_id,
				'question_id' => $question->id,
			);
		}
		$this->student_answer_model->create( $data );

		redirect('student/test/test');
	}

	public function test(  )
	{
		$test_id = $this->session->userdata( 'test_id' );
		$test = $this->test_model->test( $test_id )->row();
		// die;
		
		// question in db which student will answer
		$lists_question = $this->student_answer_model->student_answer_by_test_id( $test_id, $this->user_id )->result();
		
		// data test student => time_start
		$solve_test = $this->solve_test_model->solve_test_by_student_id( $test_id, $this->user_id )->row();

		//question id and number of question
		if( null !== $this->input->get('id') ){
			
			$question_id = $this->input->get('id');

			$questions = $this->question_model->question( $question_id )->result();
			$number = $this->input->get('number');
		}else {
			// $question_id = 1;
			$question_id = $lists_question[0]->question_id;

			$questions = $this->question_model->question( $question_id )->result();
			$number = 1;
		}
		// var_dump( $test_id ); 
		
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["solve_test"] = $solve_test;
		$this->data["test"] = $test;
		$this->data["number"] = $number;
		// $this->data["total_questions"] = $total_questions;
		$this->data["questions"] = $questions;
		// var_dump($questions); die;
		$this->data[ "lists_question" ] = $lists_question;
		$this->render( "student/solve", 'test_master' );
		
	}

	public function answer()
	{
		$test_id = $this->session->userdata( 'test_id' );
		$question_id = $this->input->post( 'question_id' );
		$data_param = [
			'user_id' => $this->user_id,
			'test_id' => $test_id,
			'question_id' => $question_id,
		];
		
		$type_option = $this->input->post('type_option');

		if( $type_option == 'image' || $type_option == 'text'){
			$answer = $this->input->post('answer');
			
			$separate = strpos($answer, '-');
			$choice = substr($answer, ($separate + 1));
			$answer = substr($answer, 0, $separate);
		}else {
			$answer = $this->input->post('answer');
			$choice = '';
		}
		$data = array(
			'choice' => $choice,
			'answer' => $answer,
			'uncertain' => 0,
		);
		$student_answer = $this->student_answer_model->update( $data, $data_param );
		echo json_encode($data);
	}
	public function uncertain()
	{
		$test_id = $this->session->userdata( 'test_id' );
		$question_id = $this->input->post( 'question_id' );
		$data_param = [
			'user_id' => $this->user_id,
			'test_id' => $test_id,
			'question_id' => $question_id,
		];
		
		$type_option = $this->input->post('type_option');

		if( $type_option == 'image' || $type_option == 'text'){
			$answer = $this->input->post('answer');
			
			$separate = strpos($answer, '-');
			$choice = substr($answer, ($separate + 1));
			$answer = substr($answer, 0, $separate);
		}else {
			$answer = $this->input->post('answer');
			$choice = '';
		}
		$data = array(
			'choice' => $choice,
			'answer' => $answer,
			'uncertain' => 1,
		);
		$student_answer = $this->student_answer_model->update( $data, $data_param );
		echo json_encode($data);
	}

	public function assessment()
	{
		$test_id = $this->session->userdata( 'test_id' );
		$test = $this->test_model->test( $test_id )->row();
		
		$value = $this->check( $test->max_value );
		$data = [
			'user_id' 	 => $this->user_id,
			'test_id' => $test_id,
		];
		
		//hapus data kerja siswa
		if ( $solve_test = $this->solve_test_model->solve_test_by_student_id( $test_id, $this->user_id )->row() ) {
			
			$data_param['test_id'] = $test_id;
			$data_param['user_id'] = $this->user_id;
			
			// $this->solve_test_model->delete( $data_param );
		}
		
		$data['value'] = $value['value'];
		$this->test_result_model->create($data);
		
		$this->data["value"] = $value;
		$this->data["test"] = $test;

		//hapus session
		$this->session->unset_userdata('test_id');
		$this->render("student/test/confirm");
	}

	public function check( $max_value = 100 )
	{
		$test_id = $this->session->userdata('test_id');
		$data_param = [
			'test_id' => $this->session->userdata('test_id'),
			'user_id' => $this->user_id,
		];

		$answers = $this->student_answer_model->student_answer_by_test_id( $test_id, $this->user_id )->result();
		$value = 0;
		$correct = 0;
		foreach ($answers as $key => $answer) {
			if ($answer->choice) {
				$choice = $this->question_answer_model->question_answer( $answer->answer )->row();
				$skor = $choice->value;
				if ($skor)
				$correct++;
				$value += 1;
			} 
			else {
				$choice = $this->question_answer_model->question_answer_by_question_id( $answer->question_id )->row();
				if ($answer->answer == $choice->answer) {
					$skor = $choice->value;
					$correct++;
				} else {
					$skor = 0;
				}
				$value += $choice->value;
			}
			$data['skor'] = $skor;
			$data_param['id'] = $answer->id;
			$this->student_answer_model->update($data, $data_param);
		}
		$skor = $this->student_answer_model->get_skor( $this->user_id, $test_id )->row();
		$data = [
			'value' => $skor->skor / $value * $max_value,
			'correct' => $correct,
			'total_quest' => count($answers),
		];
		return $data;
	}
}
