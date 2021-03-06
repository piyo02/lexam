<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_answer_model extends MY_Model
{
  protected $table = "student_answer";

  function __construct() {
      parent::__construct( $this->table );
      parent::set_join_key( 'student_answer_id' );
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
  public function student_answer( $id = NULL  )
  {
    if (isset($id))
    {
      $this->where($this->table.'.id', $id);
    }

    $this->limit(1);
    $this->order_by($this->table.'.id', 'desc');

    $this->student_answers(  );

    return $this;
  }
  public function student_answer_by_test_id( $test_id = null, $user_id = null, $question_id = null )
  {
    if (isset($test_id))
    {
      $this->where($this->table.'.test_id', $test_id);
    }
    if (isset($user_id))
    {
      $this->where($this->table.'.user_id', $user_id);
    }
    if (isset($question_id))
    {
      $this->where($this->table.'.question_id', $question_id);
    }
    $this->order_by($this->table.'.id', 'desc');

    $this->student_answers(  );

    return $this;
  }
  public function lists_question_by_test_id( $test_id = null, $user_id = null, $question_id = null )
  {
    $this->select( $this->table . '.question_id' );
    if (isset($test_id))
    {
      $this->where($this->table.'.test_id', $test_id);
    }
    if (isset($user_id))
    {
      $this->where($this->table.'.user_id', $user_id);
    }
    if (isset($question_id))
    {
      $this->where($this->table.'.question_id', $question_id);
    }
    $this->order_by($this->table.'.id', 'desc');

    $this->student_answers(  );

    return $this;
  }
  public function student_answers( $start = 0 , $limit = NULL )
  {
      if (isset( $limit ))
      {
        $this->limit( $limit );
      }
      $this->offset( $start );
      $this->order_by($this->table.'.id', 'asc');
      return $this->fetch_data();
  }

  public function get_skor( $user_id = null, $test_id = null )
  {
    $this->select('SUM(skor) AS skor');
    if (isset($test_id))
    {
      $this->where($this->table.'.test_id', $test_id);
    }
    if (isset($user_id))
    {
      $this->where($this->table.'.user_id', $user_id);
    }
    $this->student_answers(  );

    return $this;
  }
}
?>
