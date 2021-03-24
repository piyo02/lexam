<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Result_test extends Teacher_Controller {
	private $user_id = null;
	private $services = null;
    private $name = null;
    private $parent_page = 'teacher';
	private $current_page = 'teacher/result_test/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Result_test_services');
		$this->load->library('services/Excel_services');
		$this->services = new Result_test_services;
		$this->excel = new Excel_services;
		$this->load->model(array(
			'group_model',
			'test_result_model',
			'test_model',
			'student_answer_model',
			'question_model',
			'question_answer_model',
			'question_reference_model',

		));
		$this->user_id = $this->session->userdata('user_id');
		$this->data['menu_list_id'] = 'result_test_index';
	}
	public function index()
	{
		$table = $this->services->get_table_config( $this->current_page );
		$table[ "rows" ] = $this->test_result_model->test_result_by_teacher_id( $this->user_id )->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Ulangan";
		$this->data["header"] = "Hasil Ulangan";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "templates/contents/plain_content" );
	}

	public function detail( $test_id )
	{
		$test = $this->test_model->test( $test_id )->row();
		
		#################################################################3
		$table = $this->services->get_table_result_config( $this->current_page );
		$table[ "rows" ] = $this->test_result_model->test_result_by_test_id( $test_id )->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;

		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Hasil Ulangan";
		$this->data["header"] = $test->name;
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "templates/contents/plain_content" );
	}

	public function review( $test_result_id = NULL )
	{
		if( !($test_result_id) ) redirect( site_url($this->current_page) );

		$test_result = $this->test_result_model->test_result( $test_result_id )->row();

		// list soal yang dikerjakan oleh murid
		$lists_question_id = $this->student_answer_model->lists_question_by_test_id( $test_result->test_id, $test_result->user_id )->result();

		// konfigurasi nomor dan question_id
		$number = ( null !== $this->input->get('number') ) ? $this->input->get('number') : 1 ;
		$question_id = ( null !== $this->input->get('question_id') ) ? $this->input->get('question_id') : $lists_question_id[0]->question_id;
		
		//pertanyaan dan jawaban
		$question = $this->question_model->question( $question_id )->result();

		// jawaban siswa
		$student_answer = $this->student_answer_model->student_answer_by_test_id( $test_result->test_id, $test_result->user_id, $question_id )->row();

		//jika question_id adalah soal yang tidak dikerjakan siswa
		if( !$student_answer ) redirect( site_url($this->current_page) . 'review/' . $test_result_id );
		// var_dump($student_answer); die;


		#################################################################3

		$data[ "student_id" ] = $test_result->user_id;
		$data[ "number" ] = $number;
		$data[ "test_result_id" ] = $test_result_id;
		$data[ "lists_question" ] = $lists_question_id;
		$data[ "questions" ] = $question;
		$data[ "student_answer" ] = $student_answer;
		$data["current_page"] = $this->current_page . 'review/' . $test_result_id;
		$this->data[ "contents" ] = $this->load->view('teacher/review/content', $data, true);

		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page . 'review/' . $test_result_id;
		$this->data["block_header"] = "Hasil Ulangan";
		$this->data["header"] = $test_result->name;
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "templates/contents/plain_content" );
	}

	public function give_skor()
	{
		if( !($_POST) ) redirect( site_url($this->current_page) );
		$test_result_id = $this->input->post('test_result_id');
		$question_id = $this->input->post('question_id');
		$data = array(
			'skor' => $this->input->post('skor'),
		);
		$data_param = array(
			'question_id' => $question_id,
			'user_id' => $this->input->post('student_id'),
		);

		$this->student_answer_model->update( $data, $data_param );
		redirect( site_url($this->current_page) .'review/' . $test_result_id . '?number=' . $number . '&question_id=' . $question_id );
	}


	public function assessment( $test_result_id = NULL )
	{
		if( !($test_result_id) ) redirect( site_url($this->current_page) );
		$test_result = $this->test_result_model->test_result( $test_result_id )->row();
		
		$test_id = $test_result->test_id;
		$test = $this->test_model->test( $test_id )->row();
		
		$value = $this->check( $test->max_value, $test_id, $test_result->user_id );
		$data_param = [
			'user_id' 	 => $test_result->user_id,
			'test_id' => $test_id,
		];
		
		$data['value'] = $value['value'];
		// var_dump($data); die;
		$this->test_result_model->update( $data, $data_param );
		
		redirect( site_url($this->current_page) . 'detail/'. $test_id );
	}

	public function check( $max_value = 100, $test_id = NULL, $user_id = NULL )
	{
		if( !($test_id) || !($user_id) ) redirect( site_url($this->current_page) );

		$data_param = [
			'test_id' => $test_id,
			'user_id' => $user_id,
		];

		$answers = $this->student_answer_model->student_answer_by_test_id( $test_id, $user_id )->result();
		$value = 0;
		$correct = 0;
		
		foreach ($answers as $key => $answer) {
			$choice = $this->question_answer_model->question_answer_by_question_id( $answer->question_id )->row();
			$inc = ($choice->value) ? $choice->value : 1;
			$value += $inc;
		}
		$skor = $this->student_answer_model->get_skor( $user_id, $test_id )->row();
		$data = [
			'value' => $skor->skor / $value * $max_value,
			'correct' => $correct,
			'total_quest' => count($answers),
		];
		return $data;
	}

	public function export( $test_id = NULL )
	{
		if( !($test_id) ) redirect( site_url($this->current_page) );
		$data_param[ "id" ] 	= $test_id;
		$this->test_model->update( ['has_print'=> 1], $data_param );
		
		$detail = $this->test_model->test( $test_id )->row();
		$subbab = '';
		$list_subbab = $this->question_reference_model->question_reference_by_test_id( $test_id )->result();
		foreach ($list_subbab as $key => $list) {
			$subbab = $subbab . ', ' .$list->description;
		}

        $detail->subbab = $subbab;
        $detail->school_name = 'SMA NEGERI 6 KENDARI';
        $_data = [
            'rows' => $this->test_result_model->test_result_by_test_id( $test_id )->result(),
            'headers' => $this->services->header_excel( $this->test_result_model->test_result_by_test_id( $test_id )->num_rows() ),
            'title' => 'Hasil Ulangan',
            'detail' => $detail,
		];
        #################################################################
		$this->excel->excel_config($_data);
		redirect( site_url($this->current_page) . 'detail/'. $test_id );
	}

	public function delete(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );
		
		$param 	= $this->input->post('param');

		$data_param[ $param ] 	= $this->input->post( 'id' );
		if( $this->test_result_model->delete( $data_param ) ){
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->test_result_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->test_result_model->errors() ) );
		}
		redirect( site_url($this->current_page)  );
	}
}
