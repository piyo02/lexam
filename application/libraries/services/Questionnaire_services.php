<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Questionnaire_services
{


  function __construct(){

  }

  public function __get($var)
  {
    return get_instance()->$var;
  }
  public function list_course( $user_id = null )
	{
    $this->load->model('teacher_course_model');
		$courses = $this->teacher_course_model->teacher_course_by_user_id( $user_id)->result();
		$list_course[''] = "-- Pilih Mata Pelajaran --";
		foreach ($courses as $key => $course) {
			$list_course[$course->course_id] = $course->course_name;
		}
		return $list_course;
	}
	public function list_classroom( $edu_ladder_id = null )
	{
    $this->load->model('classroom_model');
		$classrooms = $this->classroom_model->classrooms_by_edu_ladder( 0, null, $edu_ladder_id)->result();
		$list_classroom[''] = "-- Pilih Kelas --";
		foreach ($classrooms as $key => $classroom) {
			$list_classroom[$classroom->id] = $classroom->name;
		}
		return $list_classroom;
	}
  public function get_table_config( $_page, $start_number = 1, $user_id = null, $edu_ladder_id = null )
  {
    $table["header"] = array(
      'name' => 'Nama Bank Soal',
      'course_name' => 'Mata Pelajaran',
      'description' => 'Materi',
      'classroom_name' => 'Kelas',
      // 'status' => 'Status',
    );
    $table["number"] = $start_number;
    $table[ "action" ] = array(
      array(
        "name" => 'Buat Soal',
        "type" => "link",
        "url" => site_url( "teacher/question/questionnaire/"),
        "button_color" => "success",
        "param" => "id",
      ),
      array(
        "name" => 'Edit',
        "type" => "modal_form",
        "modal_id" => "edit_",
        "url" => site_url( $_page."edit/"),
        "button_color" => "primary",
        "param" => "id",
        "form_data" => array(
          "id" => array(
              'type' => 'hidden',
              'label' => "id",
          ),
          "classroom_id" => array(
            'type' => 'select',
            'label' => "Kelas",
            'options' => $this->list_classroom( $edu_ladder_id ),
    
          ),
          "course_id" => array(
            'type' => 'select',
            'label' => "Mata Pelajaran",
            'options' => $this->list_course( $user_id ),
          ),
          "name" => array(
            'type' => 'text',
            'label' => "Nama Bank Soal",
          ),
          "description" => array(
            'type' => 'textarea',
            'label' => "Materi",
          ),
          "status" => array(
            'type' => 'select',
            'label' => "Status",
            'options' => array(
              0 => 'Tidak Aktif',
              1 => 'Aktif',
            ),
          ),
        ),
        "title" => "Group",
        "data_name" => "name",
      ),
      array(
        "name" => 'X',
        "type" => "modal_delete",
        "modal_id" => "delete_",
        "url" => site_url( $_page."delete/"),
        "button_color" => "danger",
        "param" => "id",
        "form_data" => array(
          "id" => array(
            'type' => 'hidden',
            'label' => "id",
          ),
        ),
        "title" => "Group",
        "data_name" => "name",
      ),
    );
    return $table;
  }
  public function validation_config( ){
    $config = array(
      array(
        'field' => 'user_id',
        'label' => 'Id Pengguna',
        'rules' =>  'trim|required',
      ),
      array(
        'field' => 'classroom_id',
        'label' => 'Kelas',
        'rules' =>  'trim|required',
      ),
      array(
        'field' => 'course_id',
        'label' => 'Mata Pelajaran',
        'rules' =>  'trim|required',
      ),
      array(
        'field' => 'name',
        'label' => 'Nama Bank Soal',
        'rules' =>  'trim|required',
      ),
      array(
        'field' => 'description',
        'label' => 'Materi Bank Soal',
        'rules' =>  'trim|required',
      ),
      array(
        'field' => 'status',
        'label' => 'status',
        'rules' =>  'trim|required',
      ),
    );
    
    return $config;
  }
  public function get_form_data($user_id = null, $edu_ladder_id = null)
  {
    $form_data = array(
      "classroom_id" => array(
        'type' => 'select',
        'label' => "Kelas",
        'options' => $this->list_classroom( $edu_ladder_id ),

      ),
      "course_id" => array(
        'type' => 'select',
        'label' => "Mata Pelajaran",
        'options' => $this->list_course( $user_id ),
      ),
      "user_id" => array(
        'type' => 'hidden',
        'label' => "user_id",
        'value' => $user_id,
      ),
      "name" => array(
        'type' => 'text',
        'label' => "Nama Bank Soal",
        'value' => "",
      ),
      "description" => array(
        'type' => 'textarea',
        'label' => "Materi",
        'value' => "-",
      ),
      "status" => array(
        'type' => 'select',
        'label' => "Status",
        'options' => array(
          0 => 'Tidak Aktif',
          1 => 'Aktif',
        ),
      ),
    );
    return $form_data;
  }
}
?>
