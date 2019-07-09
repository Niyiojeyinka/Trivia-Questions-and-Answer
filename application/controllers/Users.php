<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
/*

Name:Citedlink
Date:Start Rewriting  it on Oct 6, 2017 1:09:25 PM



*/



public function __construct()
{
     parent::__construct();

    $this->load->model(array('users_model','board_model','pages_model'));
        $this->load->helper(array('url','form','page_helper'));
     $this->load->library(array('form_validation','session'));
  //   session_start();

}





	public function register($slug = null)
	{
$this->form_validation->set_rules("firstname","Firstname","required");
$this->form_validation->set_rules("lastname","Lastname","required");

$this->form_validation->set_rules("email","Email","trim|required|is_unique[users.email]");
$this->form_validation->set_rules("phone","Mobile Phone Number","required|is_unique[users.phone]");


$this->form_validation->set_rules("password","Account Password","trim|required");

$this->form_validation->set_rules("cpassword","Account Password Comfirmation","trim|required|matches[password]");


if ($this->form_validation->run() == FALSE)
{


             
      $data["title"] ="Pryper | Create New Account";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

    
             
       $this->load->view('common/headmeta_view',$data);
        $this->load->view('common/public_mobile_header_view',$data);
             $this->load->view('public/register_view',$data);
        $this->load->view('common/public_mobile_footer_view',$data);




}
else
{



if ($this->users_model->register() === false)
{


  $_SESSION['err_msg'] ='Unknown Error Occurred,
   Please try again later';
  $this->session->mark_as_flash('err_msg');
  show_page("register");
}
else{




//show next kyc

$_SESSION["id"] = $this->users_model->get_user_id_by_email($this->input->post('email'));


$_SESSION["logged_in"] = true;

               
      $data["title"] ="Pryper | Create New Account";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

    
          
       $this->load->view('common/headmeta_view',$data);
        $this->load->view('common/public_mobile_header_view',$data);
        $this->load->view('public/more_kyc_view',$data);
        $this->load->view('common/public_mobile_footer_view',$data);




}

}//close parent else block

 }

public function more_kyc()
{
$this->form_validation->set_rules("country","Country","required");

if (!$this->form_validation->run()) {
          
      $data["title"] ="Pryper | Create New Account";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

    
          
       $this->load->view('common/headmeta_view',$data);
        $this->load->view('common/public_mobile_header_view',$data);
        $this->load->view('public/more_kyc_view',$data);
        $this->load->view('common/public_mobile_footer_view',$data);
}else{

$user = $this->users_model->get_user_by_id();

if(!empty($this->input->post('referral_code')))
{
//user input referral_code

  //check if referral_code is correct
  $hold = $this->users_model->get_user_by_username_link($this->input->post('referral_code'));
  if (!empty($hold)) {
    //referral code is corrrect
    $referral= $hold;
    /**
    *increase temp_ref_count every time new user use this code.
    *once its 3 decrease it to zero credit referral one live 
    *
   **/

    $new_temp_ref_count = $referral['temp_ref_count'] + 1;
if ($new_temp_ref_count == 3) {

$this->users_model->edit_user(array('temp_ref_count' => 0),$referral['id']);
//credit referral 1 bold
$this->users_model->edit_user(array('balance_live' => $referral['balance_live']+1),$referral['id']);
/*
-----------history--------------
*/
$history = array(
'user_id' => $referral['id'],
'details' => 'Invitation of '.$user['firstname'].' '.$user['lastname'].' and last two others Give you One BOLD LIVE',
'action'=>'affilate',
'time' => time()
);
$this->users_model->insert_to_history($history);
/*
-----------history end--------------
*/
/*
-----------notification--------------
*/
$noti = array(
      'sender_id' => $_SESSION['id'],
      'receiver_id' => $referral['id'],
      'contents' =>  'Invitation of '.$user['firstname'].' '.$user['lastname'].' and last two others Give you One BOLD LIVE',
      'type' => 'new_user',
      'slug' => '',
      'status' => 'unread',
      'time' => time()
              );
  $this->db->insert('notifications', $noti);

/*
-----------notification end--------------
*/


}else{
/*
-----------history--------------
*/

$history = array(
'user_id' => $referral['id'],
'details' => $user['firstname'].' '.$user['lastname'].' used your Referral Code',
'action'=>'affilate',
'time' => time()
);
$this->users_model->insert_to_history($history);


/*
this history when users refer is not yet three
-----------history end--------------
*/
/*
-----------notification--------------
*/
$noti = array(
                      'sender_id' => $_SESSION['id'],
                      'receiver_id' => $referral['id'],
                      'contents' =>  $user['firstname'].' '.$user['lastname'].' used your Referral Code',
                      'type' => 'new_user',
                      'slug' => '',
                      'status' => 'unread',
                      'time' => time()
              );
              $this->db->insert('notifications', $noti);

/*
-----------notification end--------------
*/
  $this->users_model->edit_user(array('temp_ref_count' => $new_temp_ref_count),$referral['id']);
}

  }
  unset($hold);
}

$this->users_model->edit_user(array('country' =>$this->input->post('country')),$_SESSION['id']);



show_page('dashboard');

}

}




	public function login($slug = null)
	{

$this->form_validation->set_rules("password","Password","required");
$this->form_validation->set_rules("email","Email Address","trim|required");

if ($this->form_validation->run() == FALSE)
{

         
      $data["title"] ="Pryper | Sign In";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

    
             
       $this->load->view('common/headmeta_view',$data);
        $this->load->view('common/public_mobile_header_view',$data);
             $this->load->view('public/login_view',$data);
        $this->load->view('common/public_mobile_footer_view',$data);

}else
{

if($this->users_model->login_check())
{


//success page
    $_SESSION["id"] = $this->users_model->get_user_id_by_email($this->input->post('email'));

 $_SESSION["logged_in"] = true;
 show_page("dashboard");

}
else{
//incorrect password error msg
$_SESSION['err_msg'] = 'Incorrect Login Information';
$this->session->mark_as_flash('err_msg');

show_page("users/login");


}

}

 }

}
