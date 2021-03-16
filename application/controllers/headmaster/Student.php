<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends Headmaster_Controller {
	private $school_id = null;
	private $user_id = null;
    private $services = null;
    private $name = null;
    private $parent_page = 'headmaster';
	private $current_page = 'headmaster/student/';

    function __construct()
    {
        parent::__construct();
        $this->load->library('services/Student_services');
        $this->services = new Student_services;
        $this->load->model(array(
			'student_profile_model',
			'classroom_model',
			'test_model',
			'courses_model',
			'test_result_model',
		));
		$this->data[ "menu_list_id" ] = "student_index";
		$this->school_id = $this->ion_auth->get_school_id_for_headmaster();
		$this->user_id = $this->session->userdata('user_id');
    }

	public function index()
	{
		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) -  1 ) : 0;
		// echo $page; return;
        //pagination parameter
        $pagination['base_url'] = base_url( $this->current_page ) .'/index';
        $pagination['total_records'] = $this->classroom_model->classrooms_by_school_id( 0, NULL, $this->user_id )->num_rows();
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page*$pagination['limit_per_page'];
        $pagination['uri_segment'] = 4;
		//set pagination
		if ($pagination['total_records'] > 0 ) $this->data['pagination_links'] = $this->setPagination($pagination);
		#################################################################3
		$table = $this->services->get_table_config( $this->current_page, ($pagination['start_record'] + 1) );
		$table[ "rows" ] = $this->classroom_model->classrooms_by_school_id( $pagination['start_record'], $pagination['limit_per_page'], $this->school_id )->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		$this->data[ "header_button" ] = '';
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Kelas";
		$this->data["header"] = "Daftar Kelas";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->render( "templates/contents/plain_content" );
	}

	public function classroom( $classroom_id = NULL )
	{
		if( !$classroom_id ) redirect( $this->current_page );

		$classroom = $this->classroom_model->classroom( $classroom_id )->row();

		$page = ($this->uri->segment(4 + 1)) ? ($this->uri->segment(4 + 1) -  1 ) : 0;
		// echo $page; return;
        //pagination parameter
        $pagination['base_url'] = base_url( $this->current_page ) .'/classroom';
        $pagination['total_records'] = $this->student_profile_model->student_by_classroom_id( 0, NULL, $this->school_id, $classroom_id )->num_rows();
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
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Daftar Siswa";
		$this->data["header"] = "Siswa " . $classroom->name;
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->render( "templates/contents/plain_content" );
	}

	public function detail( $student_id = NULL )
	{
		$this->form_validation->set_rules( 'course_id', 'Mata Pelajaran', 'required' );
        if ($this->form_validation->run() === TRUE )
        {
			$course_id = $this->input->post('course_id');

			$tests = $this->test_result_model->test_result_by_course_id( $student_id, $course_id )->result();
			foreach ($tests as $key => $test) {
				$data['test_name'][] = $test->name;
				$data['value'][] = $test->value;
			}
			echo json_encode($data);
		}
        else
        {
			if( !$student_id ) redirect( $this->current_page );

			$courses = $this->courses_model->courses_by_school_id( 0, null, $this->school_id )->result();
			foreach ($courses as $key => $course) {
				$list_course[$course->id] = $course->name;
			}

			$course_id = $this->input->get('course_id');
			$course_id || $course_id = $courses[0]->id;

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
			$this->data[ "course_id" ] = $course_id;
			// return;
			#################################################################3
			$alert = $this->session->flashdata('alert');
			$this->data["key"] = $this->input->get('key', FALSE);
			$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
			$this->data["student_id"] = $student_id;
			$this->data["current_page"] = $this->current_page . 'detail/';
			$this->data["block_header"] = "Ulangan";
			$this->data["header"] = "Hasil Ulangan";
			$this->data["sub_header"] = '';
			$this->render( "teacher/test/result_test" );
		}
	}
}
