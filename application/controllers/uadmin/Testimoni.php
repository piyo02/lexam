<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Testimoni extends Uadmin_Controller {
	private $services = null;
    private $name = null;
    private $parent_page = 'uadmin';
	private $current_page = 'uadmin/testimoni/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Testimoni_services');
		$this->services = new Testimoni_services;
		$this->load->model(array(
			'testimoni_model',
		));
		$this->data[ "menu_list_id" ] =  'testimoni_index';

	}
	public function index()
	{
		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) -  1 ) : 0;
		// echo $page; return;
        //pagination parameter
        $pagination['base_url'] = base_url( $this->current_page ) .'/index';
        $pagination['total_records'] = $this->testimoni_model->record_count() ;
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page*$pagination['limit_per_page'];
        $pagination['uri_segment'] = 4;
		//set pagination
		if ($pagination['total_records'] > 0 ) $this->data['pagination_links'] = $this->setPagination($pagination);
		#################################################################3
		$table = $this->services->get_table_config( $this->current_page );
		$table[ "rows" ] = $this->testimoni_model->testimonies( $pagination['start_record'], $pagination['limit_per_page'] )->result();
		$table = $this->load->view('templates/tables/plain_table_image', $table, true);
		$this->data[ "contents" ] = $table;
		$add_menu = array(
			"name" => "Tambah Testimoni Pengguna",
			"modal_id" => "add_group_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => array(
				"name" => array(
					'type' => 'text',
					'label' => "Nama",
					'value' => "",
				),
				"status" => array(
					'type' => 'text',
					'label' => "Status",
					'value' => "",
				),
				"testimoni" => array(
					'type' => 'textarea',
					'label' => "Testimoni",
					'value' => "-",
				),
				"image" => array(
					'type' => 'file',
					'label' => "Foto",
					'value' => "",
				),
			),
			'data' => NULL
		);

		$add_menu= $this->load->view('templates/actions/modal_form_multipart', $add_menu, true ); 

		$this->data[ "header_button" ] =  $add_menu;
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Testimoni";
		$this->data["header"] = "Daftar Testimoni";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "templates/contents/plain_content" );
	}


	public function add(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( $this->services->validation_config() );
        if ($this->form_validation->run() === TRUE )
        {
			$data['name'] = $this->input->post( 'name' );
			$data['status'] = $this->input->post( 'status' );
			$data['testimoni'] = $this->input->post( 'testimoni' );

			$data['image'] = upload_image();

			if( $this->testimoni_model->create( $data ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->testimoni_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->testimoni_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->testimoni_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->testimoni_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page)  );
	}

	public function edit(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( $this->services->validation_config() );
        if ($this->form_validation->run() === TRUE )
        {
			$data['name'] = $this->input->post( 'name' );
			$data['status'] = $this->input->post( 'status' );
			$data['testimoni'] = $this->input->post( 'testimoni' );

			if( $_FILES['image']['name'] !== NULL )
				$data['image'] = upload_image();

			$data_param['id'] = $this->input->post( 'id' );

			if( $this->testimoni_model->update( $data, $data_param  ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->testimoni_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->testimoni_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->testimoni_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->testimoni_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page)  );
	}

	public function delete(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );
	  
		$data_param['id'] 	= $this->input->post('id');
		if( $this->testimoni_model->delete( $data_param ) ){
			if(NULL !== $this->input->post('image_old')){
				if($this->input->post('image_old') != 'default.jpg')
					@unlink( './uploads/testimoni' . $this->input->post('image_old') );
			}

		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->testimoni_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->testimoni_model->errors() ) );
		}
		redirect( site_url($this->current_page)  );
	}

	public function upload_image()
	{
		$upload = $this->config->item('upload', 'ion_auth');

		$file = $_FILES[ 'image' ];
		$upload_path = 'uploads/testimoni';

		$config 				= $upload;
		$config['file_name'] 	= 'Testimoni__' . time();
		$config['upload_path']	= './' . $upload_path;
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload( $userfile ) )
		{
			return FALSE;
		}
		else
		{
			if(NULL !== $this->input->post('image_old')){
				if($this->input->post('image_old') != 'default.jpg')
					@unlink( $config['upload_path'].$this->input->post('image_old') );
			}
			$file_data = $this->upload->data();
			return $file_data['file_name'];
		}
	}
}
