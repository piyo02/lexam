<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends School_admin_Controller 
{
	private $services = null;
    private $name = null;
    private $parent_page = 'school_admin';
	private $current_page = 'school_admin/users/';
	private $_user_groups = array();
    private $school_id = null;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('services/User_services');
		$this->services = new User_services;
		$this->load->model(array(
			'group_model',
			'classroom_model',
			'student_profile_model',
			'teacher_profile_model',
		));
		$this->_user_groups = array(
			"farmer" => 'Petani',
			"suplier" => 'Suplier',
			"transporter" => 'Transporter',
		);
		$this->data[ "menu_list_id" ] =  'users_index';
		$this->school_id = $this->ion_auth->get_school_id();
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
		$table = $this->services->get_table_group_config( $this->current_page );
		$table[ "rows" ] = $this->group_model->groups( $pagination['start_record'], $pagination['limit_per_page'] )->result();
		unset( $table[ "rows" ][0] );
		unset( $table[ "rows" ][1] );
		unset( $table[ "rows" ][4] );
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		$add_menu = array(
			"name" => "Tambah Group",
			"modal_id" => "add_group_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => array(
				"name" => array(
					'type' => 'text',
					'label' => "Nama Group",
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

		// $this->data[ "header_button" ] =  $add_menu;
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Group";
		$this->data["header"] = "Group";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "templates/contents/plain_content" );
	}
	public function users( $users_group = NULL )
	{		 // 
		 if($users_group == 3){
			$table = $this->services->get_table_teacher_config( $this->current_page );
			$table[ "rows" ] = $this->teacher_profile_model->teacher_by_school_id($this->school_id)->result();
		}
		if($users_group == 4){
			$table = $this->services->get_table_classroom_config( $this->current_page );
			$table[ "rows" ] = $this->classroom_model->classrooms_by_school_id(0, null, $this->school_id)->result();
		}
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;

		$link_add = 
		array(
			"name" => "Tambah",
			"type" => "link",
			"url" => site_url( $this->current_page."add/".$users_group),
			"button_color" => "primary",	
			"data" => NULL,
		);
		if($users_group != 4)
			$this->data[ "header_button" ] =  $this->load->view('templates/actions/link', $link_add, TRUE ); ;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "User Management";
		$this->data["header"] = "User Management";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "templates/contents/plain_content" );
	}
	public function classroom( $classroom_id )
	{
		$users_group = 4;
		$classroom = $this->classroom_model->classroom( $classroom_id )->row();

		$page = ($this->uri->segment(4 + 1)) ? ($this->uri->segment(4 + 1) -  1 ) : 0;
		// echo $page; return;
        //pagination parameter
        $pagination['base_url'] = base_url( $this->current_page ) .'/classroom';
        $pagination['total_records'] = $this->group_model->record_count() ;
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page*$pagination['limit_per_page'];
        $pagination['uri_segment'] = 5;
		//set pagination
		if ($pagination['total_records'] > 0 ) $this->data['pagination_links'] = $this->setPagination($pagination);

		$table = $this->services->get_table_student_config( $this->current_page, $pagination['start_record'] );
		$table[ "rows" ] = $this->student_profile_model->student_by_classroom_id( $pagination['start_record'], $pagination['limit_per_page'], $this->school_id, $classroom_id )->result();
		// var_dump($table[ "rows" ]); die;
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;

		$link_add = 
		array(
			"name" => "Tambah Siswa",
			"type" => "link",
			"url" => site_url( $this->current_page."add/" . $users_group . '?classroom_id=' . $classroom_id ),
			"button_color" => "primary",	
			"data" => NULL,
		);
		$this->data[ "header_button" ] =  $this->load->view('templates/actions/link', $link_add, TRUE ); ;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "User Management";
		$this->data["header"] = "Siswa " . $classroom->name;
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "templates/contents/plain_content" );
	}

	public function add($users_group = null)
	{
		$list_classroom[] = '-- Pilih Kelas Perwalian --';
		$classrooms = $this->classroom_model->classrooms_by_school_id( 0, null, $this->school_id )->result();
		foreach ($classrooms as $key => $classroom) {
			$list_classroom[$classroom->id] = $classroom->name;
		}

		$tables = $this->config->item('tables', 'ion_auth');
    $identity_column = $this->config->item('identity', 'ion_auth');
    $this->form_validation->set_rules( $this->ion_auth->get_validation_config() );
    $this->form_validation->set_rules('phone', "No Telepon", 'trim|required');
    $this->form_validation->set_rules('email', "Email", 'trim|required|is_unique[users.email]');

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
      if($this->input->post('users_group') == 4){
		$student_profile = array(
          'user_id' => $user_id,
          'school_id' => $this->input->post('school_id'),
          'classroom_id' => $this->input->post('classroom_id'),
        );

        $this->student_profile_model->create( $student_profile );
      }
      
      if($this->input->post('users_group') == 3){
		$teacher_profile = array(
          'user_id' => $user_id,
          'school_id' => $this->input->post('school_id'),
          'nip' => $this->input->post('nip'),
        );

        $this->teacher_profile_model->create( $teacher_profile );
      }
	  
	  if( $this->input->post('classroom_id') ){
			$data['user_id'] = $user_id;
		
			$data_param['id'] = $this->input->post('classroom_id');

			$this->classroom_model->update( $data, $data_param );
	  }

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

		$form_teacher['form_data'] = array(
			"school_id" => array(
				'type' => 'hidden',
				'label' => 'Sekolah',
				'value' => $this->school_id,
			),
			"nip" => array(
				'type' => 'text',
				'label' => 'NIP',
			),
			'classroom_id' => array(
				'type' => 'select',
				'label' => 'Kelas',
				'options' => $list_classroom
			),
			"users_group" => array(
				'type' => 'hidden',
				'label' => 'users_group',
				'value' => $users_group
			),
		);
		$form_student['form_data'] = array(
			"school_id" => array(
				'type' => 'hidden',
				'label' => 'Sekolah',
				'value' => $this->school_id,
			),
			"classroom_id" => array(
				'type' => 'hidden',
				'label' => 'Kelas',
				'value' => $this->input->get( "classroom_id" ),
			),
			"users_group" => array(
				'type' => 'hidden',
				'label' => 'users_group',
				'value' => $users_group
			),
		);

		$form_data = $this->ion_auth->get_form_data();
		unset($form_data['form_data']['group_id']['options'][2]);

		if($users_group == 3){
			unset($form_data['form_data']['group_id']['options'][4]);
			$form_data[ 'form_data' ] = array_merge( $form_data[ 'form_data' ] , $form_teacher[ 'form_data' ] );
		}
		if($users_group == 4){
			unset($form_data['form_data']['group_id']['options'][3]);
			$form_data[ 'form_data' ] = array_merge( $form_data[ 'form_data' ] , $form_student[ 'form_data' ] );
		}
		$form_data = $this->load->view('templates/form/plain_form', $form_data , TRUE ) ;

		$this->data[ "contents" ] =  $form_data;
      
		$this->render( "templates/contents/plain_content_form" );
    }
	}

	public function edit( $user_id = NULL )
    {
        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->form_validation->set_rules( $this->ion_auth->get_validation_config() );
        $this->form_validation->set_rules('phone', "No Telepon", 'trim|required|is_unique[users.phone]');
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
			// check to see if we are updating the user
			if ( $this->ion_auth->update( $user_id, $data, $identity_mode) )
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
			$form_data[ 'form_data' ] = array_merge( $form_data[ 'form_data' ] , $form_password[ 'form_data' ] );
			$form_data = $this->load->view('templates/form/plain_form', $form_data , TRUE ) ;
            $this->data[ "contents" ] =  $form_data;
            $this->render( "templates/contents/plain_content_form" );
        }
	}

	public function detail( $user_id = NULL )
	{		
		if( !($user_id) ) redirect(site_url('uadmin'));  

		$form_data = $this->services->get_form_data_readonly(  $user_id );
		$form_data = $this->load->view('templates/form/plain_form_readonly', $form_data , TRUE ) ;

		$this->data[ "contents" ] =  $form_data;
		
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Detail User ";
		$this->data["header"] = "Detail User ";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->render( "templates/contents/plain_content" );
	}
	public function delete(  )
	{
		if( !($_POST) ) redirect(site_url('uadmin'));  

		$group_id 	= $this->input->post('group_id');
		$id_user 	= $this->input->post('id');
		$models = array();
		
		if($group_id == 3 ){
			$models = array(
				'teacher_course_model',
				'teacher_profile_model',
				'questionnaire_model',
			);
		}
		if($group_id == 4){
			$models = array(
				'student_profile_model',
				'student_answer_model',
				'solve_test_model',
			);
		}
		if( $this->ion_auth->delete_user( $id_user, $models ) ){
			$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->ion_auth->messages() ) );
		}else{
			$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->ion_auth->errors() ) );
		}
		redirect( site_url( $this->current_page  )  );
	}
}
