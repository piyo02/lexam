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
			'headmaster_profile_model',
			'courses_model',
			'teacher_profile_model',
			'teacher_course_model',
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
		if($users_group == 6){
			$table = $this->services->get_table_config( $this->current_page );
			$table[ "rows" ] = $this->headmaster_profile_model->headmasters( $this->school_id )->result();
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
        $pagination['base_url'] = base_url( $this->current_page ) .'classroom/'.$classroom_id;
        $pagination['total_records'] = $this->student_profile_model->student_by_classroom_id( NULL, NULL, $this->school_id, $classroom_id )->num_rows();
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page*$pagination['limit_per_page'];
        $pagination['uri_segment'] = 5;
		//set pagination
		if ($pagination['total_records'] > 0 ) $this->data['pagination_links'] = $this->setPagination($pagination);

		$table = $this->services->get_table_student_config( $this->current_page, $pagination['start_record']+1 );
		$table[ "rows" ] = $this->student_profile_model->student_by_classroom_id( $pagination['start_record'], $pagination['limit_per_page'], $this->school_id, $classroom_id )->result();
		// var_dump($table[ "rows" ]); die;
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		// var_dump($table); die;

		$link_add =
		array(
			"name" => "Tambah Siswa",
			"type" => "link",
			"url" => site_url( $this->current_page."add/" . $users_group . '?classroom_id=' . $classroom_id ),
			"button_color" => "primary",
			"data" => NULL,
		);
		$btn_add =  $this->load->view('templates/actions/link', $link_add, TRUE ); ;

		$btn_export = array(
			"name" => "Import Siswa",
			'modal_id' => 'btn_import_',
			"url" => site_url( 'import/import_student/' ),
			"button_color" => "success",
			"form_data" => array(
				'file' => array(
					'type' => 'file',
					'label' => 'File Import',
				),
				'classroom_id' => array(
					'type' => 'hidden',
					'label' => 'Id Kelas',
					'value' => $classroom_id
				),
				'school_id' => array(
					'type' => 'hidden',
					'label' => 'Id Sekolah',
					'value' => $this->school_id,
				),
			),
			"data" => NULL,
		);
		$btn_export =  $this->load->view('templates/actions/modal_form_multipart', $btn_export, TRUE );
		$this->data[ "header_button" ] =  $btn_export . ' ' . $btn_add;
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

		$courses = $this->courses_model->courses_by_school_id( 0, null, $this->school_id )->result();
		foreach ($courses as $key => $course) {
			$list_course[$course->id] = $course->name;
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

	  if( $this->input->post('course_id') ){
		$teacher_course = array(
			'user_id' => $user_id,
			'course_id' => $this->input->post( 'course_id' )
		);
	  }


		$this->teacher_course_model->create( $teacher_course );

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
		$this->data["sub_header"] = '';

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
			'course_id' => array(
				'type' => 'select',
				'label' => 'Mata Pelajaran yang Diajar',
				'options' => $list_course,
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

		$this->render( "school_admin/user/add" );
    }
	}

	public function edit( $user_id = NULL )
    {
		$list_classroom[] = '-- Pilih Kelas --';
		$classrooms = $this->classroom_model->classrooms_by_school_id( 0, null, $this->school_id )->result();
		foreach ($classrooms as $key => $classroom) {
			$list_classroom[$classroom->id] = $classroom->name;
		}

		$courses = $this->courses_model->courses_by_school_id( 0, null, $this->school_id )->result();
		foreach ($courses as $key => $course) {
			$list_course[$course->id] = $course->name;
		}

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

			if($group_id == 3){
				$teacher_profile = array(
					'nip' => $this->input->post('nip'),
				);
				$teacher_profile_param['id'] = $this->input->post('teacher_profile_id');
				$this->teacher_profile_model->update( $teacher_profile, $teacher_profile_param );
				$classroom_id = $this->input->post('classroom_id');
				if($classroom_id){
					$guardian['user_id'] = $user_id;
					$classroom_param['id'] = $classroom_id;
					$this->classroom_model->update( $guardian, $classroom_param );

					$old_classroom = $this->input->post('old_classroom_id');
					if( $old_classroom && $old_classroom != $classroom_id ){
						$guardian['user_id'] = null;
						$classroom_param['id'] = $old_classroom;
						$this->classroom_model->update( $guardian, $classroom_param );
					}
				}else {
					$old_classroom = $this->classroom_model->classroom_by_user_id( $user_id )->row();
					if( $old_classroom ){
						$guardian['user_id'] = null;
						$classroom_param['id'] = $old_classroom->id;
						$this->classroom_model->update( $guardian, $classroom_param );
					}
				}
				$total_course = $this->input->post('total_course');
				for ($i=0; $i < $total_course; $i++) {
					$teacher_course[] = array(
						'id' => $this->input->post('teacher_course_id_' . $i),
						'course_id' => $this->input->post('course_id_' . $i),
					);
				}
				$this->teacher_course_model->update_batch( $teacher_course, 'id' );

			}
			if( $group_id == 4 ){
				$classroom_id = $this->input->post('classroom_id');
				$student_profile = array(
					'classroom_id' => $classroom_id
				);
				$student_profile_id['id'] = $this->input->post('student_profile_id');
				$this->student_profile_model->update( $student_profile, $student_profile_id );
			}

            if ( $this->input->post('password') )
            {
              $data['password'] = $this->input->post('password');
			}
			if( !$this->ion_auth->in_group( ["admin", "uadmin", 'teacher', 'student'] , $user_id ) )
			{
				$identity_mode = NULL;
			}
			// check to see if we are updating the user
			if ( $this->ion_auth->update( $user_id, $data, $identity_mode) )
			{
              // redirect them back to the uadmin page if uadmin, or to the base url if non uadmin
			  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->ion_auth->messages() ) );
			  if( $group_id == 3 ){
				redirect( site_url( $this->current_page . 'users/' . $group_id ) );
			  }elseif( $group_id == 4 ) {
				  redirect( site_url( $this->current_page . 'classroom/' . $classroom_id ) );
			  }
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
			if( $form_data['form_data']['group_id']['selected'] == 3 ){
				$teacher_profile = $this->teacher_profile_model->teacher_profile_by_user_id( $user_id )->row();
				$form_teacher['form_data'] = array(
					"school_id" => array(
						'type' => 'hidden',
						'label' => 'Sekolah',
						'value' => $this->school_id,
					),
					"teacher_profile_id" => array(
						'type' => 'hidden',
						'label' => 'Sekolah',
						'value' => $teacher_profile->id,
					),
					"nip" => array(
						'type' => 'text',
						'label' => 'NIP',
						'value' => $teacher_profile->nip,
					),
				);
				$classroom = $this->classroom_model->classroom_by_user_id( $user_id )->row();
				$form_teacher['form_data']['classroom_id'] = array(
					'type' => 'select',
					'label' => 'Kelas Perwalian',
					'options' => $list_classroom,
				);
				if($classroom){
					$form_teacher['form_data']['classroom_id']['selected'] = $classroom->id;
					$form_teacher['form_data']['old_classroom_id'] = array(
						'type' => 'hidden',
						'label' => 'Wali Kelas',
						'value' => $classroom->id,
					);
				}
				$courses = $this->teacher_course_model->teacher_course_by_user_id( $user_id )->result();
				$i = 0;
				foreach ($courses as $key => $course) {
					$form_teacher['form_data']['teacher_course_id_' . $i ] = array(
						'type' => 'hidden',
						'label' => 'Mata Pelajaran yang Diajar',
						'value' => $course->id
					);
					$form_teacher['form_data']['course_id_' . $i ] = array(
						'type' => 'select',
						'label' => 'Mata Pelajaran yang Diajar',
						'options' => $list_course,
						'selected' => $course->course_id
					);
					$i++;
				}
				$form_teacher['form_data']['total_course' ] = array(
					'type' => 'hidden',
					'label' => 'Jumlah Mata Pelajaran yang Diajar',
					'value' => $i,
				);
				$form_data[ 'form_data' ] = array_merge( $form_data[ 'form_data' ] , $form_teacher[ 'form_data' ] );

				$add_course = array(
					"name" => "Tambah Mata Pelajaran",
					'modal_id' => 'add_course_',
					"url" => site_url( $this->current_page . 'add_teacher_course/' ),
					"button_color" => "primary",
					"form_data" => array(
						"course_id" => array(
							'type' => 'select',
							'label' => 'Mata Pelajaran yang Diajar',
							'options' => $list_course,
						),
						'user_id' => array(
							'type' => 'hidden',
							'label' => 'Id User',
							'value' => $user_id,
						)
					),
					"data" => NULL,
				);
				$add_course =  $this->load->view('templates/actions/modal_form', $add_course, TRUE );

				$delete_course = array(
					"name" => "Hapus Mata Pelajaran",
					'modal_id' => 'delete_course_',
					"url" => site_url( $this->current_page . 'delete_teacher_course/' ),
					"button_color" => "danger",
					"form_data" => array(
						"course_id" => array(
							'type' => 'select',
							'label' => 'Mata Pelajaran yang Diajar',
							'options' => $list_course,
						),
						'user_id' => array(
							'type' => 'hidden',
							'label' => 'Id User',
							'value' => $user_id,
						)
					),
					"data" => NULL,
				);
				$delete_course =  $this->load->view('templates/actions/modal_form', $delete_course, TRUE );

				$this->data[ "header_button" ] =  $delete_course . ' ' .$add_course;
			}
			elseif( $form_data['form_data']['group_id']['selected'] == 4 ){
				$student_profile = $this->student_profile_model->student_profile( $user_id )->row();
				$form_student['form_data'] = array(
					"classroom_id" => array(
						'type' => 'select',
						'label' => 'Kelas',
						'options' => $list_classroom,
						'selected' => $student_profile->classroom_id,
					),
					"student_profile_id" => array(
						'type' => 'hidden',
						'label' => 'student_profile Id',
						'value' => $student_profile->id,
					),
				);
				$form_data[ 'form_data' ] = array_merge( $form_data[ 'form_data' ] , $form_student[ 'form_data' ] );
			}
			$form_data[ 'form_data' ] = array_merge( $form_data[ 'form_data' ] , $form_password[ 'form_data' ] );
			$form_data = $this->load->view('templates/form/plain_form', $form_data , TRUE ) ;
			$this->data[ "contents" ] =  $form_data;


			$alert = $this->session->flashdata('alert');
			$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
            $this->render( "templates/contents/plain_content_form" );
        }
	}

	public function detail( $user_id = NULL )
	{
		if( !($user_id) ) redirect(site_url('uadmin'));

		$form_data = $this->services->get_form_data_readonly(  $user_id );

		if( $form_data['form_data']['group_id']['value'] == 3 ){
			$teacher_profile = $this->teacher_profile_model->teacher_profile_by_user_id( $user_id )->row();
			$form_teacher['form_data'] = array(
				"school_id" => array(
					'type' => 'hidden',
					'label' => 'Sekolah',
					'value' => $this->school_id,
				),
				"nip" => array(
					'type' => 'text',
					'label' => 'NIP',
					'value' => $teacher_profile->nip,
				),
			);
			$classroom = $this->classroom_model->classroom_by_user_id( $user_id )->row();
			if($classroom){
				$form_teacher['form_data']['classroom_id'] = array(
					'type' => 'text',
					'label' => 'Wali Kelas',
					'value' => $classroom->name
				);
			}
			$courses = $this->teacher_course_model->teacher_course_by_user_id( $user_id )->result();
			foreach ($courses as $key => $course) {
				$form_teacher['form_data']['course_id' . $course->id ] = array(
					'type' => 'text',
					'label' => 'Mata Pelajaran yang Diajar',
					'value' => $course->course_name
				);
			}
			$form_data[ 'form_data' ] = array_merge( $form_data[ 'form_data' ] , $form_teacher[ 'form_data' ] );
		}
		elseif( $form_data['form_data']['group_id']['value'] == 4 ){
			$student_profile = $this->student_profile_model->student_profile( $user_id )->row();
			$form_student['form_data'] = array(
				"school_id" => array(
					'type' => 'hidden',
					'label' => 'Sekolah',
					'value' => $this->school_id,
				),
				"classroom_id" => array(
					'type' => 'text',
					'label' => 'Kelas',
					'value' => $student_profile->classroom_name,
				),
			);
			$form_data[ 'form_data' ] = array_merge( $form_data[ 'form_data' ] , $form_student[ 'form_data' ] );
		}

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

			$data['user_id'] = NULL;
			$data_param = $this->classroom_model->classroom_by_user_id( $id_user )->row();

			$this->classroom_model->update( $data, $data_param );
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
			if($group_id == 3 ){
				$data['user_id'] = $id_user;
				$data_param = $this->classroom_model->classroom( $data_param['id'] )->row();

				$this->classroom_model->update( $data, $data_param );
			}
			$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->ion_auth->errors() ) );
		}
		redirect( site_url( $this->current_page  )  );
	}

	public function add_teacher_course()
	{
		$user_id = $this->input->post('user_id');
		$data = array(
			'user_id' => $user_id,
			'course_id' => $this->input->post('course_id'),
		);
		$this->teacher_course_model->create( $data );

		$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, 'Mata Pelajaran Berhasil ditambahkan' ) );
		redirect( site_url( $this->current_page . 'edit/' . $user_id ) );
	}

	public function delete_teacher_course()
	{
		$user_id = $this->input->post('user_id');
		$course_id = $this->input->post('course_id');

		$course = $this->teacher_course_model->teacher_course_by_user_id( $user_id, $course_id )->row();
		if($course){
			$data_param = [
				'user_id' => $user_id,
				'course_id' => $course_id,
			];
			$this->teacher_course_model->delete( $data_param );
			$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, 'Mata Pelajaran yang diajar Berhasil dihapus' ) );
		}else {
			$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, 'Mata Pelajaran Tidak diajar Oleh Guru yang Bersangkutan' ) );
		}
		redirect( site_url( $this->current_page . 'edit/' . $user_id ) );
	}
}
