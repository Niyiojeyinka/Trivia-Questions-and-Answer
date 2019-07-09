<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
/*

Name:Pryce
Date:Start Rewriting  it on Oct 6, 2017 1:09:25 PM



*/



public function __construct()
{
     parent::__construct();

    $this->load->model(array('users_model','dashboard_model','pages_model','question_model','board_model'));
    $this->load->helper(array('url','form','page_helper','blog_helper','question_helper'));
     $this->load->library(array('form_validation','session'));
//user login check here

      if (!isset($this->session->id) || !isset($this->session->logged_in))
       {   
show_page('login');
           }

}



public function index($offset = 0)
{



    $limit = 3;




    $data['items'] = $this->board_model->get_topics_front($offset,
    $limit);

      $this->load->library('pagination');

      $config['base_url'] = site_url("board/index");



    $config['total_rows'] = count($this->board_model->get_topics_front(NULL,
    NULL));
    //  $config['total_rows'] = 10;
      $config['per_page'] = $limit;

      $config['uri_segment'] = 3;
      $config['first_tag_open'] = '<span class="w3-btn  w3-theme w3-text-white w3-round-xlarge">';
      $config['first_tag_close'] = '</span>';
      $config['last_tag_open'] = '<br><span class="w3-btn  w3-theme w3-text-white w3-round-xlarge">';
      $config['last_tag_close'] = '</span>';
      $config['first_link'] = 'First';



      $config['prev_link'] = 'Prev';
      $config['next_link'] = 'Next';
      $config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-theme w3-text-white w3-round-xlarge">';
      $config['next_tag_close'] = '</span><br>';
      $config['prev_tag_open'] = '<span style="" class="w3-btn w3-theme w3-text-white w3-round-xlarge">';
      $config['prev_tag_close'] = '</span>';
      $config['num_tag_open'] = '<span style="" class="w3-btn w3-theme w3-text-white w3-round-xlarge">';
      $config['num_tag_close'] = '</span>';
      $config['cur_tag_open'] = '<span style="" class="w3-btn w3-white w3-text-theme w3-round-xlarge">';
      $config['cur_tag_close'] = '</span>';
      $config['last_link'] = 'Last';
      $config['display_pages'] = TRUE;
      //$config["use_page_numbers"] = TRUE;


         $this->pagination->initialize($config);
    $data['pagination'] = $this->pagination->create_links();





  
      $data["title"] ="Pryper | Account Dashboard";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
       $data['user_details'] = $this->users_model->get_user_by_id();
$data['country'] = $this->dashboard_model->get_country_by_select_value($data['user_details']['country']);

$data['quiz_start'] = $data['country']['next_quiz_start'];
$data['quiz_end'] = $data['country']['quiz_end'];
$data['no_unread_notifications'] = $this->users_model->count_unread_notifications($_SESSION['id']);  //minimum bold required

$data['live_required'] = $data['country']['live_required'];

//info text
$data['info_text'] = $data['country']['info_text'];



      $this->load->view('common/headmeta_view',$data);
      $this->load->view('user/common/users_nav_view',$data);
      $this->load->view('common/header_view',$data);
     $this->load->view('user/common/pre_content_view',$data);
      $this->load->view('user/dashboard_view',$data);
      $this->load->view('user/common/post_content_view',$data);
      $this->load->view('common/footer_view',$data);

}
public function ajax_check_if_game_start()
{

    $user_details = $this->users_model->get_user_by_id();

$quiz_start = $this->dashboard_model->get_country_by_select_value($user_details['country'])['next_quiz_start'];
 
$quiz_end = $this->dashboard_model->get_country_by_select_value($user_details['country'])['quiz_end'];
   $existing_session = $this->question_model->get_saved_quiz_session_by_user_id($_SESSION['id']);


   if(time() > $quiz_start &&  time() < $quiz_end && $existing_session['status'] != 'timeout') {
     
     echo "start";
   }else{
    echo "";
   }

}
public function account($slug = null)
{

  
      $data["title"] ="Pryper | Account Balance";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
       $data['user_details'] = $this->users_model->get_user_by_id();
 $data['country'] = $this->dashboard_model->get_country_by_select_value($data['user_details']['country']);

      $this->load->view('common/headmeta_view',$data);
          $this->load->view('user/common/users_nav_view',$data);
          $this->load->view('common/header_view',$data);
          $this->load->view('user/common/pre_content_view',$data);
           $this->load->view('user/account_view',$data);
           $this->load->view('user/common/post_content_view',$data);
      $this->load->view('common/footer_view',$data);

}
public function send_live()
{
$this->form_validation->set_rules('quantity','Quantity','required');
$this->form_validation->set_rules('email','Email','required|valid_email');

if ($this->form_validation->run() == FALSE)
{
  $_SESSION['action_status_report'] = "<span class='w3-text-red'>".validation_errors()."</span>";
  $this->session->mark_as_flash('action_status_report');
show_page('dashboard/account');

}else{

//check if balance_live is greater than quantity
$receiver = $this->users_model->get_user_by_email($this->input->post('email'));

$user = $this->users_model->get_user_by_id();
if (empty($receiver)) {


$_SESSION['action_status_report']= "<span class='w3-text-red'>No Registered User With This Email</span>";
$this->session->mark_as_flash('action_status_report');
show_page('dashboard/account');


}else{
if($user['balance_live'] >= $this->input->post('quantity'))
  {
//debit this user and credit the other one

$new_sender_balance = $user['balance_live'] - $this->input->post('quantity');
$this->db->update('users',array('balance_live'=> $new_sender_balance),array('id' =>$_SESSION['id']));
$receiver = $this->users_model->get_user_by_email($this->input->post('email'));

  //insert to history
$details = "You make a Transfer of ".$this->input->post('quantity')." Bold to ".$receiver['firstname'];
      $h_dat =  array(
        'details' => $details,
        'action' => 'bold_transfer' ,
        'user_id' => $_SESSION['id'],
        'time' => time()
         );


      $this->users_model->insert_to_history($h_dat);
$details = "You Received a Transfer of ".$this->input->post('quantity')." Bold from ".$user['firstname'];
      $h_dat =  array(
        'details' => $details,
        'action' => 'bold_receive' ,
        'user_id' => $receiver['id'],
        'time' => time()
         );
      $this->users_model->insert_to_history($h_dat);



$noti = array(
                      'sender_id' => '@admin',
                      'receiver_id' => $receiver['id'],
                      'contents' => "You Received a Transfer of ".$this->input->post('quantity')." Bold from ".$user['firstname'],
                      'type' => 'bold_receive',
                      'slug' => '',
                      'status' => 'unread',
                      'time' => time()
              );
              $this->db->insert('notifications', $noti);




//send here
$this->dashboard_model->send_live($this->input->post('quantity'),$receiver);


$_SESSION['action_status_report']= "<span class='w3-text-theme'>Sent Successfully</span>";
$this->session->mark_as_flash('action_status_report');
show_page('dashboard/account');


  }else{

$_SESSION['action_status_report']= "<span class='w3-text-red'>insufficient Live</span>";
$this->session->mark_as_flash('action_status_report');
show_page('dashboard/account');

  }
}


}
}

public function pre_tip_vote($slug = null)
{

  
      $data["title"] ="Pryper | Vote Tips";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
       $data['user_details'] = $this->users_model->get_user_by_id();


$data['election_start'] = $this->dashboard_model->get_country_by_select_value($data['user_details']['country'])['next_voting_start'];
$data['election_end'] = $this->dashboard_model->get_country_by_select_value($data['user_details']['country'])['voting_end'];

//echo var_dump($data['election_start']);


if((time() >= $data['election_start'] ) && ($data['election_end'] >time() ))
{
  show_page('Dashboard/vote');
}
if((time() > $data['election_start'] ) && ($data['election_end'] < time() ))
{
  show_page('Dashboard/view_vote_result');
}
    

      $this->load->view('common/headmeta_view',$data);
          $this->load->view('user/common/users_nav_view',$data);
          $this->load->view('common/header_view',$data);
          $this->load->view('user/common/pre_content_view',$data);
           $this->load->view('user/pre_vote_tips_view',$data);
           $this->load->view('user/common/post_content_view',$data);
      $this->load->view('common/footer_view',$data);

}

//ajax time report

public function return_countdown_check()
{

$data['election_start'] = $this->dashboard_model->get_country_by_select_value($data['user_details']['country'])['next_voting_start'];
$data['election_end'] = $this->dashboard_model->get_country_by_select_value($data['user_details']['country'])['voting_end'];

if((time() >= $election_start ) && ($election_end >=time() ))
{
  //election is on
  echo "start";
}elseif(time() > $election_end){
  echo "stopp";
}elseif(time() < $election_start){
  //wait
  echo "wait";
}


}

public function vote()
{

$this->form_validation->set_rules("submit","Vote Button","required");
if(!$this->form_validation->run())
{

 $data["title"] ="Pryper | Vote Tips";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
       $data['user_details'] = $this->users_model->get_user_by_id();

$data['election_start'] = $this->dashboard_model->get_country_by_select_value($data['user_details']['country'])['next_voting_start'];
$data['election_end'] = $this->dashboard_model->get_country_by_select_value($data['user_details']['country'])['voting_end'];

if((time() > $data['election_start'] ) && ($data['election_end'] < time() ))
{
  $_SESSION['action_status_report'] ="<span class=''>Oops,Sorry You are Late</span>";
  $this->session->mark_as_flash('action_status_report');
  show_page('Dashboard/view_vote_result');
}
if((time() <= $data['election_start'] ))
{
  show_page('Dashboard');
}

$position = $this->dashboard_model->get_available_stages('id,label');
/*create an array to hold tips and Position details*/
$data['holder'] =[];
for ($i=0; $i < count($position); $i++) {

$tips = $this->dashboard_model->get_tips_by_stage($position[$i]['id']);
$data['holder'][$i] = array('position_name'=> $position[$i]['label'],'position_id'=> $position[$i]['id'],'tips' => $tips);
}

   

      $this->load->view('common/headmeta_view',$data);
          $this->load->view('user/common/users_nav_view',$data);
          $this->load->view('common/header_view',$data);
          $this->load->view('user/common/pre_content_view',$data);
           $this->load->view('user/vote_tips_view',$data);
           $this->load->view('user/common/post_content_view',$data);
      $this->load->view('common/footer_view',$data);




}else{

//echo   $tip_id = $this->input->post($i+1);

  
  //check if time is still available
        $data['user_details'] = $this->users_model->get_user_by_id();
$election_start = $this->dashboard_model->get_country_by_select_value($data['user_details']['country'])['next_voting_start'];
$election_end = $this->dashboard_model->get_country_by_select_value($data['user_details']['country'])['voting_end'];
if(!(time() >= $election_end))
{
  //time is ok proceed
    //check if vote already exist
//position here is the stage
$position = $this->dashboard_model->get_available_stages('id,label');
$user_votes = [];
for ($i=0; $i < count($position) ; $i++) {
  $tips = $this->dashboard_model->get_tips_by_stage($position[$i]['id']);
  //check for empty position
   if(!empty($tips))
  {
    //candidate id as value position as name
  //$index = (int)$i+1;
  $tip_id = $this->input->post($position[$i]['id']);
  
$user_votes[$i] = array('voter_id'=>$_SESSION['id'],'tip_id' => $tip_id ,'stage_id'  => $position[$i]['id']);

  }

}

$this->dashboard_model->insert_vote($user_votes);

  show_page('Dashboard/vote');


}else{

  //redirect to voteend
  $_SESSION['action_status_report'] ="<span style='color: red;'>Sorry Time is UP</span>";
  $this->session->mark_as_flash('action_status_report');
  show_page('Dashboard/view_vote_result');
}


}


}



public function view_vote_result()
{

 $data["title"] ="Pryper | Vote Result";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
       $data['user_details'] = $this->users_model->get_user_by_id();

//check if user have voted here and if not redirect to vote


$stages = $this->dashboard_model->get_available_stages('id,label');
//create an array to hold tips and Position details
$data['results'] =[];

for ($i=0; $i < count($stages); $i++) {


$each_stage=[];
$each_stage['stage_label'] = $stages[$i]['label'];

$each_stage['tips'] = [];

$tips = $this->dashboard_model->get_tips_by_stage($stages[$i]['id']);
if(!empty($tips))
{
foreach ($tips as $tip) {
//get candidate votes
  $no_votes = count($this->dashboard_model->get_tips_votes($tip['id']));
  $tip['no_votes'] = $no_votes;
  array_push($each_stage['tips'],$tip );
}
}else{
  //no candidate
  $each_stage['tips'] = 0;
}
array_push($data['results'] ,$each_stage);
}



  $this->load->view('common/headmeta_view',$data);
          $this->load->view('user/common/users_nav_view',$data);
          $this->load->view('common/header_view',$data);
          $this->load->view('user/common/pre_content_view',$data);
           $this->load->view('user/vote_result_view',$data);
           $this->load->view('user/common/post_content_view',$data);
      $this->load->view('common/footer_view',$data);


}

  public function change_profile_picture()
  {
    

 $this->form_validation->set_rules("picture","Profile Picture","required");


  $config['upload_path'] = "assets/images/profiles";
  $config['allowed_types'] = 'gif|jpg|png|jpeg'; $config['max_size'] = '500';
   $config['max_width'] = '800';
    $config['max_height'] = '600';

 $this->load->library('upload', $config);



if ($this->form_validation->run() == FALSE  && $this->upload->do_upload('picture') ==FALSE )
{



 $data['error'] =  $this->upload->display_errors();


 $_SESSION['picture_err_msg'] = $data['error'];
   $this->session->mark_as_flash('picture_err_msg');
    show_page("dashboard/Profile");



  }else
  {
    //change here



               if( $this->users_model->change_profile_picture($this->upload->data("file_name")))
              {
                 //show suc message

                $_SESSION['picture_err_msg'] = '<b class="w3-text-blue">Profile Picture
                 changed successfully</b><br>';
                  $this->session->mark_as_flash('picture_err_msg');
                  show_page("dashboard/profile");
              }else{

                  //show err message

                 $_SESSION['picture_err_msg'] = '<b class="w3-text-red">uknown error occurred</b>';
                  $this->session->mark_as_flash('picture_err_msg');
                  show_page("dashboard/profile");


              }





  }



 }




//functions ends here



public function profile()
{

      $data["title"] ="Pryper |Account Dashboard";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
        $data['item'] = $this->users_model->get_user_by_id();
        $data['user_details'] = $this->users_model->get_user_by_id();

         $this->load->view('common/headmeta_view',$data);
             $this->load->view('user/common/users_nav_view',$data);
             $this->load->view('common/header_view',$data);
              $this->load->view('user/profile_view',$data);
         $this->load->view('common/footer_view',$data);




}




  public function req_withdrawal()
  {
//later check here for new guidelines also
  $data['user'] = $this->users_model->get_user_by_id();
    //check if account details is set
    if (empty($data['user']['bank_acct']))
    {
//redirect
      show_page('dashboard/withdrawal');
    }


$data['country_details'] = $this->dashboard_model->get_country_by_select_value($data['user']['country']);



//check if balance is ok
   
    if($data['user']['account_bal'] >= $data['country_details']['minimum_payout'])
    {

//check if there is previous pending balance
if($data['user']['pending_bal'] > 0)
{

//please there is already pending balance

       $_SESSION['action_status_report'] = "<script>alert('Please there is already a pending balance');</script>";
        $this->session->mark_as_flash('action_status_report');
        show_page("dashboard/withdrawal");


}
else{
    //insert  balance to pending
$ref = ((time()-456788)*9);


$new_pending = $data['user']['account_bal'] +
$data['user']['pending_bal'];
      $w_dat =  array('pending_bal' => $new_pending );


      $this->users_model->edit_user($w_dat,$data['user']['id']);
      //insert to wildrawal

$w_dat =  array(
        'amount' => $data['user']['account_bal'],
        'user_id' => $_SESSION['id'],
        'approval' => "pending",
        'status' => "pending",
        'email' => $data['user']['email'],
        'phone' => $data['user']['phone'],
        'ref'  => $ref,
        'time' => time()
         );

      $this->users_model->insert_to_with_req($w_dat);
     
      //insert to history
$details = "You make a withdrawal Request of 
".$data['user']['account_bal']." with reference ".$ref;
      $h_dat =  array(
        'details' => $details,
        'action' => 'w_request' ,
        'user_id' => $_SESSION['id'],
        'time' => time()
         );


      $this->users_model->insert_to_history($h_dat);
     //send email here
      
      //insert 00.00 to account bal


      $w_dat =  array('account_bal' => 0.00 );

      $this->users_model->edit_user($w_dat,$data['user']['id']);



             $_SESSION['action_status_report'] = "<script>alert('Your withdrawal Request has been submitted successfully');</script>";
              $this->session->mark_as_flash('action_status_report');
              show_page("dashboard/withdrawal");

}

//echo success

    }else{
             $_SESSION['action_status_report'] = "<script>alert('Insufficient Balance');</script>";
              $this->session->mark_as_flash('action_status_report');
              show_page("dashboard/withdrawal");
    }
 }





public function withdrawal()
{



$this->form_validation->set_rules("payment_type","Payment Type","required");
if($this->form_validation->run())
{

$this->dashboard_model->update_payment_details();
    

   $_SESSION["action_status_report"] = '<b class="w3-text-theme">Payment 
         details Updated successfully</b><br>';
   $this->session->mark_as_flash('action_status_report');
   show_page("dashboard/withdrawal");

}else{



$data["title"] ="Pryper |Account Dashboard";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
        $data['item'] = $this->users_model->get_user_by_id();
        $data['user'] = $this->users_model->get_user_by_id();
        $data['user_details'] = $this->users_model->get_user_by_id();

$data['country'] = $this->dashboard_model->get_country_by_select_value($data['user']['country']);
         $this->load->view('common/headmeta_view',$data);
             $this->load->view('user/common/users_nav_view',$data);
             $this->load->view('common/header_view',$data);
              $this->load->view('user/withdrawal_view',$data);
         $this->load->view('common/footer_view',$data);



}
      



}

//functions ends here

public function turn_image()
{

convert_question_text_to_image('Hello World in java is like how many Let the browser know that it is an PNG image?lines of code just to make look very longer for efficiency confirmation.ok lets ride on and lets pray at this point that Almigthy God the Supreme one lets this project succeed Amen.');

}

public function image()
{

$data["title"] ="Pryper | Image";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
       $data['user_details'] = $this->users_model->get_user_by_id();

       $this->load->view('common/headmeta_view',$data);
           $this->load->view('user/common/users_nav_view',$data);
           $this->load->view('common/header_view',$data);
           $this->load->view('user/common/pre_content_view',$data);
            $this->load->view('user/image',$data);
            $this->load->view('user/common/post_content_view',$data);
       $this->load->view('common/footer_view',$data);



}










public function history($offset=0)
{

$limit = 5;

$data['history'] = $this->users_model->get_history($offset,
  $limit,$_SESSION['id']);

    $this->load->library('pagination');

    $config['base_url'] = site_url("Dashboard/history");



  $config['total_rows'] = count($this->users_model->get_history(null,null,$_SESSION['id']));
  //  $config['total_rows'] = 10;
    $config['per_page'] = $limit;

    $config['uri_segment'] = 3;
    $config['first_tag_open'] = '<span class="w3-btn  w3-theme w3-text-white w3-round-xlarge">';
    $config['first_tag_close'] = '</span>';
    $config['last_tag_open'] = '<br><span class="w3-btn  w3-theme w3-text-white w3-round-xlarge">';
    $config['last_tag_close'] = '</span>';
    $config['first_link'] = 'First';
    $config['prev_link'] = 'Prev';
    $config['next_link'] = 'Next';
    $config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-theme w3-text-white w3-round-xlarge">';
    $config['next_tag_close'] = '</span><br>';
    $config['prev_tag_open'] = '<span style="" class="w3-btn w3-theme w3-text-white w3-round-xlarge">';
    $config['prev_tag_close'] = '</span>';
    $config['last_link'] = 'Last';
    $config['display_pages'] = false;


       $this->pagination->initialize($config);
  $data['pagination'] = $this->pagination->create_links();


$data["title"] ="Pryper |Account History";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
        $data['item'] = $this->users_model->get_user_by_id();
        $data['user'] = $this->users_model->get_user_by_id();
                $data['user_details'] = $this->users_model->get_user_by_id();

$data['country'] = $this->dashboard_model->get_country_by_select_value($data['user']['country']);
         $this->load->view('common/headmeta_view',$data);
             $this->load->view('user/common/users_nav_view',$data);
             $this->load->view('common/header_view',$data);
              $this->load->view('user/history_view',$data);
         $this->load->view('common/footer_view',$data);




}

 public function change_password($slug = null)
 {


       $this->form_validation->set_rules("pass","Old Password","trim|required");
    $this->form_validation->set_rules("npass","New Password","trim|required|is_unique[users.password]");
    $this->form_validation->set_rules("cpass","Confirm New Password","trim|required|matches[npass]");


    if ($this->form_validation->run() ==  FALSE)
   {

$data["title"] ="Pryper | Change Password";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
       $data['user_details'] = $this->users_model->get_user_by_id();

       $this->load->view('common/headmeta_view',$data);
           $this->load->view('user/common/users_nav_view',$data);
           $this->load->view('common/header_view',$data);
           $this->load->view('user/common/pre_content_view',$data);
            $this->load->view('user/change_pass_view',$data);
            $this->load->view('user/common/post_content_view',$data);
       $this->load->view('common/footer_view',$data);


}else{

//change here



     $user_det =   $this->users_model->get_user_by_id();

       if ($user_det['password'] == md5(md5(trim($this->input->post('pass')))))
       {

        //change password
          if( $this->users_model->insert_new_password())
          {
             //show suc message

            $_SESSION['err_msg'] = '<b class="w3-text-blue">Password changed successfully</b><br>';
              $this->session->mark_as_flash('err_msg');
              show_page("dashboard/change_password");
          }else{

              //show err message

             $_SESSION['err_msg'] = '<b class="w3-text-red">uknown error occurred</b>';
              $this->session->mark_as_flash('err_msg');
              show_page("dashboard/change_password");


          }





       }else{


                   //incorrect password  error page


             $_SESSION["err_msg"] = '<b>The Current Account
             Password you entered is incorrect</b><br>';
              $this->session->mark_as_flash('err_msg');
              show_page("dashboard/change_password");



       }




}



 }



//function ends here
 public function edit_status($slug = null)
 {
  
      $this->form_validation->set_rules("status","Status","required");



    if ($this->form_validation->run() ==  FALSE)
   {

                 $_SESSION['status_err_msg'] = validation_errors();
                   $this->session->mark_as_flash('status_err_msg');
                   show_page("dashboard/profile");



}else{

//change here



        //change email
          if( $this->users_model->edit_status())
          {
             //show suc message

            $_SESSION['status_err_msg'] = '<b class="w3-text-blue">Status
             changed successfully</b><br>';
              $this->session->mark_as_flash('status_err_msg');
              show_page("dashboard/profile");
          }else{

              //show err message

             $_SESSION['status_err_msg'] = '<b class="w3-text-red">uknown error occurred</b>';
              $this->session->mark_as_flash('status_err_msg');
              show_page("dashboard/profile");


          }






}



 }


//functions ends here



 public function edit_username($slug = null)
 {
  

      $this->form_validation->set_rules("username","Username","trim|required|is_unique[users.username]");



    if ($this->form_validation->run() ==  FALSE)
   {

                 $_SESSION['username_err_msg'] = validation_errors();
                   $this->session->mark_as_flash('username_err_msg');
                   show_page("dashboard/profile");



}else{

//change here



        //change email
          if( $this->users_model->edit_username())
          {
             //show suc message

            $_SESSION['username_err_msg'] = '<b class="w3-text-blue">Username
             changed successfully</b><br>';
              $this->session->mark_as_flash('username_err_msg');
              show_page("dashboard/profile");
          }else{

              //show err message

             $_SESSION['username_err_msg'] = '<b class="w3-text-red">uknown error occurred</b>';
              $this->session->mark_as_flash('username_err_msg');
              show_page("dashboard/profile");


          }






}



 }


//functions ends here




public function notifications($offset = 0)
{
  

    $limit = 12;
    $data['user_details'] = $this->users_model->get_user_by_id();

    $data['notifications'] = $this->users_model->get_notifications($offset,
    $limit,$data['user_details']['id']);

      $this->load->library('pagination');

      $config['base_url'] = site_url("dashboard_ext/notifications");



    $config['total_rows'] = count($this->users_model->get_notifications(null,null,$data['user_details']['id']));
    //  $config['total_rows'] = 10;
      $config['per_page'] = $limit;

      //$config['uri_segment'] = 2;
      $config['first_tag_open'] = '<span class="w3-btn  w3-theme w3-text-white w3-round-xlarge">';
      $config['first_tag_close'] = '</span>';
      $config['last_tag_open'] = '<br><span class="w3-btn  w3-theme w3-text-white w3-round-xlarge">';
      $config['last_tag_close'] = '</span>';
      $config['first_link'] = 'First';



      $config['prev_link'] = 'Prev';
      $config['next_link'] = 'Next';
      $config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-theme w3-text-white w3-round-xlarge">';
      $config['next_tag_close'] = '</span><br>';
      $config['prev_tag_open'] = '<span style="" class="w3-btn w3-theme w3-text-white w3-round-xlarge">';
      $config['prev_tag_close'] = '</span>';
      $config['last_link'] = 'Last';
      $config['display_pages'] = false;


         $this->pagination->initialize($config);
    $data['pagination'] = $this->pagination->create_links();


$data["title"] ="Pryper | Notifications";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";
       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
       
         $this->load->view('common/headmeta_view',$data);
             $this->load->view('user/common/users_nav_view',$data);
             $this->load->view('common/header_view',$data);
             $this->load->view('user/common/pre_content_view',$data);
              $this->load->view('user/notifications_view',$data);
              $this->load->view('user/common/post_content_view',$data);
         $this->load->view('common/footer_view',$data);




}

public function confirm_pay_payment()
{

 /* $_SESSION['hold'] = array('ref' => $ref,'amount'=>$amount,'currency_code'=>$currency_code); as saved from frontend*/

  if(!isset($_SESSION['hold']['ref']))
  {
           
$_SESSION['action_status_report'] ="<span class='w3-text-red'>Unknown Error Occurred</span>";
$this->session->mark_as_flash('action_status_report');
show_page("dashboard/payment");
  }

    if (isset($_SESSION['hold']['ref'])) {
        $ref = $_SESSION['hold']['ref'];
        $amount = $_SESSION['hold']['amount']; //Correct Amount from Server
        $currency = $_SESSION['hold']['currency_code']; 
        //Correct Currency from Server

        $query = array(
            "SECKEY" => "FLWSECK-6f443a762c64ef4c1946b3de8974791d-X",
            "txref" => $ref
        );
         /* $query = array(
            "SECKEY" => "FLWSECK-cc257ca2f7854658a8d5ab2880253f3d-X",
            "txref" => $ref
        );//test*/

        $data_string = json_encode($query);
                
         $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify ');        
        /*$ch = curl_init("https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/v2/verify"); test */                                 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        curl_close($ch);

        $resp = json_decode($response, true);

        $paymentStatus = $resp['data']['status'];
        $chargeResponsecode = $resp['data']['chargecode'];
        $chargeAmount = $resp['data']['amount'];
        $chargeCurrency = $resp['data']['currency'];

        if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
          //Give Value and return to Success page

//unset ref,$_SESSION['ref']
          //redirect to home
          //later send email
$user = $this->users_model->get_user_by_id();
$country= $this->dashboard_model->get_country_by_select_value($user['country']);

$new_live_bal = $user['balance_live']+($chargeAmount/$country['cost_per_live']);
$this->users_model->update_live(array('balance_live' => $new_live_bal));        
$this->users_model->insert_to_payment_record(array('method'=>'flutterwave','payment_type'=>'deposit','amount'=> ($chargeAmount/$country['cost_per_live']),'user_type'=>'','user_id' => $_SESSION['id'], 'time'=>time()));
unset($ref);
//unset session variable here
unset($_SESSION['hold']);

$_SESSION['action_status_report'] ="<span class='w3-text-green'>Payment Successfully Processed</span>";
$this->session->mark_as_flash('action_status_report');
show_page("dashboard/account");
        } else {
            //Dont Give Value and return to Failure page
          $_SESSION['action_status_report'] ="<span class='w3-text-red'>Payment Failed</span>";
$this->session->mark_as_flash('action_status_report');
show_page("dashboard/payment");
        }
    }



}

   public function payment()
 {

  

       	$this->form_validation->set_rules("no_lives","No Of Lives","required");



       if ($this->form_validation->run() ==  FALSE)
      {




 $data["title"] ="Pryper | Buy Lives";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

      $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
     $data['user_details'] = $this->users_model->get_user_by_id();
       $data['country'] = $this->dashboard_model->get_country_by_select_value($data['user_details']['country']);
          


    $this->load->view('common/headmeta_view',$data);
       $this->load->view('user/common/users_nav_view',$data);
       $this->load->view('common/header_view',$data);
       $this->load->view('user/common/pre_content_view',$data);
      $this->load->view('user/pay_view',$data);
    $this->load->view('user/common/post_content_view',$data);
      $this->load->view('common/footer_view',$data);
}
else{
//insert to db and give ref id and redirect to payment gateway


 $data["title"] ="Pryper | Buy Lives";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
       $data['user_details'] = $this->users_model->get_user_by_id();
       $data['country'] = $this->dashboard_model->get_country_by_select_value($data['user_details']['country']);

      
  $data['amount'] = $this->input->post('no_lives') * $data['country']['cost_per_live'];
    $data['currency_code'] = $data['country']['currency_code'];
          



$this->load->view('common/headmeta_view',$data);
   $this->load->view('user/common/users_nav_view',$data);
   $this->load->view('common/header_view',$data);
   $this->load->view('user/common/pre_content_view',$data);
    $this->load->view('user/payment_view',$data);
    $this->load->view('user/common/post_content_view',$data);
$this->load->view('common/footer_view',$data);


}


}


 
   public function logout()
 {
        unset($_SESSION["id"]);
    unset($_SESSION["logged_in"]);
unset($_SESSION['question_id']);
unset($_SESSION['stage']);
unset($_SESSION['question_set']);
    $_SESSION['err_msg'] = 'You are Successfully logged out';
    $this->session->mark_as_flash('err_msg');

    show_page("login");



 }

}
