<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Classroom extends School_admin_Controller {
	private $services = null;
    private $name = null;
    private $parent_page = 'school_admin';
	private $current_page = 'school_admin/classroom/';
    private $school_id = null;
    private $edu_ladder_id = null;
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Classroom_services');
		$this->services = new Classroom_services;
		$this->load->model(array(
			'classroom_model',
			'class_ladder_model',
		));
		$this->data[ "menu_list_id" ] =  'classroom_index';
		$this->school_id = $this->ion_auth->get_school_id();
		$this->edu_ladder_id = $this->ion_auth->get_edu_ladder_id();
	}
	public function index()
	{
		$class_ladders = $this->class_ladder_model->class_ladders()->result();
		foreach ($class_ladders as $key => $class_ladder) {
			$list_class_ladders[ $class_ladder->id ] = $class_ladder->name;
		}
		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) -  1 ) : 0;
		// echo $page; return;
        //pagination parameter
        $pagination['base_url'] = base_url( $this->current_page ) .'/index';
        $pagination['total_records'] = $this->classroom_model->record_count() ;
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page*$pagination['limit_per_page'];
        $pagination['uri_segment'] = 4;
		//set pagination
		if ($pagination['total_records'] > 0 ) $this->data['pagination_links'] = $this->setPagination($pagination);
		#################################################################3
		$table = $this->services->get_table_config( $this->current_page );
		$table[ "rows" ] = $this->classroom_model->classrooms_by_school_id( $pagination['start_record'], $pagination['limit_per_page'], $this->school_id )->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		$add_menu = array(
			"name" => "Tambah Kelas",
			"modal_id" => "add_class_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => array(
				"school_id" => array(
					'type' => 'hidden',
					'label' => "Jenjang Pendidikan",
					'value' => $this->school_id,
				),
				"class_ladder_id" => array(
					'type' => 'select',
					'label' => "Jenjang Kelas",
					'options' => $list_class_ladders,
				),
				"name" => array(
					'type' => 'text',
					'label' => "Nama Kelas",
					'value' => "",
				),
				"description" => array(
					'type' => 'textarea',
					'label' => "Deskripsi",
					'value' => "-",
				),
			),
			'data' => NULL
		);

		$add_menu= $this->load->view('templates/actions/modal_form', $add_menu, true ); 

		$this->data[ "header_button" ] =  $add_menu;
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Kelas";
		$this->data["header"] = "Kelas";
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
			$data['school_id'] = $this->input->post( 'school_id' );
			$data['name'] = $this->input->post( 'name' );
			$data['description'] = $this->input->post( 'description' );

			if( $this->classroom_model->create( $data ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->classroom_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->classroom_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->classroom_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->classroom_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
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
			$data['description'] = $this->input->post( 'description' );

			$data_param['id'] = $this->input->post( 'id' );

			if( $this->classroom_model->update( $data, $data_param  ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->classroom_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->classroom_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->classroom_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->classroom_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page)  );
	}

	public function delete(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );
	  
		$data_param['id'] 	= $this->input->post('id');
		if( $this->classroom_model->delete( $data_param ) ){
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->classroom_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->classroom_model->errors() ) );
		}
		redirect( site_url($this->current_page)  );
	}
}
