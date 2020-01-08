<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test_services
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

  public function get_table_config( $_page, $start_number = 1 )
  {
      $table["header"] = array(
        'name' => 'Nama Ulangan',
        'classroom_name' => 'Kelas',
        'date' => 'Tanggal',
      );
      $table["number"] = $start_number;
      $table[ "action" ] = array(
              array(
                "name" => 'Detail',
                "type" => "link",
                "url" => site_url( $_page."detail/"),
                "button_color" => "primary",
                "param" => "id",
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
          'field' => 'name',
          'label' => 'name',
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
          'field' => 'date',
          'label' => 'Tanggal',
          'rules' =>  'trim|required',
        ),
        array(
          'field' => 'duration',
          'label' => 'Durasi',
          'rules' =>  'trim|required',
        ),
        array(
          'field' => 'kkm',
          'label' => 'Nilai KKM',
          'rules' =>  'trim|required',
        ),
        array(
          'field' => 'max_value',
          'label' => 'Nilai Maksimal',
          'rules' =>  'trim|required',
        ),
    );
    
    return $config;
  }

  public function form_data( $user_id = null, $edu_ladder_id = null, $data = null )
  {

    if($data){
      $id = $data->id;
      $name = $data->name;
      $classroom_id = $data->classroom_id;
      $course_id = $data->course_id;
      $date = $data->date;
      $duration = $data->duration;
      $kkm = $data->kkm;
      $max_value = $data->max_value;

    } else {
      $id = null;
      $name = null;
      $classroom_id = null;
      $course_id = null;
      $date = null;
      $duration = null;
      $kkm = null;
      $max_value = null;
    }
    
    $list_course = $this->list_course( $user_id );
    $list_classroom = $this->list_classroom( $edu_ladder_id );
    $form_data = array(
      'id' => array(
        'type' => 'hidden',
        'label' => 'id Ulangan',
        'value' => $id
      ),
      'name' => array(
        'type' => 'text',
        'label' => 'Nama Ulangan',
        'value' => $name
      ),
      'classroom_id' => array(
        'type' => 'select',
        'label' => 'Kelas',
        'options' => $list_classroom,
        'selected' => $classroom_id
      ),
      'course_id' => array(
        'type' => 'select',
        'label' => 'Mata Pelajaran',
        'options' => $list_course,
        'selected' => $course_id
      ),
      'date' => array(
        'type' => 'date',
        'label' => 'Waktu Mulai',
        'value' => $date
      ),
      'duration' => array(
        'type' => 'number',
        'label' => 'Durasi',
        'value' => $duration
      ),
      'kkm' => array(
        'type' => 'number',
        'label' => 'Nilai KKM',
        'value' => $kkm
      ),
      'max_value' => array(
        'type' => 'number',
        'label' => 'Nilai Maksimal',
        'value' => $max_value
      ),
    );

    return $form_data;
  }

  public function form_data_readonly( $data = null )
  {
    $id = $data->id;
    $name = $data->name;
    $classroom_name = $data->classroom_name;
    $course_name = $data->course_name;
    $date = $data->date;
    $duration = $data->duration;
    $kkm = $data->kkm;
    $max_value = $data->max_value;
  
    $form_data = array(
      'name' => array(
        'type' => 'text',
        'label' => 'Nama Ulangan',
        'value' => $name
      ),
      'classroom_id' => array(
        'type' => 'text',
        'label' => 'Kelas',
        'value' => $classroom_name
      ),
      'course_id' => array(
        'type' => 'text',
        'label' => 'Mata Pelajaran',
        'value' => $course_name
      ),
      'date' => array(
        'type' => 'text',
        'label' => 'Waktu Mulai',
        'value' => $date
      ),
      'duration' => array(
        'type' => 'number',
        'label' => 'Durasi',
        'value' => $duration
      ),
      'kkm' => array(
        'type' => 'number',
        'label' => 'Nilai KKM',
        'value' => $kkm
      ),
      'max_value' => array(
        'type' => 'number',
        'label' => 'Nilai Maksimal',
        'value' => $max_value
      ),
    );
    return $form_data;
  }
}
?>
