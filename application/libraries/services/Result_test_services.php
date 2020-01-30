<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Result_test_services
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
        'name' => 'Nama Ulangan',
        'classroom_name' => 'Kelas',
        'total' => 'Jumlah Siswa'
      );
      $table["number"] = $start_number;
      $table[ "action" ] = array(
              array(
                "name" => 'Cetak Hasil',
                "type" => "link",
                "url" => site_url( $_page."export/"),
                "button_color" => "success",
                "param" => "id",
                "title" => "Group",
                "data_name" => "name",
              ),
              array(
                "name" => 'Analisa Soal',
                "type" => "link",
                "url" => site_url( "teacher/analysis/test/"),
                "button_color" => "success",
                "param" => "id",
                "title" => "Group",
                "data_name" => "name",
              ),
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
                  "param" => array(
                    'type' => 'hidden',
                    'label' => "id",
                    'value' => 'test_id' 
                  ),
                ),
                "title" => "Group",
                "data_name" => "name",
              ),
    );
    return $table;
  }
  public function get_table_result_config( $_page, $start_number = 1 )
  {
      $table["header"] = array(
        'user_fullname' => 'Nama Siswa',
        'value' => 'Nilai',
      );
      $table["number"] = $start_number;
      $table[ "action" ] = array(
        array(
          "name" => 'Review',
          "type" => "link",
          "url" => site_url( $_page."review/"),
          "button_color" => "success",
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
            "param" => array(
              'type' => 'hidden',
              'label' => "id",
              'value' => 'id' 
            ),
          ),
          "title" => "Group",
          "data_name" => "user_fullname",
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
