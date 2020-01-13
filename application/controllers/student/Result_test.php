<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Result_test extends Student_Controller {
	private $user_id = null;
	private $services = null;
    private $name = null;
    private $parent_page = 'student';
	private $current_page = 'student/result_test/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Result_test_services');
		$this->services = new Result_test_services;
		$this->load->model(array(
			'group_model',
			'test_result_model',
			'test_model',
			'student_profile_model',
			'courses_model',
		));
		$this->user_id = $this->session->userdata('user_id');
		$this->data['menu_list_id'] = 'result_test_index';
	}
	public function index()
	{
		$student = $this->student_profile_model->student_profile( $this->user_id )->row();

		$courses = $this->courses_model->courses_by_school_id( 0, null, $student->school_id )->result();
		foreach ($courses as $key => $course) {
			$list_course[$course->id] = $course->name;
		}

		$course_id = $this->input->get('course_id');
		$course_id || $course_id = $courses[0]->id;

		$table = $this->services->get_table_config( $this->current_page );
		$table[ "rows" ] = $this->test_result_model->test_result_by_course_id( $this->user_id, $course_id )->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);

		$form_data['form_data'] = array(
			'course_id' => array(
				'type' => 'select',
				'label' => 'Mata Pelajaran',
				'options' => $list_course,
				'selected' => $course_id
			),
		);
		$form_data = $this->load->view('templates/form/plain_form_horizontal', $form_data , TRUE ) ;
		$this->data[ "contents" ] = $form_data;
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Ulangan";
		$this->data["header"] = "Hasil Ulangan";
		$this->data["sub_header"] = '';
		$this->render( "student/result_test" );
	}


	public function add(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( $this->services->validation_config() );
        if ($this->form_validation->run() === TRUE )
        {
			$data['name'] = $this->input->post( 'name' );
			$data['description'] = $this->input->post( 'description' );

			if( $this->test_result_model->create( $data ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->test_result_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->test_result_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->test_result_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->test_result_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
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

			if( $this->test_result_model->update( $data, $data_param  ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->test_result_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->test_result_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->test_result_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->test_result_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page)  );
	}

	public function detail( $test_id )
	{
		$test = $this->test_model->test( $test_id )->row();
		
		#################################################################3
		$table = $this->services->get_table_result_config( $this->current_page );
		$table[ "rows" ] = $this->test_result_model->test_result_by_test_id( $test_id )->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;

		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Hasil Ulangan";
		$this->data["header"] = $test->name;
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "templates/contents/plain_content" );
	}

	public function delete(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );
	  
		$data_param['id'] 	= $this->input->post('id');
		if( $this->test_result_model->delete( $data_param ) ){
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->test_result_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->test_result_model->errors() ) );
		}
		redirect( site_url($this->current_page)  );
	}
}
