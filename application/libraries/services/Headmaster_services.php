<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Headmaster_services
{


  function __construct(){

  }

  public function __get($var)
  {
    return get_instance()->$var;
  }
  public function list_edu_ladder()
  {
    $this->load->model('edu_ladder_model');
    $edu_ladders = $this->edu_ladder_model->edu_ladders()->result();
		foreach ($edu_ladders as $key => $edu_ladder) {
			$list_edu_ladder[$edu_ladder->id] = $edu_ladder->name;
    }
    return $list_edu_ladder;
  }
  public function get_table_config( $_page, $start_number = 1 )
  {
    $list_edu_ladder = $this->list_edu_ladder();
      $table["header"] = array(
        'user_fullname' => 'Nama Kepala Sekolah',
        'email' => 'Email',
        'school_name' => 'Nama Sekolah',
        'nip' => 'NIP',
      );
      $table["number"] = $start_number;
      $table[ "action" ] = array(
              array(
                "name" => 'Edit',
                "type" => "link",
                "modal_id" => "edit_",
                "url" => site_url( $_page."edit/"),
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
          'field' => 'description',
          'label' => 'description',
          'rules' =>  'trim|required',
        ),
    );
    
    return $config;
  }
}
?>
