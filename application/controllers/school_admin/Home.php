<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends School_admin_Controller {
    private $edu_ladder_id = null;
    private $school_id = null;
	private $services = null;
    private $name = null;
    private $parent_page = 'school_admin';
	private $current_page = 'school_admin/';
	public function __construct(){
		parent::__construct();
		$this->load->model(
			array(
				'classroom_model',
				'courses_model',
				'student_profile_model',
				'teacher_profile_model',
			)
		);
		$this->data[ "menu_list_id" ] =  'home_index';
		$this->school_id = $this->ion_auth->get_school_id();
		$this->edu_ladder_id = $this->ion_auth->get_edu_ladder_id();
	}
	public function index()
	{
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
		
		$this->data["teachers"] =  $this->teacher_profile_model->teacher_by_school_id( $this->school_id )->num_rows();
		$this->data["classrooms"] =  $this->classroom_model->classrooms_by_school_id( 0, null, $this->school_id )->num_rows();
		$this->data["courses"] =  $this->courses_model->courses_by_school_id( $this->school_id )->num_rows();
		$this->data["students"] =  $this->student_profile_model->student_by_school_id( $this->school_id )->num_rows();

		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Group";
		$this->data["header"] = "Group";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "school_admin/dashboard/content" );
	}
}
