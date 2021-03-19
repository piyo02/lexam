<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Analysis_services
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
        'name' => 'Nama Group',
        'description' => 'Deskripsi',
        // 'code' => 'Kode Soal',
        // 'total_correct' => 'Total Benar',
        // 'total_wrong' => 'Total Salah',
        // 'skor' => 'Skor',
      );
      $table["number"] = $start_number;
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
