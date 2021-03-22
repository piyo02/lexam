<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_services
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
          'login' => 'Email',
          'ip_address' => 'IP Address',
        );
        $table["number"] = $start_number;
        $table[ "action" ] = array(
                array(
                  "name" => 'X',
                  "type" => "modal_delete",
                  "modal_id" => "delete_",
                  "url" => site_url( $_page."delete/"),
                  "button_color" => "danger",
                  "param" => "id",
                  "form_data" => array(
                    "login" => array(
                      'type' => 'hidden',
                      'label' => "login",
                    ),
                  ),
                  "title" => "Login Attempts",
                  "data_name" => "login",
                ),
      );
      return $table;
    }
}
?>
