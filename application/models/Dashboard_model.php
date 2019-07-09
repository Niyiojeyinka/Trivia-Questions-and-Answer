<?php

class Dashboard_model extends CI_Model {


/***
 * Name:      Pryper
 * Package:    Dashboard_model.php
 * About:        A model class that handle Pryce user  model operation
 * Copyright:  (C) 2017,2018,2019(pryper)
 * Author:     Ojeyinka Philip Olaniyi
 * License:    closed /propietry
 ***/

 public function __construct()
{
    parent::__construct();
    $this->load->database();
    $this->load->library('session');


}
public function send_live($quantity,$receiver)
{
$receiver_new_balance = $receiver['balance_live'] + $quantity;

$this->db->update('users',array('balance_live'=> $receiver_new_balance),array('id' =>$receiver['id']));

}

public function get_country_by_select_value($select_value)
{
$query = $this->db->get_where('countries',array('select_value'=> $select_value));
return $query->row_array();
}

public function get_available_stages($what_to_select)
{
$this->db->select($what_to_select);
$query = $this->db->get('stages');
return $query->result_array();
}
public function get_tips_by_stage($stage_id)
{

  $query = $this->db->get_where('tips',array('stage_id' => $stage_id ));
  return $query->result_array();
}

public function insert_vote($votes)
{
//loop through votes
  //check if not already exists
  //if already exists dont insert just add 
  //to array of error
  //if  not exists just add
$error_messages =[];
foreach ($votes as $vote) {
 $check = $this->db->get_where('votes',array('voter_id'=>$_SESSION['id'] ,'stage_id'  => $vote['stage_id']));
 $check = $check->row_array();
//get stages label here later
$label = $this->db->get_where('stages',array('id' => $vote['stage_id'] ))->row_array()['label'] ;

if(empty($check))
{
  if(!empty($vote['tip_id']))
  {
     //insert vote here
  $this->db->insert('votes',$vote);
  //set Success messages
  $err = "<span style='color:green'>Your vote for ".$label." has been recorded Successfully</span><br>";
  array_push($error_messages, $err);

  }
 
}else{
  //collate error message here

   $err = "<span style='color:red'>You can only vote for ".$label." once</span><br>";
  array_push($error_messages, $err);
}

$_SESSION['error_messages'] = $error_messages;
$this->session->mark_as_temp('error_messages',100);
//$this->session->mark_as_flash('error_messages');

}

}


public function get_tips_votes($tip_id)
{

  $query= $this->db->get_where('votes', array('tip_id' => $tip_id));
  return $query->result_array();
}


public function update_payment_details()
{

if($_POST['payment_type'] == "bank")
{

$datab = array(
"bank_name" => $_POST['bank_name'],
"bank_acct" => $_POST['account_number'],
"bank_det" => $_POST['account_name'], 
"bank_no" => $_POST['swift_code'], 
"payment_type" =>  $_POST['payment_type']
);


}elseif($_POST['payment_type'] == "paypal")
{

$datab = array(
"bank_acct" => $_POST['paypal_email'],
"payment_type" =>  $_POST['payment_type']
);

  
}elseif($_POST['payment_type'] == "western_union")
{
$datab = array(
"bank_acct" => $_POST['address'],
"payment_type" =>  $_POST['payment_type']
);
}

$this->db->update("users",$datab,array('id' => $_SESSION['id']));
}










}
