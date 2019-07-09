<?php

class Question_model extends CI_Model {


/***
 * Name:      Pryper
 * Package:    Question_model.php
 * About:        A model class that handle Pryce user  model operation
 * Copyright:  (C) 2017,2018,2019
 * Author:     Ojeyinka Philip Olaniyi
 * License:    closed /propietry
 ***/

 public function __construct()
{
    parent::__construct();
    $this->load->database();
    $this->load->library('session');

    $holder = array(

    "lastlog" => time()



    )  ;


      $this->db->update("users",$holder,array("id" => $this->session->id));


}

public function delete_item($table_name, $item_cond)
{
$this->db->delete($table_name,$item_cond);
}
public function get_questions_id($condition_array)
{
$this->db->select('id');
  $query = $this->db->get_where('questions',$condition_array);

return $query->result_array();

}
public function save_quiz_session($arr)
{
$this->db->insert('quiz_session_holder',$arr);
}
public function edit_quiz_session($arr,$id)
{
$this->db->update('quiz_session_holder',$arr,array('user_id' => $id));
}

public function get_saved_quiz_session_by_user_id($id)
{
$query = $this->db->get_where('quiz_session_holder',array('user_id' =>$id));
return $query->row_array();
}
public function get_question_by_its_id($id)
{
  $query = $this->db->get_where('questions',array('id' => $id));
  return $query->row_array();
}
public function get_stages_by_country($country)
{
  //in next update do a cleanup country not neccessary again
  $query= $this->db->get_where('stages',array('country' => $country));
  return $query->result_array();
}
public function get_stages()
{
  $query= $this->db->get('stages');
  return $query->result_array();
}



}
