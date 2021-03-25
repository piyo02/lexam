<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Questionnaire extends Teacher_Controller {
	private $services = null;
	private $name = null;
	private $school_id = null;
    private $user_id = null;
    private $edu_ladder_id = null;
    private $parent_page = 'teacher';
	private $current_page = 'teacher/questionnaire/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Questionnaire_services');
		$this->services = new Questionnaire_services;
		$this->load->model(array(
			'group_model',
			'questionnaire_model',
			'teacher_course_model',
			'classroom_model',
			'question_answer_model',
		));
		$this->school_id = $this->ion_auth->get_school_id_for_teacher();
		$this->user_id = $this->session->userdata('user_id');
		$this->edu_ladder_id = $this->ion_auth->get_edu_ladder_id('user_id');

	}
	public function index()
	{
		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) -  1 ) : 0;
		// echo $page; return;
        //pagination parameter
        $pagination['base_url'] = base_url( $this->current_page ) .'/index';
        $pagination['total_records'] = $this->group_model->record_count() ;
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page*$pagination['limit_per_page'];
        $pagination['uri_segment'] = 4;
		//set pagination
		if ($pagination['total_records'] > 0 ) $this->data['pagination_links'] = $this->setPagination($pagination);
		#################################################################3
		$table = $this->services->get_table_config( $this->current_page, 1, $this->user_id, $this->school_id );
		$table[ "rows" ] = $this->questionnaire_model->questionnaires_by_user_id( $pagination['start_record'], $pagination['limit_per_page'], $this->user_id )->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		$add_menu = array(
			"name" => "Tambah Bank Soal",
			"modal_id" => "add_questionnaire_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => $this->services->get_form_data($this->user_id, $this->school_id),
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
		$this->data["block_header"] = "Bank Soal";
		$this->data["header"] = "Bank Soal";
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
			$data['user_id'] = $this->input->post( 'user_id' );
			$data['classroom_id'] = $this->input->post( 'classroom_id' );
			$data['course_id'] = $this->input->post( 'course_id' );
			$data['name'] = $this->input->post( 'name' );
			$data['description'] = $this->input->post( 'description' );
			$data['status'] = $this->input->post( 'status' );

			if( $this->questionnaire_model->create( $data ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->questionnaire_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->questionnaire_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->questionnaire_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->questionnaire_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
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
			$data['course_id'] = $this->input->post( 'course_id' );

			$data_param['id'] = $this->input->post( 'id' );

			if( $this->questionnaire_model->update( $data, $data_param  ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->questionnaire_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->questionnaire_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->questionnaire_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->questionnaire_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page)  );
	}

	public function delete(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );
	  
		$data_param['id'] 	= $this->input->post('id');
		if( $this->questionnaire_model->delete( $data_param ) ){
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->questionnaire_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->questionnaire_model->errors() ) );
		}
		redirect( site_url($this->current_page)  );
	}

	public function count_type( $questionnaire_id = null )
	{
		$id = $this->input->post('id');
		// $id = $questionnaire_id;
		$data['multiple_choice'] = $this->question_answer_model->get_num_type($id, 'text', 'image')->num_rows();
		$data['short_answer'] = $this->question_answer_model->get_num_type($id, 'short_answer')->num_rows();
		$data['essay'] = $this->question_answer_model->get_num_type($id, 'essay')->num_rows();
		echo json_encode($data);
	}
}
