<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Guardian_services
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
        'user_fullname' => 'Nama Siswa',
        'image' => 'Foto Siswa',
      );
      $table["number"] = $start_number;
      $table[ "action" ] = array(
        array(
          "name" => 'Lihat Nilai',
          "type" => "link",
          "url" => site_url( $_page."result_test/"),
          "button_color" => "primary",
          "param" => "id",
          "title" => "Group",
          "data_name" => "name",
        ),
    );
    return $table;
  }
}
?>
