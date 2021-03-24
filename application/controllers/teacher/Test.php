<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends Teacher_Controller {
	private $school_id = null;
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
			'questionnaire_model',
			'question_reference_model',
			'solve_test_model',
		));
		$this->data[ "menu_list_id" ] =  'test_index';
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
			"modal_id" => "add_test_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => array(
				"cr" => array(
					'type' => 'number',
					'label' => "Banyak Referensi",
				),
			),
			'data' => NULL
		);

		$add_menu= $this->load->view('templates/actions/modal_form_get', $add_menu, true );

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
			$data['date'] = date('Y-m-d', strtotime($this->input->post( 'date' )));
			$data['duration'] = $this->input->post( 'duration' );
			$data['kkm'] = $this->input->post( 'kkm' );
			$data['max_value'] = $this->input->post( 'max_value' );
			$data['classroom_id'] = $this->input->post( 'classroom_id' );
			$data['class_ladder_id'] = $this->input->post( 'class_ladder_id' );
			$data['course_id'] = $this->input->post( 'course_id' );
			$data['status'] = $this->input->post( 'status' );

			// var_dump($data); die;

			$test_id = $this->test_model->create( $data );

			$cr = $this->input->post( 'cr' );

			for ($i=0; $i < $cr; $i++) {
				$ref[] = array(
					'test_id' => $test_id,
					'questionnaire_id' => $this->input->post( 'questionnaire_id_' . $i ),
					'multiple_choice' => $this->input->post( 'multiple_choice_' . $i ),
					'short_answer' => $this->input->post( 'short_answer_' . $i ),
					'essay' => $this->input->post( 'essay_' . $i ),
				);
			}

			if( $test_id && $this->question_reference_model->create( $ref ) ){
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
			$questionnaires = $this->questionnaire_model->questionnaires_by_user_id( $this->user_id )->result();

			$list_questionnaire[] = "-- Pilih Bank Soal --";
			foreach ($questionnaires as $key => $questionnaire) {
				$list_questionnaire[ $questionnaire->id ] = $questionnaire->name;
			}

			$this->data['list_questionnaire'] = $list_questionnaire;

			$form_data['form_data'] = $this->services->form_data( $this->user_id, $this->school_id );
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
			$this->data["cr"] = $this->input->get('cr');
			$this->data["key"] = $this->input->get('key', FALSE);
			$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
			$this->data["current_page"] = $this->current_page;
			$this->data["block_header"] = "Ulangan";
			$this->data["header"] = "Buat Ulangan";
			$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
			$this->render( "teacher/test/add" );
		}
	}

	public function detail( $test_id = null)
	{
		$questionnaires = $this->questionnaire_model->questionnaires_by_user_id( $this->user_id )->result();

		$list_questionnaire[] = "-- Pilih Bank Soal --";
		foreach ($questionnaires as $key => $questionnaire) {
			$list_questionnaire[ $questionnaire->id ] = $questionnaire->name;
		}

		$this->data['list_questionnaire'] = $list_questionnaire;

		$test = $this->test_model->test( $test_id )->row();
		// var_dump($test); die;
		$form_data['form_data'] = $this->services->form_data_readonly( $test );
		$this->data['content'] = $this->load->view('templates/form/plain_form_readonly', $form_data, true);

		$edit_test = array(
			"name" => "Edit",
			"modal_id" => "edit_test_",
			"button_color" => "success",
			"url" => site_url( $this->current_page."edit_test/"),
			"form_data" => $this->services->form_data( $this->user_id, $this->school_id, $test ),
			'data' => NULL
		);

		$edit_test = $this->load->view('templates/actions/modal_form', $edit_test, true );
		$this->data[ "edit_test" ] =  $edit_test;

		$references = $this->question_reference_model->question_reference_by_test_id( $test_id )->result();
		$this->data['references'] = $references;
		// var_dump($references); die;
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
		$this->data[ "url" ] =  site_url( $this->current_page."edit_ref/");
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Ulangan";
		$this->data["header"] = "Edit Ulangan";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "teacher/test/detail" );
	}

	public function work( $test_id = NULL )
	{
		if( !($test_id) ) redirect(site_url(  $this->current_page ));

		$table = $this->services->get_table_solve_config( $this->current_page );
		$table[ "rows" ] = $this->solve_test_model->solve_test_by_student_id( $test_id )->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;

		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data[ "url" ] =  site_url( $this->current_page."edit_ref/");
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Ulangan";
		$this->data["header"] = "Pengerjaan Ulangan";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "templates/contents/plain_content" );
	}

	public function edit_test(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( $this->services->validation_config() );
        if ($this->form_validation->run() === TRUE )
        {
			$data['name'] = $this->input->post( 'name' );
			$data['classroom_id'] = $this->input->post( 'classroom_id' );
			$data['class_ladder_id'] = $this->input->post( 'class_ladder_id' );
			$data['course_id'] = $this->input->post( 'course_id' );
			$data['date'] = date('Y-m-d', strtotime($this->input->post( 'date' )));
			$data['duration'] = $this->input->post( 'duration' );
			$data['kkm'] = $this->input->post( 'kkm' );
			$data['max_value'] = $this->input->post( 'max_value' );
			$data['status'] = $this->input->post( 'status' );

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
		redirect( site_url($this->current_page . 'detail/' . $data_param['id']) );
	}

	public function edit_ref(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( 'id', 'Referensi Soal', 'required' );
        if ($this->form_validation->run() === TRUE )
        {
			$index = $this->input->post( 'index' );
			$data['questionnaire_id'] = $this->input->post( 'questionnaire_id_' . $index );
			$data['multiple_choice'] = $this->input->post( 'multiple_choice_' . $index );
			$data['short_answer'] = $this->input->post( 'short_answer_' . $index );
			$data['essay'] = $this->input->post( 'essay_' . $index );

			$data_param['id'] = $this->input->post( 'id' );
			$test_id = $this->input->post( 'test_id' );
			if( $this->question_reference_model->update( $data, $data_param  ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->question_reference_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->question_reference_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->test_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->test_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		redirect( site_url($this->current_page . 'detail/' . $test_id) );
	}
	public function break(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( 'id', 'Ulangan', 'required' );
        if ($this->form_validation->run() === TRUE )
        {
			$test_id = $this->input->post( 'test_id' );
			$data['is_break'] = $this->input->post( 'is_break' );

			$data_param['id'] = $this->input->post( 'id' );
			if( $this->solve_test_model->update( $data, $data_param  ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->solve_test_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->solve_test_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->test_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->test_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		redirect( site_url($this->current_page . 'work/' . $test_id) );
	}

	public function delete(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );
		$model 	= $this->input->post('model');

		$data_param['id'] 	= $this->input->post('id');
		if( $this->$model->delete( $data_param ) ){
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->test_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->test_model->errors() ) );
		}
		redirect( site_url($this->current_page)  );
	}
}
