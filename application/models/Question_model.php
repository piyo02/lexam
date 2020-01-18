<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_model extends MY_Model
{
  protected $table = "question";

  function __construct() {
      parent::__construct( $this->table );
      parent::set_join_key( 'question_id' );
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
  public function delete( $data_param )
  {
    //exists
    if( !$this->exist_data( $data_param, ['question_answer', 'student_answer'] ) )
    {
      $this->set_error("Soal ini memiliki data yang penting");//('group_delete_unsuccessful');
      return FALSE;
    }

    //foreign
    //delete_foreign( $data_param. $models[]  )
    if( !$this->delete_foreign( $data_param, ['question_answer_model'] ) )
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
  public function question( $id = NULL  )
  {
    $this->select($this->table . '.*');
    $this->select('question_answer.id AS option_id');
    $this->select('CONCAT("'.base_url('uploads/question/').'", "", question.image) AS image_quest');
    $this->select('question_answer.type as type_option');
    $this->select('question_answer.answer');
    $this->select('CONCAT("'.base_url('uploads/answer/').'", "", question_answer.answer) AS image_answer');
    if (isset($id))
      {
        $this->where($this->table.'.id', $id);
      }
      $this->join(
        'question_answer',
        'question_answer.question_id = question.id',
        'inner'
      );
      $this->order_by($this->table.'.id', 'desc');

      $this->questions(  );

      return $this;
  }

  public function questions( $start = 0 , $limit = NULL )
  {
      if (isset( $limit ))
      {
        $this->limit( $limit );
      }
      $this->offset( $start );
      $this->order_by($this->table.'.id', 'desc');
      return $this->fetch_data();
  }
  public function exist_db($data_param)
  {
    $this->db->select('*');
    $this->db->where("EXISTS(SELECT id FROM " . $this->table . " WHERE questionnaire_id=" . $data_param . ")");
    return $this->db->get($this->table);
  }
  public function question_by_questionnaire_id( $start = 0, $limit = NULL, $questionnaire_id = NULL )
  {
    $this->select('question.image AS image_quest_old');
    $this->select('question_answer.answer AS image_opt_old');
    $this->select('CONCAT("'.base_url('uploads/question/').'", "", question.image) AS image_quest');
    $this->select('CONCAT("'.base_url('uploads/answer/').'", "", question_answer.answer) AS image_answer');
    $this->select($this->table . '.*');
    $this->select('question_answer.type as type_option');
    $this->select('question_answer.answer');
    $this->select('question_answer.value');
    $this->join(
      'question_answer',
      'question_answer.question_id = question.id',
      'inner'
    );
    $this->where('question_answer.value >', 0);
    if( $questionnaire_id )
      $this->db->where('questionnaire_id', $questionnaire_id);
    $this->questions( $start, $limit );
    return $this;
  }
  public function record_count_by_questionnaire_id( $questionnaire_id = NULL )
  {
    $this->db->distinct();
    $this->db->where('questionnaire_id', $questionnaire_id);
		return $this->db->count_all_results( $this->table );
  }
}
?>
