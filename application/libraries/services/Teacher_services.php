<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Teacher_services
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
      'user_fullname' => 'Nama Guru',
      'image' => 'Foto',
    );
    $table["number"] = $start_number;
    $table[ "action" ] = array(
      array(
        "name" => 'Lihat Ulangan',
        "type" => "link",
        "url" => site_url( $_page."test/"),
        "button_color" => "primary",
        "param" => "id",
        "title" => "Group",
        "data_name" => "name",
      ),
    );
    return $table;
  }
  public function get_table_test_config( $_page, $start_number = 1 )
  {
    $table["header"] = array(
      'name' => 'Nama Ulangan',
      'classroom_name' => 'Kelas',
      'date' => 'Tanggal',
    );
    $table["number"] = $start_number;
    $table[ "action" ] = array(
      array(
        "name" => 'Lihat Hasil',
        "type" => "link",
        "url" => site_url( $_page."result/"),
        "button_color" => "success",
        "param" => "id",
        "title" => "Group",
        "data_name" => "name",
      ),
    );
    return $table;
  }
  public function get_table_result_config( $_page, $start_number = 1 )
  {
    $table["header"] = array(
      'user_fullname' => 'Nama Ulangan',
      'value' => 'Nilai',
    );
    $table["number"] = $start_number;
    $table[ "action" ] = array(
      array(
        "name" => 'review',
        "type" => "link",
        "url" => site_url( $_page."review/"),
        "button_color" => "success",
        "param" => "id",
        "title" => "Group",
        "data_name" => "name",
      ),
    );
    return $table;
  }
}
?>
