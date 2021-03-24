<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ranking extends Headmaster_Controller {
	private $school_id = null;
	private $user_id = null;
    private $services = null;
    private $name = null;
    private $parent_page = 'headmaster';
	private $current_page = 'headmaster/ranking/';

    function __construct()
    {
        parent::__construct();
        $this->load->library('services/Ranking_services');
        $this->services = new Ranking_services;
        $this->load->model(array(
			'student_profile_model',
			'classroom_model',
			'test_model',
			'courses_model',
			'test_result_model',
		));
		$this->data[ "menu_list_id" ] = "ranking_index";
		$this->school_id = $this->ion_auth->get_school_id_for_headmaster();
		$this->user_id = $this->session->userdata('user_id');
    }

	public function index()
	{
		// all

		// course

		// class_ladder
		$table = $this->services->get_table_config( $this->current_page );
		$table[ "rows" ] = $this->classroom_model->classrooms_by_school_id( $this->school_id )->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		$this->data[ "header_button" ] = '';
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Kelas";
		$this->data["header"] = "Daftar Kelas";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->render( "headmaster/ranking" );
	}
}
