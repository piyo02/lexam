<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Headmaster extends Uadmin_Controller {
	private $services = null;
    private $name = null;
    private $parent_page = 'uadmin';
	private $current_page = 'uadmin/headmaster/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Headmaster_services');
		$this->services = new Headmaster_services;
		$this->load->model(array(
			'group_model',
			'school_model',
			'edu_ladder_model',
			'headmaster_profile_model'
		));
		$this->data[ "menu_list_id" ] =  'headmaster_index';

	}
	public function index()
	{
		$edu_ladders = $this->edu_ladder_model->edu_ladders()->result();
		foreach ($edu_ladders as $key => $edu_ladder) {
			$list_edu_ladder[$edu_ladder->id] = $edu_ladder->name;
		}

		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) -  1 ) : 0;
		// echo $page; return;
        //pagination parameter
        $pagination['base_url'] = base_url( $this->current_page ) .'/index';
        $pagination['total_records'] = $this->school_model->record_count() ;
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page*$pagination['limit_per_page'];
        $pagination['uri_segment'] = 4;
		//set pagination
		if ($pagination['total_records'] > 0 ) $this->data['pagination_links'] = $this->setPagination($pagination);
		#################################################################3
		$table = $this->services->get_table_config( $this->current_page );
		$table[ "rows" ] = $this->headmaster_profile_model->headmasters( )->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		$add_menu = array(
			"name" => "Tambah Kepala Sekolah",
			"type" => "link",
			"url" => site_url( $this->current_page."add/"),
			"button_color" => "primary",	
			"data" => NULL,
		);

		$add_menu= $this->load->view('templates/actions/link', $add_menu, true ); 

		$this->data[ "header_button" ] =  $add_menu;
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Kepala Sekolah";
		$this->data["header"] = "Daftar Kepala Sekolah";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "templates/contents/plain_content" );
	}

	public function list_schools()
	{
		$schools = $this->school_model->schools()->result();
		foreach ($schools as $key => $school) {
			$list_school[$school->id] = $school->name;
		}
		return $list_school;
	}

	public function add(  )
	{
		$tables = $this->config->item('tables', 'ion_auth');
		$identity_column = $this->config->item('identity', 'ion_auth');
		$this->form_validation->set_rules( $this->ion_auth->get_validation_config() );
		$this->form_validation->set_rules('phone', "No Telepon", 'trim|required');
		$this->form_validation->set_rules('email', "Email", 'trim|required|is_unique[users.email]');

		$list_school = $this->list_schools();

		if ( $this->form_validation->run() === TRUE )
		{
			$group_id = $this->input->post('group_id');

			// $email = $this->input->post('email') ;
			// $phone = $this->input->post('phone') ;
			// $identity = $phone ;
			// $password = $phone ;
			$email = $this->input->post('email') ;
			$identity = $email;
			$password = substr( $email, 0, strpos( $identity, "@" ) ) ;


			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'address' => $this->input->post('address'),
			);
		}
		
		$identity_mode = NULL;

		if ($this->form_validation->run() === TRUE && ( $user_id =  $this->ion_auth->register($identity, $password, $email,$additional_data, [$group_id], $identity_mode ) ) )
		{
			$headmaster_profile = array(
				'user_id' => $user_id,
				'school_id' => $this->input->post('school_id'),
				'nip' => $this->input->post('nip'),
			);
			$this->headmaster_profile_model->create( $headmaster_profile );
			
			$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->ion_auth->messages() ) );
			// redirect( s_ite_url( $this->current_page.$this->ion_auth->group( $group_id )->row()->name)  );
			redirect( site_url( $this->current_page  )  );
		}

		else
		{
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			if(  !empty( validation_errors() ) || $this->ion_auth->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );

			$alert = $this->session->flashdata('alert');
			$this->data["key"] = $this->input->get('key', FALSE);
			$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
			$this->data["current_page"] = $this->current_page;
			$this->data["block_header"] = "Tambah User ";
			$this->data["header"] = "Tambah User ";
			$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

			$form_school_admin['form_data'] = array(
				"school_id" => array(
					'type' => 'select',
					'label' => 'Sekolah',
					'options' =>$list_school
				),
				"nip" => array(
					'type' => 'text',
					'label' => 'NIP',
				),
			);

			$form_data = $this->ion_auth->get_form_data();
			$form_data['form_data'] = array_merge($form_data['form_data'], $form_school_admin['form_data']);
			unset($form_data['form_data']['group_id']['options'][2]);

			$form_data = $this->load->view('templates/form/plain_form', $form_data , TRUE ) ;

			$this->data[ "contents" ] =  $form_data;
			
			$this->render( "templates/contents/plain_content_form" );
		}
	}

	public function edit( $user_id )
	{
		$list_school = $this->list_schools();

		$tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->form_validation->set_rules( $this->ion_auth->get_validation_config() );
        $this->form_validation->set_rules('phone', "No Telepon", 'trim|required');
		if ( $this->input->post('password') )
        {
            $this->form_validation->set_rules( 'password',"Kata Sandi",'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]' );            
            $this->form_validation->set_rules( 'password_confirm',"konfirmasi Kata Sandi",'trim|required'); 

        }
        if ( $this->form_validation->run() === TRUE )
        {
			$user_id = $this->input->post('id');
			$group_id = $this->input->post('group_id');
      
            $data = array(
              'first_name' => $this->input->post('first_name'),
              'last_name' => $this->input->post('last_name'),
              'email' => $this->input->post('email'),
              'phone' => $this->input->post('phone'),
              'group_id' => $this->input->post('group_id'),
            );
			
            if ( $this->input->post('password') )
            {
              $data['password'] = $this->input->post('password');
			}
			if( !$this->ion_auth->in_group( ["admin", "uadmin"] , $user_id ) )
			{
				$identity_mode = NULL;
			}

			$headmaster_profile['school_id'] = $this->input->post('school_id');
			$headmaster_profile['nip'] = $this->input->post('nip');

			$headmaster_profile_param['id'] = $this->input->post('headmaster_profile_id');
			// check to see if we are updating the user
			if ( $this->ion_auth->update( $user_id, $data, $identity_mode) && $this->headmaster_profile_model->update( $headmaster_profile, $headmaster_profile_param ) )
			{
              // redirect them back to the uadmin page if uadmin, or to the base url if non uadmin
              $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->ion_auth->messages() ) );
              redirect( site_url( $this->current_page  )  );
            }
            else
            {
              // redirect them back to the uadmin page if uadmin, or to the base url if non uadmin
              $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->ion_auth->errors() ) );
              redirect( site_url($this->current_page)."edit/".$user_id  );
            }
        }
        else
        {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            if(  !empty( validation_errors() ) || $this->ion_auth->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );

            $alert = $this->session->flashdata('alert');
			$this->data["key"] = $this->input->get('key', FALSE);
			$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
			$this->data["current_page"] = $this->current_page;
			$this->data["block_header"] = "Edit User ";
			$this->data["header"] = "Edit User ";
			$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

			$form_data = $this->ion_auth->get_form_data( $user_id );
			$headmaster_profile = $this->headmaster_profile_model->headmaster_profile_by_user_id( $user_id )->row();
			$form_password[ 'form_data' ] = array(
				"password" => array(
				  'type' => 'password',
				  'label' => "Password",
				),
				"password_confirm" => array(
				  'type' => 'password',
				  'label' => "Konfirmasi Password",
				),
			);
			$form_school_admin['form_data'] = array(
				"school_id" => array(
					'type' => 'select',
					'label' => 'Sekolah',
					'options' =>$list_school,
					'select' => $headmaster_profile->school_id,
				),
				"headmaster_profile_id" => array(
					'type' => 'hidden',
					'label' => 'Sekolah',
					'value' => $headmaster_profile->id,
				),
				"nip" => array(
					'type' => 'text',
					'label' => 'NIP',
					'value' => $headmaster_profile->nip,
				),
			);
			$form_data[ 'form_data' ] = array_merge( $form_data[ 'form_data' ] , $form_password[ 'form_data' ] );
			$form_data['form_data'] = array_merge($form_data['form_data'], $form_school_admin['form_data']);
			unset($form_data['form_data']['group_id']['options'][2]);

			$form_data = $this->load->view('templates/form/plain_form', $form_data , TRUE ) ;
            $this->data[ "contents" ] =  $form_data;
            $this->render( "templates/contents/plain_content_form" );
        }
	}

	public function delete(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );
	  
		$data_param['id'] 	= $this->input->post('id');
		if( $this->school_model->delete( $data_param ) ){
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->school_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->school_model->errors() ) );
		}
		redirect( site_url($this->current_page)  );
	}
}
