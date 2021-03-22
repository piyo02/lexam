<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends Uadmin_Controller {
	private $services = null;
    private $name = null;
    private $parent_page = 'uadmin';
	private $current_page = 'uadmin/login/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Login_services');
		$this->services = new Login_services;
		$this->load->model(array(
			'login_model',
		));
		$this->data[ "menu_list_id" ] = "login_index";
	}	

	public function index()
	{
		$table = $this->services->get_table_config( $this->current_page );
		$table[ "rows" ] = $this->login_model->login_attemps()->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		##################################################################################################################################

		$this->data[ "header_button" ] =  "" ;
		// echo return;
		##################################################################################################################################
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Kategori ";
		$this->data["header"] = "Kategori ";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->render( "templates/contents/plain_content" );
	}

	public function delete(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );
	  
		$data_param['login'] 	= $this->input->post('login');
		if( $this->login_model->delete( $data_param ) ){
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->login_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->login_model->errors() ) );
		}
		redirect( site_url($this->current_page )  );
	  }
}
