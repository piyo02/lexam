<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends Headmaster_Controller {
	private $school_id = null;
	private $user_id = null;
    private $services = null;
    private $name = null;
    private $parent_page = 'headmaster';
	private $current_page = 'headmaster/teacher/';

    function __construct()
    {
        parent::__construct();
        $this->load->library('services/Teacher_services');
        $this->services = new Teacher_services;
        $this->load->model(array(
			'teacher_profile_model',
			'classroom_model',
			'test_model',
			'courses_model',
			'test_result_model',
			'student_answer_model',
			'question_model',
		));
		$this->data[ "menu_list_id" ] = "teacher_index";
		$this->school_id = $this->ion_auth->get_school_id_for_headmaster();
		$this->user_id = $this->session->userdata('user_id');
    }

	public function index()
	{
		$table = $this->services->get_table_config( $this->current_page );
		$table[ "rows" ] = $this->teacher_profile_model->teacher_by_school_id( $this->school_id )->result();
		$table = $this->load->view('templates/tables/plain_table_image', $table, true);
		$this->data[ "contents" ] = $table;
		$this->data[ "header_button" ] = '';
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Guru";
		$this->data["header"] = "Daftar Guru";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->render( "templates/contents/plain_content" );
	}

	public function test( $teacher_id = NULL )
	{
		if( !$teacher_id ) redirect( $this->current_page );

		$table = $this->services->get_table_test_config( $this->current_page );
		$table[ "rows" ] = $this->test_model->tests( 0, NULL, $teacher_id )->result();
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

		$this->render( "templates/contents/plain_content" );
	}

	public function result( $test_id = NULL )
	{
		if( !$test_id ) redirect( $this->current_page );
	
		$table = $this->services->get_table_result_config( $this->current_page );
		$table[ "rows" ] = $this->test_result_model->test_result_by_test_id( $test_id )->result();
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
		$data[ "display" ] = 'none';
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
}
