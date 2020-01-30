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
		$this->services = new Result_test_services;
		$this->load->model(array(
			'group_model',
			'test_result_model',
			'test_model',
			'student_answer_model',
			'question_model',
			'question_answer_model',

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
