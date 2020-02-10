<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Classroom_services
{


  function __construct(){

  }

  public function __get($var)
  {
    return get_instance()->$var;
  }
  public function list_class_ladders()
  {
    $this->load->model( 'class_ladder_model' );

    $class_ladders = $this->class_ladder_model->class_ladders()->result();
		foreach ($class_ladders as $key => $class_ladder) {
			$list_class_ladders[ $class_ladder->id ] = $class_ladder->name;
    }

    return $list_class_ladders;
  }
  public function get_table_config( $_page, $start_number = 1 )
  {
    $list_class_ladders = $this->list_class_ladders();
      $table["header"] = array(
        'name' => 'Nama Kelas',
        'description' => 'Deskripsi',
      );
      $table["number"] = $start_number;
      $table[ "action" ] = array(
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
                    "class_ladder_id" => array(
                      'type' => 'select',
                      'label' => "Jenjang Kelas",
                      'options' => $list_class_ladders,
                    ),
                    "name" => array(
                        'type' => 'text',
                        'label' => "Nama Kelas",
                    ),
                    "description" => array(
                        'type' => 'textarea',
                        'label' => "Deskripsi",
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
