<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Question extends Teacher_Controller {
	private $services = null;
    private $name = null;
    private $parent_page = 'teacher';
	private $current_page = 'teacher/question/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Question_services');
		$this->services = new Question_services;
		$this->load->model(array(
			'group_model',
			'question_model',
			'questionnaire_model',
		));

	}
	public function questionnaire($questionnaire_id)
	{
		if(!$questionnaire_id) redirect(site_url('teacher/questionnaire'));
		//bank soal
		$questionnaire = $this->questionnaire_model->questionnaire($questionnaire_id)->row();
		// var_dump($questionnaire); die;

		$page = ($this->uri->segment(4 + 1)) ? ($this->uri->segment(4 + 1) -  1 ) : 0;
		// echo $page; return;
        //pagination parameter
        $pagination['base_url'] = base_url( $this->current_page ) .'/index';
        $pagination['total_records'] = $this->question_model->record_count_by_questionnaire_id( $questionnaire_id ) ;
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page*$pagination['limit_per_page'];
        $pagination['uri_segment'] = 4;
		//set pagination
		if ($pagination['total_records'] > 0 ) $this->data['pagination_links'] = $this->setPagination($pagination);
		#################################################################3
		$table = $this->services->get_table_config( $this->current_page );
		$table[ "rows" ] = $this->question_model->question_by_questionnaire_id( $pagination['start_record'], $pagination['limit_per_page'], $questionnaire_id )->result();
		// var_dump( $table[ "rows" ] ); die;
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		$add_menu = array(
			"name" => "Tambah Soal",
			"modal_id" => "add_question_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add"),
			"form_data" => array(
				"tq" => array(
					'type' => 'select',
					'label' => "Tipe Soal",
					'options' => array(
						'text' => 'teks',
						'image' => 'gambar',
						'audio' => 'audio',
					),
				),
				"to" => array(
					'type' => 'select',
					'label' => "Tipe Jawaban",
					'options' => array(
						'text' => 'Teks',
						'image' => 'Gambar',
						'short_answer' => 'Isian Singkat',
						'essay' => 'Esai ',
					),
				),
				"questionnaire_id" => array(
					'type' => 'hidden',
					'label' => "Tipe Jawaban",
					'value' => $questionnaire_id
				),
				// 'p' => array(
				// 	'type' => 'hidden',
				// 	'label' => "Tipe Jawaban",
				// 	'value' => 1
				// ),
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
		$this->data["block_header"] = "Daftar Soal";
		$this->data["header"] = $questionnaire->name;
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "templates/contents/plain_content" );
	}


	public function add(  )
	{
		// if( !($_POST) ) redirect(site_url(  $this->current_page ));  
		$type_question = $this->input->get('tq');
		$type_option = $this->input->get('to');
		$questionnaire_id = $this->input->get('questionnaire_id');
		
		// echo var_dump( $data );return;
		$this->form_validation->set_rules( 'text', 'Soal', 'required|trim' );
        if ($this->form_validation->run() === TRUE )
        {
			$code = $this->generate_code();
			
			//method get question
			$method_question = "get_".$this->input->post('type')."_question";
			$question = $this->$method_question($code);
			$question_id = $this->question_model->create($question);

			//method get option
			$method_option = "get_".$this->input->post('type_option')."_option";
			$option = $this->$method_option($question_id);
			$this->test_answer;
			
			if( $this->group_model->create( $data ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->group_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->group_model->errors() ) );
			}
			redirect( site_url($this->current_page)  );
		}
        else
        {
			// var_dump($questionnaire_id); die;
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->question_model->errors() ? $this->question_model->errors() : $this->session->flashdata('message')));
			if(  validation_errors() || $this->group_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		  
			$function_question = 'get_form_' . $type_question . '_question';
			$function_option = 'get_form_' . $type_option . '_option';


			$form_question = $this->services->$function_question();
			$form_option = $this->services->$function_option();

			$form_data['form_data'] = array_merge($form_question['form_data'], $form_option['form_data']);
			$form_data = $this->load->view('templates/form/plain_form', $form_data, TRUE);
			$this->data['contents'] = $form_data;

			$btn_back = array(
				"name" => "Kembali",
				"button_color" => "primary",
				"url" => site_url($this->current_page . "questionnaire/" . $questionnaire_id),
			);

			$btn_back = $this->load->view('templates/actions/link', $btn_back, true);

			$this->data["header_button"] =  $btn_back;
			#################################################################3
			$alert = $this->session->flashdata('alert');
			$this->data["questionnaire_id"] = $questionnaire_id;
			$this->data["key"] = $this->input->get('key', FALSE);
			$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
			$this->data["current_page"] = $this->current_page;
			$this->data["block_header"] = "Tambah Soal";
			$this->data["header"] = "Tambah Soal";
			$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
			$this->render( "teacher/question/add_question" );
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

			if( $this->group_model->update( $data, $data_param  ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->group_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->group_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->group_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->group_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page)  );
	}

	public function delete(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );
	  
		$data_param['id'] 	= $this->input->post('id');
		if( $this->group_model->delete( $data_param ) ){
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->group_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->group_model->errors() ) );
		}
		redirect( site_url($this->current_page)  );
	}
	
	private function get_text_question($code)
	{
		$data = [
			'code' => $code,
			'questionnaire_id' => $this->input->post('questionnaire_id'),
			'type' => 'text',
			'text' => $this->input->post('text'),
		];
		return $data;
	
	}
	public function get_text_option($question_id)
	{
		for ($i = 0; $i < 5; $i++) {
			$_option['question_id'] = $question_id;
			$_option['type']    = 'text';
			$_option['option'] = $this->input->post('option_' . $i);

			$_option['skor']    = 0;
			if (null !== $this->input->post('option_5') && $this->input->post('option_5') == $i)
				$_option['skor'] = 1;
			if (null !== $this->input->post('data_' . $i))
				$_option['id'] = $this->input->post('data_' . $i);
			$_data_option[] = $_option;
		}
		return $_data_option;
	}
	private function get_image_question($code)
	{
		$data = [
			'code' => $code,
			'bank_soal_id' => $this->input->get('b'),
			'type' => 'gambar',
			'text' => $this->input->post('text'),
		];
		$data['image'] = $this->upload_image($code);
		return $data;
	}
	private function generate_code()
	{
		$data = $this->question_model->question_by_questionnaire_id(0, NULL, $this->input->get('questionnaire_id'))->row();
		if (!isset($data->code))
			$code = 'S-1';
		else {
			$code = substr($data->code, 2) + 1;
			$code = 'S-' . $code;
		}
		return $code;
	}
	public function upload_image($code)
	{
		$config['file_name'] 		=  $_FILES['image']['name'].$code."_".time();
		$config['upload_path']		= './uploads/question/';
		$config['allowed_types']    = 'gif|jpg|png|jpeg';
		$config['overwrite']		= "true";
		$config['max_size']			= 20000000;
		// var_dump($config); die;
		// $_FILES['gambar']['name']     = $id . '_' . time() . '_' . $file['name'];
		// $_FILES['gambar']['type']     = $file['type'];
		// $_FILES['gambar']['tmp_name'] = $file['tmp_name'];
		// $_FILES['gambar']['error']    = $file['error'];
		// $_FILES['gambar']['size']     = $file['size'];


		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload( $file ) )
		{
			$this->set_error( $this->upload->display_errors() );
			$this->set_error( 'upload_unsuccessful' );
			return FALSE;
		}
		else
		{
			$file_data = $this->upload->data();
			$data['image'] = $file_data['file_name'];
			$success = TRUE;
		}
	}
}
