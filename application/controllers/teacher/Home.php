<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Teacher_Controller {
	private $user_id = null;
	private $school_id = null;
	private $services = null;
    private $name = null;
    private $parent_page = 'teacher';
	private $current_page = 'teacher/';
	public function __construct(){
		parent::__construct();
		$this->load->model(array(
			'test_model',
			'questionnaire_model',
			'courses_model',
			'teacher_course_model',
			'test_result_model',
		));
		$this->school_id = $this->ion_auth->get_school_id_for_teacher();
		$this->user_id = $this->session->userdata('user_id');
	}
	public function index()
	{
		$this->data['questionnaire'] = $this->questionnaire_model->questionnaires_by_user_id( 0, NULL, $this->user_id )->num_rows();
		$this->data['test'] = $this->test_model->tests( 0, NULL, $this->user_id )->num_rows();
		$this->data['course'] = $this->teacher_course_model->teacher_course_by_user_id( $this->user_id )->num_rows();
		$this->data['student'] = $this->test_result_model->test_result_by_teacher_id( $this->user_id )->num_rows();

		$add_menu = array(
			"name" => "Tambah Group",
			"modal_id" => "add_group_",
			"button_color" => "primary",
			"url" => site_url($this->current_page . "add/"),
			"form_data" => array(
				"name" => array(
					'type' => 'text',
					'label' => "Nama Group",
					'value' => "",
				),
				"description" => array(
					'type' => 'textarea',
					'label' => "Deskripsi",
					'value' => "-",
				),
				'data' => NULL
			),
		);

		$add_menu = $this->load->view('templates/actions/modal_form', $add_menu, true);

		$this->data["header_button"] =  $add_menu;
		
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Group";
		$this->data["header"] = "Group";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "teacher/dashboard/content" );
	}
}
