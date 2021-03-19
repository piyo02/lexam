<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Courses extends Teacher_Controller {
	private $services = null;
    private $name = null;
    private $school_id = null;
    private $user_id = null;
    private $parent_page = 'teacher';
	private $current_page = 'teacher/courses/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Courses_services');
		$this->services = new Courses_services;
		$this->load->model(array(
			'group_model',
			'courses_model',
			'teacher_course_model',
		));
		$this->school_id = $this->ion_auth->get_school_id_for_teacher();
		$this->user_id = $this->session->userdata('user_id');
	}
	private function list_course()
	{
		$courses = $this->courses_model->courses_by_school_id( 0 , null, $this->school_id)->result();
		$list_course[''] = "-- Pilih Mata Pelajaran --";
		foreach ($courses as $key => $course) {
			$list_course[$course->id] = $course->name;
		}
		return $list_course;
	}
	public function index()
	{
		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) -  1 ) : 0;
		// echo $page; return;
        //pagination parameter
        $pagination['base_url'] = base_url( $this->current_page ) .'/index';
        $pagination['total_records'] = $this->teacher_course_model->record_count() ;
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page*$pagination['limit_per_page'];
        $pagination['uri_segment'] = 4;
		//set pagination
		if ($pagination['total_records'] > 0 ) $this->data['pagination_links'] = $this->setPagination($pagination);
		#################################################################3
		$table = $this->services->get_table_teacher_config( $this->current_page );
		$table[ "rows" ] = $this->teacher_course_model->teacher_course_by_user_id($this->user_id )->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		$add_menu = array(
			"name" => "Pilih Mata Pelajaran",
			"modal_id" => "choose_course",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => array(
				"course_id" => array(
					'type' => 'select',
					'label' => "Mata Pelajaran",
					'options' => $this->list_course(),
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
		$this->data["block_header"] = "Mata Pelajaran";
		$this->data["header"] = "Daftar Mata Pelajaran yang Diajar";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "templates/contents/plain_content" );
	}


	public function add(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( 'course_id', 'Mata Pelajaran', 'required' );
        if ($this->form_validation->run() === TRUE )
        {
			$data['user_id'] = $this->user_id;
			$data['course_id'] = $this->input->post( 'course_id' );

			if( $this->teacher_course_model->create( $data ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->teacher_course_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->teacher_course_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->teacher_course_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->teacher_course_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
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

			if( $this->teacher_course_model->update( $data, $data_param  ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->teacher_course_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->teacher_course_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->teacher_course_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->teacher_course_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page)  );
	}

	public function delete(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );
	  
		$data_param['id'] 	= $this->input->post('id');
		if( $this->teacher_course_model->delete( $data_param ) ){
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->teacher_course_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->teacher_course_model->errors() ) );
		}
		redirect( site_url($this->current_page)  );
	}
}
