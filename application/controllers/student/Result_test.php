<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Result_test extends Student_Controller {
	private $user_id = null;
	private $services = null;
    private $name = null;
    private $parent_page = 'student';
	private $current_page = 'student/result_test/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Result_test_services');
		$this->services = new Result_test_services;
		$this->load->model(array(
			'group_model',
			'test_result_model',
			'test_model',
			'student_profile_model',
			'courses_model',
		));
		$this->user_id = $this->session->userdata('user_id');
		$this->data['menu_list_id'] = 'result_test_index';
	}
	public function index()
	{
		$student = $this->student_profile_model->student_profile( $this->user_id )->row();

		$courses = $this->courses_model->courses_by_school_id( 0, null, $student->school_id )->result();
		foreach ($courses as $key => $course) {
			$list_course[$course->id] = $course->name;
		}

		$course_id = $this->input->get('course_id');
		$course_id || $course_id = $courses[0]->id;

		$this->data[ "results" ] = $this->test_result_model->test_result_by_course_id( $this->user_id, $course_id )->result();
		
		$form_data['form_data'] = array(
			'course_id' => array(
				'type' => 'select',
				'label' => 'Mata Pelajaran',
				'options' => $list_course,
				'selected' => $course_id
			),
		);
		$form_data = $this->load->view('templates/form/plain_form_horizontal', $form_data , TRUE ) ;
		$this->data[ "contents" ] = $form_data;
		$this->data[ "course_id" ] = $course_id;
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Ulangan";
		$this->data["header"] = "Hasil Ulangan";
		$this->data["sub_header"] = '';
		$this->render( "student/result_test" );
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

	public function result_test(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );
		
		$course_id = $this->input->post('course_id');
		$user_id = $this->user_id;

		$tests = $this->test_result_model->test_result_by_course_id( $user_id, $course_id )->result();
		foreach ($tests as $key => $test) {
			$data['test_name'][] = $test->name;
			$data['value'][] = $test->value;
		}
		echo json_encode($data);
	}
}
