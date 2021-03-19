<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_model extends MY_Model
{
  protected $table = "test";

  function __construct() {
      parent::__construct( $this->table );
      parent::set_join_key( 'test_id' );
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
    if( !$this->delete_foreign( $data_param, ['question_reference_model'] ) )
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
  public function test( $id = NULL  )
  {
      if (isset($id))
      {
        $this->where($this->table.'.id', $id);
      }

      $this->limit(1);
      $this->order_by($this->table.'.id', 'desc');

      $this->tests(  );

      return $this;
  }
  public function test_by_classroom_id( $classroom_id = NULL, $class_ladder_id = NULL, $school_id = NULL, $student_id = NULL, $start = 0, $limit = NULL  )
  {
    if($student_id){
      $this->select("(SELECT value FROM test_result WHERE test_result.test_id = test.id AND test_result.user_id = $student_id) result_student");
    }
      if (isset($classroom_id))
      {
        $this->db->where($this->table.'.classroom_id', $classroom_id);
        $this->db->or_where($this->table.'.class_ladder_id', $class_ladder_id);
      }
      if($school_id)
        $this->where('teacher_profile.school_id', $school_id);

      $this->join(
        'teacher_profile',
        'teacher_profile.user_id = test.user_id',
        'inner'
      );
      // $this->join(
      //   'test_result',
      //   'test_result.test_id = test.id',
      //   'left'
      // );
      // $this->where('test_result.value IS NULL');
      $this->order_by($this->table.'.id', 'desc');

      $this->tests( $start, $limit );

      return $this;
  }

  public function tests( $start = 0 , $limit = NULL, $user_id = NULL )
  {
    $this->select('CONCAT( users.first_name, " ", users.last_name ) as user_fullname');
    $this->select($this->table . '.*');
    $this->select('classroom.name AS classroom_name');
    $this->select("(SELECT name FROM class_ladder WHERE id = test.class_ladder_id) class_ladder_name");
    $this->select("(SELECT id FROM class_ladder WHERE id = test.class_ladder_id) class_ladder_id");
    $this->select('courses.name AS course_name');
      if (isset( $limit ))
      {
        $this->limit( $limit );
      }
      $this->join(
        'users',
        'users.id = test.user_id',
        'inner'
      );
      $this->join(
        'classroom',
        'classroom.id = test.classroom_id',
        'inner'
      );
      $this->join(
        'courses',
        'courses.id = test.course_id',
        'inner'
      );
      if (isset($user_id))
      {
        $this->where($this->table.'.user_id', $user_id);
      }
      $this->offset( $start );
      $this->order_by($this->table.'.id', 'asc');
      return $this->fetch_data();
  }

}
?>
