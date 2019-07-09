<?php

class Admin_question_model extends CI_Model {


/***
 * Name:      Pryce
 * Package:    Question_model.php
 * About:        A model class that handle Pryce user  model operation
 * Copyright:  (C) 2017,2018
 * Author:     Ojeyinka Philip Olaniyi
 * License:    closed /propietry
 ***/

 public function __construct()
{
    parent::__construct();
    $this->load->database();
    $this->load->library('session');



}

//new
public function get_bulk($id)
{
   $query = $this->db->get_where('bulk_questions',array('id' => $id));

return $query->row_array();

}


//new
public function get_questions($condition_array,$offset,$limit)
{
   $query = $this->db->get_where('questions',$condition_array,$limit,$offset);

return $query->result_array();

}


//new
public function get_range($condition_array)
{
   $query = $this->db->get_where('ranges',$condition_array);

return $query->result_array();

}


//new
public function get_bulklist($offset,$limit)
{
    $this->db->order_by('id', 'DESC');

   $query = $this->db->get('bulk_questions',$limit,$offset);

return $query->result_array();

}



public function insert_question()
{


//insert into pages

 $question = array(
  'time_allowed' => $this->input->post('time_allowed'),
'country' => $this->input->post('country'),
'fifty_answer' => $this->input->post('fifty_answer'),
'answer' => $this->input->post('answer'),
'question_img' => $this->upload->data("file_name"),
'option_a' => $this->input->post('option_a'),
'option_b' => $this->input->post('option_b'),
'option_c' => $this->input->post('option_c'),
'option_d' => $this->input->post('option_d'),
'option_e' => $this->input->post('option_e'),
'option_type' => $this->input->post('option_type'),
'question' => $this->input->post('question'),
'comp' => $this->input->post('comp'),
'question_type' => $this->input->post('question_type'),
'level' => $this->input->post('stage'),
'instructions' => $this->input->post('instructions'),
'status' =>$this->input->post('status') ,
 'time' => time()
);


if( $this->db->insert('questions',$question))
{


return true;

}



}


public function edit_question($id,$img_slug)
{
 $question_array = array(
  'time_allowed' => $this->input->post('time_allowed'),
'fifty_answer' => $this->input->post('fifty_answer'),
'answer' => $this->input->post('answer'),
'question_img' => $img_slug,
'option_a' => $this->input->post('option_a'),
'option_b' => $this->input->post('option_b'),
'option_c' => $this->input->post('option_c'),
'option_d' => $this->input->post('option_d'),
'option_e' => $this->input->post('option_e'),
'option_type' => $this->input->post('option_type'),
'question' => $this->input->post('question'),
'comp' => $this->input->post('comp'),
'question_type' => $this->input->post('question_type'),
'level' => $this->input->post('stage'),
'instructions' => $this->input->post('instructions'),
'status' =>$this->input->post('status') ,
 'time' => time()
);



$this->db->update('questions',$question_array,array('id' => $id));
return TRUE;

}
}
