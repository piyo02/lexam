<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Student_services
{


  function __construct(){

  }

  public function __get($var)
  {
    return get_instance()->$var;
  }
  
  public function get_table_config( $_page, $start_number = 1 )
  {
      $table["header"] = array(
        'name' => 'Nama Kelas',
        'description' => 'Deskripsi',
      );
      $table["number"] = $start_number;
      $table[ "action" ] = array(
        array(
          "name" => 'Lihat Siswa',
          "type" => "link",
          "modal_id" => "edit_",
          "url" => site_url( $_page."classroom/"),
          "button_color" => "primary",
          "param" => "id",
          "title" => "Group",
          "data_name" => "name",
        ),
    );
    return $table;
  }

  public function get_table_student_config( $_page, $start_number = 1 )
  {
      $table["header"] = array(
        'user_fullname' => 'Nama Siswa',
        'email' => 'Email',
      );
      $table["number"] = $start_number;
      $table[ "action" ] = array(
        array(
          "name" => 'Lihat Nilai',
          "type" => "link",
          "modal_id" => "edit_",
          "url" => site_url( $_page."detail/"),
          "button_color" => "primary",
          "param" => "id",
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
          'field' => 'description',
          'label' => 'description',
          'rules' =>  'trim|required',
        ),
    );
    
    return $config;
  }
}
?>
