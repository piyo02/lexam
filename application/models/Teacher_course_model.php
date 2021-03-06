<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_course_model extends MY_Model
{
  protected $table = "teacher_course";

  function __construct() {
      parent::__construct( $this->table );
      parent::set_join_key( 'teacher_course_id' );
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
  public function create_batch( $data )
  {
    $this->db->insert_batch($this->table, $data);
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

  public function update_batch( $data, $data_param  )
  {
    $this->db->update_batch($this->table, $data, $data_param );
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
    if( !$this->delete_foreign( $data_param ) )
    {
      $this->set_error("gagal");//('group_delete_unsuccessful');
      return FALSE;
    }
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
   * group
   *
   * @param int|array|null $id = id_groups
   * @return static
   * @author madukubah
   */
  public function teacher_course( $id = NULL  )
  {
      if (isset($id))
      {
        $this->where($this->table.'.id', $id);
      }

      $this->limit(1);
      $this->order_by($this->table.'.id', 'desc');

      $this->teacher_courses(  );

      return $this;
  }
  public function teacher_course_by_user_id( $user_id = NULL, $course_id = null  )
  {
    $this->select($this->table . '.id');
    $this->select('courses.id as course_id');
    $this->select('courses.name as course_name');
    $this->select('courses.description as course_description');
      if (isset($user_id))
      {
        $this->where($this->table.'.user_id', $user_id);
      }
      if (isset($course_id))
      {
        $this->where($this->table.'.course_id', $course_id);
      }
      $this->order_by($this->table.'.user_id', 'desc');
      $this->join(
        'courses',
        'courses.id = teacher_course.course_id',
        'inner'
      );
      $this->teacher_courses(  );

      return $this;
  }
  // /**
  //  * teacher_courses
  //  *
  //  *
  //  * @return static
  //  * @author madukubah
  //  */
  // public function teacher_courses(  )
  // {
      
  //     $this->order_by($this->table.'.id', 'asc');
  //     return $this->fetch_data();
  // }

  /**
   * teacher_courses
   *
   *
   * @return static
   * @author madukubah
   */
  public function teacher_courses( $start = 0 , $limit = NULL )
  {
      if (isset( $limit ))
      {
        $this->limit( $limit );
      }
      $this->offset( $start );
      $this->order_by($this->table.'.id', 'asc');
      return $this->fetch_data();
  }

}
?>
