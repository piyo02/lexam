<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solve_test_model extends MY_Model
{
  protected $table = "solve_test";

  function __construct() {
      parent::__construct( $this->table );
      parent::set_join_key( 'solve_test_id' );
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
  public function solve_test( $id = NULL  )
  {
      if (isset($id))
      {
        $this->where($this->table.'.id', $id);
      }

      $this->limit(1);
      $this->order_by($this->table.'.id', 'desc');

      $this->solve_tests(  );

      return $this;
  }

  public function solve_test_by_student_id( $test_id = NULL, $user_id = NULL  )
  {
    $this->select( $this->table . '.*' );
    $this->select( $this->table . '.time_start AS date' );
    $this->select( 'CONCAT( users.first_name, " ", users.last_name ) as student_name' );
    $this->select( 'test.name AS test_name' );
    $this->select( 'test.duration' );
      if (isset($user_id))
      {
        $this->where($this->table.'.user_id', $user_id);
      }
      if (isset($test_id))
      {
        $this->where($this->table.'.test_id', $test_id);
      }
      $this->join(
        'users',
        'users.id = solve_test.user_id',
        'inner'
      );
      $this->join(
        'test',
        'test.id = solve_test.test_id',
        'inner'
      );
      $this->order_by($this->table.'.id', 'desc');

      $this->solve_tests(  );

      return $this;
  }

  public function solve_tests( $start = 0 , $limit = NULL )
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
