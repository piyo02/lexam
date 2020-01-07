<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends Teacher_Controller {
	private $user_id = null;
	private $edu_ladder_id = null;
	private $services = null;
    private $name = null;
    private $parent_page = 'teacher';
	private $current_page = 'teacher/test/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Test_services');
		$this->services = new Test_services;
		$this->load->model(array(
			'test_model',
		));
		$this->data[ "menu_list_id" ] =  'test_index';
		$this->user_id = $this->session->userdata('user_id');
		$this->edu_ladder_id = $this->ion_auth->get_edu_ladder_id('user_id');
	}

	public function index()
	{
		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) -  1 ) : 0;
		// echo $page; return;
        //pagination parameter
        $pagination['base_url'] = base_url( $this->current_page ) .'/index';
        $pagination['total_records'] = $this->test_model->record_count() ;
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page*$pagination['limit_per_page'];
        $pagination['uri_segment'] = 4;
		//set pagination
		if ($pagination['total_records'] > 0 ) $this->data['pagination_links'] = $this->setPagination($pagination);
		#################################################################3
		$table = $this->services->get_table_config( $this->current_page );
		$table[ "rows" ] = $this->test_model->tests( $pagination['start_record'], $pagination['limit_per_page'] )->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		$add_menu = array(
			"name" => "Tambah Ulangan",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
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
		$this->data["block_header"] = "Ulangan";
		$this->data["header"] = "Daftar Ulangan";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "templates/contents/plain_content" );
	}


	public function add(  )
	{
		// echo var_dump( $data );return;
		$this->form_validation->set_rules( $this->services->validation_config() );
        if ($this->form_validation->run() === TRUE )
        {
			$data['user_id'] = $this->user_id;

			$data['name'] = $this->input->post( 'name' );
			$data['time_start'] = $this->input->post( 'time_start' );
			$data['duration'] = $this->input->post( 'duration' );
			$data['kkm'] = $this->input->post( 'kkm' );
			$data['max_value'] = $this->input->post( 'max_value' );
			$data['classroom_id'] = $this->input->post( 'classroom_id' );
			$data['course_id'] = $this->input->post( 'course_id' );
			
			$test_id = $this->test_model->create( $data );

			$ref['test_id'] = $test_id;
			$ref['questionnaire_id'] = '';
			$ref['multiple_choice'] = '';
			$ref['short_answer'] = '';
			$ref['essay'] = '';

			if( $test_id ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->test_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->test_model->errors() ) );
			}
			redirect( site_url($this->current_page) );
		}
        else
        {
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->test_model->errors() ? $this->test_model->errors() : $this->session->flashdata('message')));
			if(  validation_errors() || $this->test_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		  
			$form_data['form_data'] = $this->services->form_data( $this->user_id, $this->edu_ladder_id );
			$this->data['content_add'] = $this->load->view('templates/form/plain_form', $form_data, true);

			$btn_back = array(
				"name" => "Kembali",
				"button_color" => "primary",
				"url" => site_url( $this->current_page),
				'data' => NULL
			);

			$btn_back= $this->load->view('templates/actions/link', $btn_back, true ); 

			$this->data[ "header_button" ] =  $btn_back;
			// return;
			#################################################################3
			$alert = $this->session->flashdata('alert');
			$this->data["key"] = $this->input->get('key', FALSE);
			$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
			$this->data["current_page"] = $this->current_page;
			$this->data["block_header"] = "Ulangan";
			$this->data["header"] = "Buat Ulangan";
			$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
			$this->render( "teacher/test/add" );
		}		
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

			if( $this->test_model->update( $data, $data_param  ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->test_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->test_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->test_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->test_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page)  );
	}

	public function delete(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );
	  
		$data_param['id'] 	= $this->input->post('id');
		if( $this->test_model->delete( $data_param ) ){
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->test_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->test_model->errors() ) );
		}
		redirect( site_url($this->current_page)  );
	}
}
