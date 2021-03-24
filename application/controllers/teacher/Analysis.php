<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Analysis extends Teacher_Controller {
	private $services = null;
    private $name = null;
    private $parent_page = 'teacher';
	private $current_page = 'teacher/analysis/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Analysis_services');
		$this->services = new Analysis_services;
		$this->load->model(array(
			'group_model',
			'test_model',
			'student_answer_model',
		));
		$this->data['menu_list_id'] = 'result_test_index';

	}
	public function test( $test_id )
	{
		$test = $this->test_model->test( $test_id )->row();
		
		#################################################################3
		$table = $this->services->get_table_config( $this->current_page );
		$table[ "rows" ] = $this->group_model->groups(  )->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		$add_menu = array(
			"name" => "Export",
			"button_color" => "success",
			"url" => site_url( $this->current_page."export/" . $test_id),
			'data' => NULL
		);

		$add_menu= $this->load->view('templates/actions/link', $add_menu, true ); 

		$this->data[ "header_button" ] =  $add_menu;
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = $test->name;
		$this->data["header"] = "Analisis Soal";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "templates/contents/plain_content" );
	}


	
}
