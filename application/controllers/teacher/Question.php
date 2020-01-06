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
			'question_answer_model',
			'questionnaire_model',
		));
		$this->data[ "menu_list_id" ] =  'questionnaire_index';

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
		$table = $this->load->view('templates/tables/plain_table_question', $table, true);
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
			$questionnaire_id = $this->input->post('questionnaire_id');
			$code = $this->generate_code();
			
			//method get question
			$method_question = "get_".$this->input->post('type')."_question";
			$question = $this->$method_question($code);
			$question_id = $this->question_model->create( $question );
			//method get option
			// $question_id = 1;
			$method_option = "get_".$this->input->post('type_option')."_option";
			$option = $this->$method_option($question_id, $code);
			$result = $this->question_answer_model->create( $option );
			// var_dump($option); die;
			
			if( $result ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->question_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->question_model->errors() ) );
			}
			redirect( site_url($this->current_page . 'questionnaire/' . $questionnaire_id) );
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
			$this->render( "teacher/question/add" );
		}
		
	}

	public function detail( $question_id )
	{
		$this->data['url'] = site_url( $this->current_page);

		$question = $this->question_model->question( $question_id )->row();
		$this->data['question'] = $question;

		$options = $this->question_answer_model->question_answer_by_question_id( $question_id )->result();
		$this->data['options'] = $options;
		// var_dump($options); die;

		//id, type, answer, value
		$edit_quest = array(
			"name" => "Edit",
			"modal_id" => "edit_question_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."edit"),
			"form_data" => array(
				"id" => array(
					'type' => 'hidden',
					'label' => "id soal",
					'value' => $question->id
				),
				"text" => array(
					'type' => 'ckeditor',
					'label' => "Soal",
					'value' => $question->text
				),
			),
			'data' => NULL
		);
		$edit_quest = $this->load->view('templates/actions/modal_form_lg', $edit_quest, true ); 
		$this->data['edit_quest'] = $edit_quest;

		if($question->type == 'image') {
			$edit_image_quest = array(
				"name" => "Edit",
				"modal_id" => "edit_image_question_",
				"button_color" => "primary",
				"url" => site_url( $this->current_page."edit"),
				"form_data" => array(
					"id" => array(
						'type' => 'hidden',
						'label' => "id soal",
						'value' => $question->id
					),
					"image_old" => array(
						'type' => 'hidden',
						'label' => "gambar",
						'value' => $question->image
					),
					"image" => array(
						'type' => 'file',
						'label' => "Gambar",
					),
				),
				'data' => NULL
			);
			$edit_image_quest = $this->load->view('templates/actions/modal_form_multipart', $edit_image_quest, true ); 
			$this->data['edit_image_quest'] = $edit_image_quest;
		}
		


		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["question_id"] = $question_id;
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Detail Soal";
		$this->data["header"] = "Detail Soal";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "teacher/question/detail" );
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

			if( $this->question_model->update( $data, $data_param  ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->question_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->question_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->question_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->question_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page)  );
	}

	public function delete(  ) {
		if( !($_POST) ) redirect( site_url($this->parent_page . 'questionnaire') );
		$questionnaire_id = $this->input->post('questionnaire_id');

		$data_param['id'] 	= $this->input->post('id');
		// var_dump($this->input->post('questionnaire_id')); die;
		if( $this->question_model->delete( $data_param ) ){
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->question_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->question_model->errors() ) );
		}
		redirect( site_url($this->current_page . 'questionnaire/' . $questionnaire_id)  );
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
	public function get_text_option($question_id, $code = null)
	{
		for ($i = 0; $i < 5; $i++) {
			$_option['question_id'] = $question_id;
			$_option['type']    = 'text';
			$_option['answer'] = $this->input->post('option_' . $i);

			$_option['value']    = 0;
			if (null !== $this->input->post('option_5') && $this->input->post('option_5') == $i)
				$_option['value'] = 1;
			if (null !== $this->input->post('data_' . $i))
				$_option['id'] = $this->input->post('data_' . $i);
			$_data_option[] = $_option;
		}
		return $_data_option;
	}
	private function get_image_question($code)
	{
		$questionnaire_id = $this->input->post('questionnaire_id');
		$data = [
			'code' => $code,
			'questionnaire_id' => $questionnaire_id,
			'type' => 'image',
			'text' => $this->input->post('text'),
		];
		$data['image'] = $this->upload_image($code);
		if( ! $data['image'])
		{
			echo 1;
			$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, 'Gagal Membuat Soal, Cek Kembali Gambar yang di Upload' ) );
			redirect( site_url($this->current_page . '/questionnaire/' . $questionnaire_id) );
		}
		return $data;
	}
	public function get_image_option($question_id, $code)
	{
		for ($i = 0; $i < 5; $i++) {
			
			$_option['question_id'] = $question_id;
			$_option['type']    = 'image';
			$_option['answer'] = $this->upload_image_option( $code, $i );

			$_option['value']    = 0;
			if (null !== $this->input->post('option_5') && $this->input->post('option_5') == $i)
				$_option['value'] = 1;
			if (null !== $this->input->post('data_' . $i))
				$_option['id'] = $this->input->post('data_' . $i);
			$_data_option[] = $_option;
		}
		return $_data_option;
	}

	public function get_short_answer_option($question_id, $code)
	{
		$data[] = [
			'question_id' => $question_id,
			'type' => 'short_answer',
			'answer' => $this->input->post('option_4'),
			'value' => $this->input->post('value'),
		];
		return $data;
	}

	public function get_essay_option($question_id, $code)
	{
		$data[] = [
			'question_id' => $question_id,
			'type' => 'short_answer',
			'answer' => $this->input->post('option_4'),
			'value' => $this->input->post('value'),
		];
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
		$upload = $this->config->item('upload', 'ion_auth');

		$file = $_FILES[ 'image' ];
		$upload_path = 'uploads/question/';

		$config 				= $upload;
		$config['file_name'] 	=  $code."_".time() . "_" . $file['name'];
		$config['upload_path']	= './' . $upload_path;
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload( 'image' ) )
		{
			// $this->set_error( $this->upload->display_errors() );
			// $this->set_error( 'upload_unsuccessful' );
			return FALSE;
		}
		else
		{
			if(NULL !== $this->input->post('image_old')){
				if($this->input->post('image_old') != 'default.jpg')
					@unlink( $config['upload_path'].$file_name );
			}
			$file_data = $this->upload->data();
			return $file_data['file_name'];
		}
	}
	public function upload_image_option( $code, $index = 0 )
	{
		$upload = $this->config->item('upload', 'ion_auth');

		$file = $_FILES[ 'option' ]['name'][$index];
		if($file != 'null'){
			$filename = time() . "_" . $file;
		} else {
			$filename = 'default.jpg';
		}
		$upload_path = 'uploads/answer/';

		$config 				= $upload;
		$config['file_name'] 	= $filename;
		$config['upload_path']	= './' . $upload_path;
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_multi_upload( 'option' ) )
		{
			// $this->set_error( $this->upload->display_errors() );
			// $this->set_error( 'upload_unsuccessful' );
			return FALSE;
		}
		else
		{
			$file_data = $this->upload->data();
			return $file_data['file_name'];
		}
	}
}
