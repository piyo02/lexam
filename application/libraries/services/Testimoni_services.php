<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Testimoni_services
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
        'name' => 'Nama Pengguna',
        'image' => 'Foto Pengguna',
        'status' => 'Status',
        'testimoni' => 'Testimoni',
      );
      $table["number"] = $start_number;
      $table[ "action" ] = array(
              array(
                "name" => 'Edit',
                "type" => "modal_form_multipart",
                "modal_id" => "edit_",
                "url" => site_url( $_page."edit/"),
                "button_color" => "primary",
                "param" => "id",
                "form_data" => array(
                    "id" => array(
                        'type' => 'hidden',
                        'label' => "id",
                    ),
                    "name" => array(
                      'type' => 'text',
                      'label' => "Nama",
                    ),
                    "status" => array(
                      'type' => 'text',
                      'label' => "Status",
                    ),
                    "testimoni" => array(
                      'type' => 'textarea',
                      'label' => "Testimoni",
                    ),
                    "image" => array(
                      'type' => 'file',
                      'label' => "Foto",
                    ),
                    "image_old" => array(
                      'type' => 'text',
                      'label' => "Foto",
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
                  "image_old" => array(
                    'type' => 'text',
                    'label' => "Foto",
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
          'field' => 'testimoni',
          'label' => 'testimoni',
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
}
?>
