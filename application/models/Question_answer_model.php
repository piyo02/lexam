<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_answer_model extends MY_Model
{
  protected $table = "question_answer";

  function __construct() {
      parent::__construct( $this->table );
      parent::set_join_key( 'question_answer_id' );
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

      // $this->db->insert($this->table, $data);    
      $this->db->insert_batch($this->table, $data);

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
  public function update_answer( $data, $data_param  )
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
  public function question_answer( $id = NULL  )
  {
      if (isset($id))
      {
        $this->where($this->table.'.id', $id);
      }

      $this->limit(1);
      $this->order_by($this->table.'.id', 'desc');

      $this->question_answers(  );

      return $this;
  }
  public function question_answers( $start = 0 , $limit = NULL )
  {
      if (isset( $limit ))
      {
        $this->limit( $limit );
      }
      $this->offset( $start );
      $this->order_by($this->table.'.id', 'asc');
      return $this->fetch_data();
  }

  public function question_answer_by_question_id( $question_id = NULL  )
  {
    $this->select('*');
    $this->select('CONCAT("'.base_url('uploads/answer/').'", "", question_answer.answer) AS image_answer');
    $this->select('answer AS image_old');
      if (isset($question_id))
      {
        $this->where($this->table.'.question_id', $question_id);
      }

      $this->order_by($this->table.'.id', 'desc');

      $this->question_answers(  );

      return $this;
  }
  
  public function get_num_type( $questionnaire_id = null, $condition = null, $condition2 = null )
  {
    $this->db->select('DISTINCT(question.id)');
    $this->db->select($this->table . '.type');
    $this->db->select('question.questionnaire_id');
    $this->db->join(
      'question',
      'question.id = question_answer.question_id',
      'inner'
    );
    $this->db->where('question.questionnaire_id', $questionnaire_id);
    
    if( $condition )
      $this->db->where('question_answer.type', $condition);
    if( $condition2 )
      $this->db->or_where('question_answer.type', $condition2);
    return $this->db->get( $this->table );
  }
  public function question_id_mc( $questionnaire_id, $limit )
  {
    $this->db->select('DISTINCT(question.id)');
    $this->db->join(
      'question',
      'question.id = question_answer.question_id',
      'join'
    );
    if($questionnaire_id)
      $this->db->where( 'questionnaire_id', $questionnaire_id );

    $this->db->where('(`question_answer`.`type` = "text" OR `question_answer`.`type` = "image")');
    $this->db->order_by('id', 'RANDOM');
    return $this->db->get($this->table, $limit);
  }

  public function question_id_sa( $questionnaire_id, $limit )
  {
    $this->db->select('DISTINCT(question.id)');
    $this->db->join(
      'question',
      'question.id = question_answer.question_id',
      'join'
    );
    if($questionnaire_id)
      $this->db->where( 'questionnaire_id', $questionnaire_id );
      
    $this->db->where('question_answer.type', 'short_answer');
    $this->db->order_by('id', 'RANDOM');
    return $this->db->get($this->table, $limit);
  }


  public function question_id_es( $questionnaire_id, $limit )
  {
    $this->db->select('DISTINCT(question.id)');
    $this->db->join(
      'question',
      'question.id = question_answer.question_id',
      'join'
    );
    if($questionnaire_id)
      $this->db->where( 'questionnaire_id', $questionnaire_id );

    $this->db->where('question_answer.type', 'essay');
    $this->db->order_by('id', 'RANDOM');
    return $this->db->get($this->table, $limit);
  }
}
?>
