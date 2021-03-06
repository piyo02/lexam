<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_reference_model extends MY_Model
{
  protected $table = "question_reference";

  function __construct() {
      parent::__construct( $this->table );
      parent::set_join_key( 'question_reference_id' );
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
      // $data = $this->_filter_data($this->table, $data);

      $this->db->insert_batch($this->table, $data);
      // $this->db->insert($this->table, $data);
      // $id = $this->db->insert_id($this->table . '_id_seq');
    
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
  public function question_reference( $id = NULL  )
  {
      if (isset($id))
      {
        $this->where($this->table.'.id', $id);
      }

      $this->limit(1);
      $this->order_by($this->table.'.id', 'desc');

      $this->question_references(  );

      return $this;
  }
  public function question_reference_by_test_id( $test_id = NULL  )
  {
    $this->select($this->table . '.*');
    $this->select('questionnaire.name AS questionnaire_name');
    $this->select('questionnaire.description AS description');
      if (isset($test_id))
      {
        $this->where($this->table.'.test_id', $test_id);
      }
      $this->join(
        'questionnaire',
        'questionnaire.id = '. $this->table . '.questionnaire_id',
        'inner'
      );
      $this->order_by($this->table.'.id', 'desc');

      $this->question_references(  );

      return $this;
  }
  public function question_references( $start = 0 , $limit = NULL )
  {
      if (isset( $limit ))
      {
        $this->limit( $limit );
      }
      $this->offset( $start );
      $this->order_by($this->table.'.id', 'asc');
      return $this->fetch_data();
  }
  
  public function get_total_references( $test_id = null, $questionnaire_id = null )
  {
    $this->db->select_sum('multiple_choice');
    $this->db->select_sum('short_answer');
    $this->db->select_sum('essay');
    
    if($test_id)
      $this->db->where('test_id', $test_id);
    if($questionnaire_id)
      $this->db->where('questionnaire_id', $questionnaire_id);
    
    return $this->db->get( $this->table );
  }
}
?>
