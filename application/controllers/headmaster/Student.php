<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends Headmaster_Controller {
    private $services = null;
    private $name = null;
    private $parent_page = 'headmaster';
	private $current_page = 'headmaster/student/';

    function __construct()
    {
        parent::__construct();
        $this->load->library('services/Student_services');
        $this->services = new Student_services;
        $this->load->model(array(
			'student_profile_model',
			'classroom_model',
			'Group_model',
		));
		$this->data[ "menu_list_id" ] = "student_index";
    }

	public function index()
	{
		$table = $this->services->get_table_config( $this->current_page );
		$table[ "rows" ] = $this->Group_model->groups()->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		$this->data[ "header_button" ] = '';
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Kategori";
		$this->data["header"] = "Kategori";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->render( "templates/contents/plain_content" );
	}
}
