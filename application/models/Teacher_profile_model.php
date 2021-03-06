<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_profile_model extends MY_Model
{
  protected $table = "teacher_profile";

  function __construct() {
      parent::__construct( $this->table );
      parent::set_join_key( 'menu_id' );
  }

  /**
   * create
   *
   * @param array  $data
   * @return static
   * @author madukubah
   */
  public function create( $data )
  {
      // Filter the data passed
      $data = $this->_filter_data($this->table, $data);

      $this->db->insert($this->table, $data);
      $id = $this->db->insert_id($this->table . '_id_seq');
    
      if( isset($id) )
      {
        $this->set_message("berhasil");
        return $id;
      }
      $this->set_error("gagal");
          return FALSE;
  }
  /**
   * update
   *
   * @param array  $data
   * @param array  $data_param
   * @return bool
   * @author madukubah
   */
  public function update( $data, $data_param  )
  {
    $this->db->trans_begin();
    $data = $this->_filter_data($this->table, $data);

    $this->db->update($this->table, $data, $data_param );
    if ($this->db->trans_status() === FALSE)
    {
      $this->db->trans_rollback();

      $this->set_error("gagal");
      return FALSE;
    }

    $this->db->trans_commit();

    $this->set_message("berhasil");
    return TRUE;
  }
  /**
   * delete
   *
   * @param array  $data_param
   * @return bool
   * @author madukubah
   */
  public function delete( $data_param  )
  {
    //foreign
    //delete_foreign( $data_param. $models[]  )
    // if( !$this->delete_foreign( $data_param, ['menu_model'] ) )
    // {
    //   $this->set_error("gagal");//('group_delete_unsuccessful');
    //   return FALSE;
    // }
    //foreign
    $this->db->trans_begin();

    $this->db->delete($this->table, $data_param );
    if ($this->db->trans_status() === FALSE)
    {
      $this->db->trans_rollback();

      $this->set_error("gagal");//('group_delete_unsuccessful');
      return FALSE;
    }

    $this->db->trans_commit();

    $this->set_message("berhasil");//('group_delete_successful');
    return TRUE;
  }

  /**
   * student_profile
   *
   *
   * @return static
   * @author madukubah
   */
  public function teacher_profile( $id = NULL )
  {
    if (isset($id))
    {
      $this->where($this->table.'.id', $id);
    }
    $this->order_by($this->table.'.id', 'asc');
    return $this->fetch_data();
  }
  public function teacher_profile_by_user_id( $user_id = NULL )
  {
    if (isset($user_id))
    {
      $this->where($this->table.'.user_id', $user_id);
    }
    $this->order_by($this->table.'.user_id', 'asc');
    return $this->fetch_data();
  }
  public function teacher_by_school_id( $school_id = NULL)
  {
    $this->db->select($this->table . '.nip');
    $this->db->select('users.*');
    $this->db->select([
      'users.id as id',
      'users.id as user_id',
      'users.image as image_file',
      'CONCAT( users.first_name, " ", users.last_name ) as user_fullname',
      'CONCAT( "'.base_url('uploads/users_photo/').'", image ) as image',
      'groups.description  as group_name',
      'groups.id  as group_id',
    ]);
    $this->db->join(
      'users',
      'users.id = teacher_profile.user_id',
      'inner'
    );
    $this->db->join(
      'users_groups',
      'users_groups.user_id = users.id',
      'inner'
    );
    $this->db->join(
      'groups',
      'groups.id = users_groups.group_id',
      'inner'
    );
    $this->db->order_by($this->table.'.id', 'asc');
    if (isset($school_id))
    {
      $this->db->where($this->table.'.school_id', $school_id);
    }
    $this->db->where('group_id', '3');
    return $this->db->get($this->table);
  }
}
?>
