<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_result_model extends MY_Model
{
  protected $table = "test_result";

  function __construct() {
      parent::__construct( $this->table );
      parent::set_join_key( 'test_result_id' );
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
    if( !$this->delete_foreign( $data_param, ['menu_model'] ) )
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
  public function test_result( $id = NULL  )
  {
      if (isset($id))
      {
        $this->where($this->table.'.id', $id);
      }

      $this->limit(1);
      $this->order_by($this->table.'.id', 'desc');

      $this->test_results(  );

      return $this;
  }
  // /**
  //  * test_results
  //  *
  //  *
  //  * @return static
  //  * @author madukubah
  //  */
  // public function test_results(  )
  // {
      
  //     $this->order_by($this->table.'.id', 'asc');
  //     return $this->fetch_data();
  // }

  /**
   * test_results
   *
   *
   * @return static
   * @author madukubah
   */
  public function test_results( $start = 0 , $limit = NULL )
  {
      if (isset( $limit ))
      {
        $this->limit( $limit );
      }
      $this->offset( $start );
      $this->order_by($this->table.'.id', 'asc');
      return $this->fetch_data();
  }
  public function test_result_by_student_id( $student_id = NULL )
  {
    $this->db->select($this->table . '.*');
    $this->db->select('CONCAT( users.first_name, " ", users.last_name ) as user_fullname');
    $this->db->from(
      "(
        SELECT test_result.*, test.name, test.date, test.kkm, courses.name AS course_name 
        FROM test 
        INNER JOIN courses ON courses.id = test.course_id
        INNER JOIN test_result ON test_result.test_id = test.id
        ) test_result"
    );
    $this->db->join(
      'users',
      'users.id = test_result.user_id',
      'inner'
    );
    return $this->db->get();
  }
  public function test_result_by_teacher_id( $teacher_id = NULL  )
  {
    $this->db->select('COUNT(*) AS total');
    $this->db->select($this->table . '.test_id');
    $this->db->select('test.user_id');
    $this->db->select('classroom.name AS classroom_name');
      if (isset($teacher_id))
      {
        $this->db->where('test.user_id', $teacher_id);
      }
      $this->db->join(
        'test_result',
        'test_result.test_id = test.id',
        'inner'
      );
      $this->db->join(
        'classroom',
        'classroom.id = test.classroom_id',
        'inner'
      );
      $this->db->group_by('test_result.test_id');
      return $this->db->get('test');
  }
  public function test_result_by_test_id( $test_id = NULL )
  {
    $this->db->select($this->table . '.*');
    $this->db->select('CONCAT( users.first_name, " ", users.last_name ) as user_fullname');
      if (isset($test_id))
      {
        $this->db->where('test_id', $test_id);
      }
      $this->db->join(
        'test',
        'test.id = test_result.test_id',
        'inner'
      );
      $this->db->join(
        'users',
        'users.id = test_result.user_id',
        'inner'
      );
      return $this->db->get($this->table);
  }
  public function test_result_by_course_id( $user_id = null, $course_id = null )
  {
    $this->select($this->table . '.*' );
    $this->select('test.course_id' );
    $this->select('test.name' );
    if (isset($user_id))
    {
      $this->where($this->table.'.user_id', $user_id);
    }
    if (isset($course_id))
    {
      $this->where('test.course_id', $course_id);
    }
    $this->join(
      'test',
      'test.id = test_result.test_id',
      'inner'
    );
    $this->order_by($this->table.'.id', 'desc');

    $this->test_results(  );

    return $this;
  }

}
?>
