<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {
/*

Name:Pryce to Pryper
Date:Start Writing  2018 in 2019

*/



public function __construct()
{
     parent::__construct();

    $this->load->model(array('question_model','users_model','dashboard_model','board_model','pages_model'));
         $this->load->helper(array('url','form','question_helper','page_helper'));
     $this->load->library(array('form_validation','session'));
//user login check here

      if ((!isset($_SESSION['id'])) || (!isset($_SESSION['logged_in'])))
       {    

show_page('login');
           
       }

$data['user_details'] = $this->users_model->get_user_by_id();
  $live_required = $this->dashboard_model->get_country_by_select_value($data['user_details']['country'])['live_required'];
  //set minimum bold required
  
  if ($data['user_details']['balance_live'] < $live_required && $this->uri->segment(2) != 'minimum'){
        show_page('question/minimum');
  }

}



public function index($slug = null)
{
  $data['user_details'] = $this->users_model->get_user_by_id();
  $live_required = $this->dashboard_model->get_country_by_select_value($data['user_details']['country'])['live_required'];

  
$data['quiz_end'] = $this->dashboard_model->get_country_by_select_value($data['user_details']['country'])['quiz_end'];

   if (time() >= $data['quiz_end']) {
     //game ends
    show_page('question/end');
  
   }else{
 //check for right time here

      $data["title"] ="Pryper | Start Now";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
       
       $data['quiz_start'] = $this->dashboard_model->get_country_by_select_value($data['user_details']['country'])['next_quiz_start'];
       $data['no_of_stages'] = count($this->question_model->get_stages_by_country($data['user_details']['country']));


$existing_session = $this->question_model->get_saved_quiz_session_by_user_id($_SESSION['id']);

//check if user has lost already
if ((!empty($existing_session)) && $existing_session['status'] == 'missed') {

show_page('question/missed');

}
//check if question timeout
if ( $existing_session['status'] == 'timeout') {

show_page('question/timeout');

}



 
       if (empty($existing_session)){
       //if session is not set in browser and does not exist in database
//new user action
       $_SESSION['stage'] = 1;
       $stage_questions_id =  $this->question_model->get_questions_id(array('status'=>'published','level'=> $_SESSION['stage'],'country' => $data['user_details']['country']));

       if(count($stage_questions_id) > 1)
{
       $_SESSION['question_id'] = $stage_questions_id[(mt_rand(1,count($stage_questions_id)))-1]['id'];
}else{
  $_SESSION['question_id'] = $stage_questions_id[0];
}
   
          
       $data['question'] = $this->question_model->get_question_by_its_id($_SESSION['question_id']);
       $_SESSION['question_set'] = true;
       //save session details
$this->question_model->save_quiz_session(array('user_id' => $_SESSION['id'],'stage' => $_SESSION['stage'],'question_id' => $_SESSION['question_id'],'time'=>time(),'stage_time_start' => time(),'balance_live_used'=> 0 ,'status'=> '','country' => $data['user_details']['country']));

         //save as new entries if its question/stage one

      
       }elseif( (!empty($existing_session)) && empty($existing_session['question_id'])){

        //next is clicked and user is qualified
        $_SESSION['stage'] = $existing_session['stage'];
 $stage_questions_id =  $this->question_model->get_questions_id(array('status'=>'published','level'=> $_SESSION['stage']));

 //echo "the stage ids :".var_dump($stage_questions_id)."<br>";

if(count($stage_questions_id) > 1)
{
       $_SESSION['question_id'] = $stage_questions_id[(mt_rand(1,count($stage_questions_id)))-1]['id'];
}else{
  $_SESSION['question_id'] = $stage_questions_id[0];
}
  
      $data['question'] = $this->question_model->get_question_by_its_id($_SESSION['question_id']);
       $_SESSION['question_set'] = true;
       //save session details

      $this->question_model->edit_quiz_session(array('stage' => $_SESSION['stage'],'question_id' => $_SESSION['question_id'],'stage_time_start' => time(),'status'=>''),$_SESSION['id']);


         //edit the already saved entries if its question/stage one
       

       }else{
        //for logged out users
                $_SESSION['stage'] = $existing_session['stage'];
                $_SESSION['question_id'] = $existing_session['question_id'];

        $data['question'] = $this->question_model->get_question_by_its_id($_SESSION['question_id']);
       }
       

      $data['question_start'] = $this->question_model->get_saved_quiz_session_by_user_id($data['user_details']['id'])['stage_time_start'];
//check if general time is still valid 
//check if stage time is still valid  here
      $this->load->view('common/headmeta_view',$data);
          $this->load->view('user/common/users_nav_view',$data);
          $this->load->view('common/header_view',$data);
          $this->load->view('user/common/pre_content_view',$data);
           $this->load->view('user/question_view',$data);
           $this->load->view('user/common/post_content_view',$data);
      $this->load->view('common/footer_view',$data);
}
}

public function get_quiz_text_image()
{
        $question = $this->question_model->get_question_by_its_id($_SESSION['question_id']);
     
convert_question_text_to_image($question['question']);

}

public function pre_next($slug = null)
{
 //check for right time here
       $data['user_details'] = $this->users_model->get_user_by_id();

//check if won or missed
$data['quiz_end'] = $this->dashboard_model->get_country_by_select_value($data['user_details']['country'])['quiz_end'];

   if (time() > $data['quiz_end'] ) {
     //game ends
    show_page('question/end');
  
   }

  $existing_session = $this->question_model->get_saved_quiz_session_by_user_id($_SESSION['id']);

//check if user has lost already
if ((!empty($existing_session)) && $existing_session['status'] == 'missed') {

show_page('question/missed');

}elseif ($existing_session['status'] == 'won') {

show_page('question/won');

}elseif($existing_session['status'] == "timeout") {
//check if question timeout
show_page('question/timeout');

}

      $data["title"] ="Pryper | Next";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
             $data['no_of_stages'] = count($this->question_model->get_stages_by_country($data['user_details']['country']));

      $this->load->view('common/headmeta_view',$data);
          $this->load->view('user/common/users_nav_view',$data);
          $this->load->view('common/header_view',$data);
          $this->load->view('user/common/pre_content_view',$data);
           $this->load->view('user/pre_next_view',$data);
           $this->load->view('user/common/post_content_view',$data);
      $this->load->view('common/footer_view',$data);

}

//end of function

public function missed($slug = null)
{
 //check for right time here
//check if won or missed

      $data["title"] ="Pryper | Missed";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
       $data['user_details'] = $this->users_model->get_user_by_id();
             $data['no_of_stages'] = count($this->question_model->get_stages_by_country($data['user_details']['country']));
$data['quiz_end'] = $this->dashboard_model->get_country_by_select_value($data['user_details']['country'])['quiz_end'];

      $this->load->view('common/headmeta_view',$data);
          $this->load->view('user/common/users_nav_view',$data);
          $this->load->view('common/header_view',$data);
          $this->load->view('user/common/pre_content_view',$data);
           $this->load->view('user/missed_view',$data);
           $this->load->view('user/common/post_content_view',$data);
      $this->load->view('common/footer_view',$data);

}

//end of function


public function minimum($slug = null)
{
 //check for right time here
//check if won or missed

      $data["title"] ="Pryper | Not Enough Live";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
       $data['user_details'] = $this->users_model->get_user_by_id();
             $data['no_of_stages'] = count($this->question_model->get_stages_by_country($data['user_details']['country']));
$data['quiz_start'] = $this->dashboard_model->get_country_by_select_value($data['user_details']['country'])['quiz_start'];
$data['quiz_end'] = $this->dashboard_model->get_country_by_select_value($data['user_details']['country'])['quiz_end'];
$data['live_required'] = $this->dashboard_model->get_country_by_select_value($data['user_details']['country'])['live_required'];


      $this->load->view('common/headmeta_view',$data);
          $this->load->view('user/common/users_nav_view',$data);
          $this->load->view('common/header_view',$data);
          $this->load->view('user/common/pre_content_view',$data);
           $this->load->view('user/minimum_view',$data);
           $this->load->view('user/common/post_content_view',$data);
      $this->load->view('common/footer_view',$data);

}

//end of function

public function end($slug = null)
{
 //check for right time here
//check if won or missed

      $data["title"] ="Pryper | Game End";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
      $data['user_details'] = $this->users_model->get_user_by_id();
          
$data['quiz_end'] = $this->dashboard_model->get_country_by_select_value($data['user_details']['country'])['quiz_end'];

      $this->load->view('common/headmeta_view',$data);
          $this->load->view('user/common/users_nav_view',$data);
          $this->load->view('common/header_view',$data);
          $this->load->view('user/common/pre_content_view',$data);
           $this->load->view('user/end_view',$data);
           $this->load->view('user/common/post_content_view',$data);
      $this->load->view('common/footer_view',$data);

}

//end of function

public function won($slug = null)
{
  $existing_session = $this->question_model->get_saved_quiz_session_by_user_id($_SESSION['id']);

 if ( $existing_session['status'] != 'won') {

show_page('Question');

}
      $data["title"] ="Pryper | Game End";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
      $data['user_details'] = $this->users_model->get_user_by_id();
          
$data['quiz_end'] = $this->dashboard_model->get_country_by_select_value($data['user_details']['country'])['quiz_end'];

      $this->load->view('common/headmeta_view',$data);
          $this->load->view('user/common/users_nav_view',$data);
          $this->load->view('common/header_view',$data);
          $this->load->view('user/common/pre_content_view',$data);
           $this->load->view('user/won_view',$data);
           $this->load->view('user/common/post_content_view',$data);
      $this->load->view('common/footer_view',$data);

}

//end of function
public function save_me()
{
//check for live availability
   //check stage if save me is available in the stage
  //deduct and add accordingly
  //reset status to "" and stage_time_start to time()
$amount_of_save_me = 4;
$maximum_live_usable = 8;

 $user_details = $this->users_model->get_user_by_id();
    $existing_session = $this->question_model->get_saved_quiz_session_by_user_id($_SESSION['id']);

  if($user_details['balance_live'] >= $amount_of_save_me)
  {
if (($maximum_live_usable - $existing_session['balance_live_used']) >= $amount_of_save_me){
  
 $new_balance_live = $user_details['balance_live']- $amount_of_save_me;
  $this->users_model->edit_user(array('balance_live' => $new_balance_live),$_SESSION['id']);

  $this->question_model->edit_quiz_session(array(
"stage_time_start" => time(),'status' => ""
  ,
"balance_live_used" => ($existing_session['balance_live_used']+$amount_of_save_me)),$_SESSION['id']);
      //insert to history
$details = "You Spent ".$amount_of_save_me." Bold on SAVE ME";
      $h_dat =  array(
        'details' => $details,
        'action' => 'bold_spending_save_me' ,
        'user_id' => $_SESSION['id'],
        'time' => time()
         );


      $this->users_model->insert_to_history($h_dat);

  $_SESSION['action_status_report'] ="<span class='w3-text-green'>Hey, You're saved</span>";
$this->session->mark_as_flash('action_status_report');
show_page('question');


}else{

//return maximum live used per quiz
  $_SESSION['action_status_report'] ="<span class='w3-text-red'>maximum Bold useable per game Reached</span>";
$this->session->mark_as_flash('action_status_report');
show_page('question/timeout');


}
 
}else{

 //return insufficient Bold
  $_SESSION['action_status_report'] ="<span class='w3-text-red'>insufficient Bold</span>";
$this->session->mark_as_flash('action_status_report');
show_page('question/timeout');



}
//get question by id



}
//function end here

public function timeout($slug = null)
{
  $existing_session = $this->question_model->get_saved_quiz_session_by_user_id($_SESSION['id']);

 if ( $existing_session['status'] != 'timeout') {

//show_page('Question');
    $this->question_model->edit_quiz_session(array('status' => 'timeout'),$_SESSION['id']);


}
      $data["title"] ="Pryper | Question Timeout";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
      $data['user_details'] = $this->users_model->get_user_by_id();
          
$data['quiz_end'] = $this->dashboard_model->get_country_by_select_value($data['user_details']['country'])['quiz_end'];

      $this->load->view('common/headmeta_view',$data);
          $this->load->view('user/common/users_nav_view',$data);
          $this->load->view('common/header_view',$data);
          $this->load->view('user/common/pre_content_view',$data);
           $this->load->view('user/timeout_view',$data);
           $this->load->view('user/common/post_content_view',$data);
      $this->load->view('common/footer_view',$data);

}

//end of function
public function ajax_check_game_question_end()
{

    $user_details = $this->users_model->get_user_by_id();

$quiz_end = $this->dashboard_model->get_country_by_select_value($user_details['country'])['quiz_end'];
   $existing_session = $this->question_model->get_saved_quiz_session_by_user_id($_SESSION['id']);
    $question = $this->question_model->get_question_by_its_id($_SESSION['question_id']);


   if(time() >= $quiz_end ){
     //game ends
   $this->question_model->edit_quiz_session(array('status' => 'end'),$_SESSION['id']);

    echo "end";
  
   }elseif(time() > ($existing_session['stage_time_start']+$question['time_allowed'])){

  /*$this->question_model->edit_quiz_session(array('status' => 'timeout'),$_SESSION['id']);
*/
    echo "timeout";


}else{
  echo "";
}



}

//end of function

public function ajax_get_live_time()
{
echo time();
}

public function submit_question()
{
  $usable_no_live_allow = 8;
   // live in a game
   $amount_of_fifty_fifty= 2;
   //number live needed for fifty fifty
   $amount_of_exchange = 1;
   //amount/number live needed for question exchange
   $amount_of_hint = 4;
   //amount/number live needed for hint/answer exchange
   
if(isset($_POST['fifty']))
{

  
//check if balance live is avalable if yes
  //check if no of live per game is not exceeded
  //if all condition is met go

   $user_details = $this->users_model->get_user_by_id();
   $existing_session = $this->question_model->get_saved_quiz_session_by_user_id($_SESSION['id']);

  if($user_details['balance_live'] >= $amount_of_fifty_fifty)
  {
if  ($existing_session['balance_live_used'] < $usable_no_live_allow)
{
//deduct 2 balance live from this account and 
  //increase the live used count in the session saved
  //table
  //send to frontend the answer and the other option to live
  $new_balance_live = $user_details['balance_live']- $amount_of_fifty_fifty;
  $this->users_model->edit_user(array('balance_live' => $new_balance_live),$_SESSION['id']);
  $this->question_model->edit_quiz_session(array(
"balance_live_used" => ($existing_session['balance_live_used']+$amount_of_fifty_fifty)
  ),$_SESSION['id']);
//get question by id
  $question = $this->question_model->get_question_by_its_id($_SESSION['question_id']);

//insert to history
$details = "You Spent ".$amount_of_fifty_fifty." Bold on FIFTY FIFTY";
      $h_dat =  array(
        'details' => $details,
        'action' => 'bold_spending_fifty_fifty' ,
        'user_id' => $_SESSION['id'],
        'time' => time()
         );


      $this->users_model->insert_to_history($h_dat);


$_SESSION['options_to_leave'] = array($question['answer'],$question['fifty_answer']);
$this->session->mark_as_flash('options_to_leave');
show_page('question');

}else{
      //return maximum live used per quiz
  $_SESSION['action_status_report'] ="<span class='w3-text-red'>Maximum Bold usable per Game Reached</span>";
$this->session->mark_as_flash('action_status_report');
show_page('question');


     }
}else{
    //return insufficient balance
$_SESSION['action_status_report'] ="<span class='w3-text-red'>insufficient Bold Please buy more BOLD <a class='w3-btn w3-white w3-border' href='".site_url('dashboard/payment')."'>Here</a></span>";
$this->session->mark_as_flash('action_status_report');
show_page('question');


   }
//end of fifty post if statement
 }elseif (isset($_POST['change'])) {
   

//check if balance live is avalable if yes
  //check if no of live per game is not exceeded
  //if all condition is met go

   $user_details = $this->users_model->get_user_by_id();
   $existing_session = $this->question_model->get_saved_quiz_session_by_user_id($_SESSION['id']);

  if($user_details['balance_live'] >= $amount_of_exchange)
  {
if  ($existing_session['balance_live_used'] < $usable_no_live_allow)
{
//deduct 1 balance live'/bpnus from this account and 
  //increase the live used count in the session saved
  //table
  //get list of available stage question
  //remove the current question
  //get new one from available ones

  $new_balance_live = $user_details['balance_live']- $amount_of_exchange;
  $this->users_model->edit_user(array('balance_live' => $new_balance_live),$_SESSION['id']);
  $this->question_model->edit_quiz_session(array(
"balance_live_used" => ($existing_session['balance_live_used']+$amount_of_exchange)
  ),$_SESSION['id']);

  $question = $this->question_model->get_question_by_its_id($existing_session['question_id']);
$stage_questions_id =  $this->question_model->get_questions_id(array('status'=>'published','level'=> $question['level'],'country' => $user_details['balance_live']));

//level here is same as stage

  if(count($stage_questions_id) > 1 && isset($existing_session['question_id']))
{
//remove current 

  foreach ($stage_questions_id as $key => $value) {
    if ($existing_session['question_id'] == $value['id']) {
         unset($stage_questions_id[$key]);
             }
  }
  //reindex the array
$stage_questions_id =array_merge($stage_questions_id);
  //new question id
         $_SESSION['question_id'] = $stage_questions_id[(mt_rand(0,count($stage_questions_id)-1))]['id'];
$_SESSION['question_set'] = true;
//saved new question id to session
$this->question_model->edit_quiz_session(array('question_id' => $_SESSION['question_id']),$_SESSION['id']);
 //echo var_dump($stage_questions_id)."<br>";
}
 //insert to history
$details = "You Spent ".$amount_of_exchange." Bold on QUESTION XCHANGE";
      $h_dat =  array(
        'details' => $details,
        'action' => 'bold_spending_change' ,
        'user_id' => $_SESSION['id'],
        'time' => time()
         );


      $this->users_model->insert_to_history($h_dat);


$_SESSION['action_status_report'] ="<span class='w3-text-green'>Question Changed Successfully</span>";
$this->session->mark_as_flash('action_status_report');
show_page('question');

}else{
      //return maximum live used per quiz
  //return maximum live used per quiz
  $_SESSION['action_status_report'] ="<span class='w3-text-red'>Maximum Bold usable per Game Reached</span>";
$this->session->mark_as_flash('action_status_report');
show_page('question');
     }
}else{
    //return insufficient balance
 //return insufficient balance
$_SESSION['action_status_report'] ="<span class='w3-text-red'>insufficient Bold Please buy more BOLD <a class='w3-btn w3-white w3-border' href='".site_url('dashboard/payment')."'>Here</a></span>";
$this->session->mark_as_flash('action_status_report');
show_page('question');


   }


 }elseif (isset($_POST['hint'])) {
   

//check if balance live is avalable if yes
  //check if no of live per game is not exceeded
  //if all condition is met go

   $user_details = $this->users_model->get_user_by_id();
   $existing_session = $this->question_model->get_saved_quiz_session_by_user_id($_SESSION['id']);

  if($user_details['balance_live'] >= $amount_of_hint)
  {
if  ($existing_session['balance_live_used'] < $usable_no_live_allow)
{
//deduct 1 balance live'/bpnus from this account and 
  //increase the live used count in the session saved
  //table
  //get list of available stage question
  //remove the current question
  //get new one from available ones

  $new_balance_live = $user_details['balance_live']- $amount_of_hint;
  $this->users_model->edit_user(array('balance_live' => $new_balance_live),$_SESSION['id']);
  $this->question_model->edit_quiz_session(array(
"balance_live_used" => ($existing_session['balance_live_used']+$amount_of_hint)
  ),$_SESSION['id']);

  $question = $this->question_model->get_question_by_its_id($existing_session['question_id']);
  $_SESSION['hint_answer'] =$question['answer'];
  $this->session->mark_as_flash('hint_answer');

//insert to history
$details = "You Spent ".$amount_of_hint." Bold on HINT";
      $h_dat =  array(
        'details' => $details,
        'action' => 'bold_spending_hint' ,
        'user_id' => $_SESSION['id'],
        'time' => time()
         );


      $this->users_model->insert_to_history($h_dat);


$_SESSION['action_status_report'] ="<span class='w3-text-green'>Question Answered Successfully</span>";
$this->session->mark_as_flash('action_status_report');
show_page('question');

}else{
      //return maximum live used per quiz
  //return maximum live used per quiz
  $_SESSION['action_status_report'] ="<span class='w3-text-red'>Maximum Bold usable per Game Reached</span>";
$this->session->mark_as_flash('action_status_report');
show_page('question');

     }
}else{
    //return insufficient balance
 //return insufficient balance
$_SESSION['action_status_report'] ="<span class='w3-text-red'>insufficient Bold Please buy more BOLD <a class='w3-btn w3-white w3-border' href='".site_url('dashboard/payment')."'>Here</a></span>";
$this->session->mark_as_flash('action_status_report');
show_page('question');


   }


 }elseif(isset($_POST['submit'])){
   $user_answer = $this->input->post('option');
//get user answer compare 
//if answer is ok move to the next stage
//if not stop and unset the neccessary session 
//set missed variable and save session 
   //missed-complte in to db  



    $user_details = $this->users_model->get_user_by_id();
   $existing_session = $this->question_model->get_saved_quiz_session_by_user_id($_SESSION['id']);

//check general time here

//check if question timeout
if ($existing_session['status'] == 'timeout') {

show_page('question/timeout');

}

$quiz_end = $this->dashboard_model->get_country_by_select_value($user_details['country'])['quiz_end'];

   if (time() >= $quiz_end ){
     //game ends
    show_page('question/end');
  
   }else{
      //check question time here
           $question = $this->question_model->get_question_by_its_id($existing_session['question_id']);

if ( time() > ($existing_session['stage_time_start']+$question['time_allowed'])){
//if question time elapsed
  
  $this->question_model->edit_quiz_session(array('status' => 'timeout'),$_SESSION['id']);

    show_page('question/timeout');


}else{
  $question = $this->question_model->get_question_by_its_id($existing_session['question_id']);
     if($question['answer'] == $user_answer)
     {
//answer ids correct

        //got last stage and compare
      if($_SESSION['stage'] != count($this->question_model->get_stages_by_country($user_details['country'])))
      {
      //increase THE STAGE NO and check if 
      $_SESSION['stage'] = $_SESSION['stage']+1;
      $this->question_model->edit_quiz_session(array('stage' => $_SESSION['stage'],'question_id' => "",'stage_time_start' =>"",'status' =>""),$_SESSION['id']);
//
      $_SESSION['action_status_report'] ="<span class='w3-text-green'>Congratulations, You can now Move to next Stage</span>";
      $this->session->mark_as_flash('action_status_report');

      show_page('question/pre_next');
}else{
      $this->question_model->edit_quiz_session(array('status' => 'won','time' => time()),$_SESSION['id']);

   $_SESSION['action_status_report'] ="<span class='w3-text-green'>Congratulations, You've Won Todays Quiz</span>";
      $this->session->mark_as_flash('action_status_report');
            show_page('question/won');


}
     }else{
//handle anserfw is missed here
//set missed session and save to db
//redirect to missed page
 $this->question_model->edit_quiz_session(array('status' => 'missed'),$_SESSION['id']);

   $_SESSION['action_status_report'] ="<span class='w3-text-red'>Oops, You Missed</span>";
      $this->session->mark_as_flash('action_status_report');
            show_page('question/missed');


     }
   }
    }
    }


}
}