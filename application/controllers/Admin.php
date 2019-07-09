<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

public function __construct()
{
    parent::__construct();

    $this->load->model(array('admin_question_model' ,
    'dashboard_model' ,'admin_blog_model','pages_model','board_model','users_model','question_model','admin_model'));
    $this->load->helper(array('url','form_helper','blog_helper','time_helper','page_helper'));
    $this->load->library(array('form_validation','session'));
    //session_start();
    //get this from db later

 if (!isset($this->session->admin_logged_in))
 {

show_page('page/admin_login');

 }

}

public function index() {

      $data["title"] ="Pryper | Admin Dashboard";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';

$data['num_of_users'] =  count($this->users_model->get_users(NULL,NULL));

 $data['num_of_topics'] = $this->board_model->count_topics();
      $data['num_of_comments'] = $this->board_model->count_comments();
      $data['last_post_time'] = date( "F j, Y, g:i a",$this->board_model->get_last_time_of_post());
      $data['last_comment_time'] = date( "F j, Y, g:i a",$this->board_model->get_last_time_of_comment());
      $data['total_views'] = $this->board_model->count_views();
$data['num_of_users'] =  count($this->users_model->get_users(NULL,NULL));
$data['no_guests'] = count(online_users($this->board_model->get_guests()));
$data['no_online'] = count(online_users($this->users_model->get_users(NULL,NULL)));

$data['num_of_published_questions'] = $this->admin_model->count_questions(array('status' => 'published'));
$data['num_of_unpublished_questions'] = $this->admin_model->count_questions(array('status' => 'unpublished'));

$data['num_of_total_questions'] = $this->admin_model->count_all_questions();
$data['num_of_users_24'] = count($this->users_model->count_users_reg_at_time(86400));
$data['num_of_users_3d'] = count($this->users_model->count_users_reg_at_time(86400*3));
$data['num_of_users_7d'] = count($this->users_model->count_users_reg_at_time(86400*7));

$data['num_of_users_30d'] = count($this->users_model->count_users_reg_at_time(86400*30));


$data['num_of_users_online_24'] = count($this->users_model->count_users_online_at_time(86400));

$data['num_of_users_online_30d'] = count($this->users_model->count_users_online_at_time(2592000));
$data['num_of_guests_24'] = count($this->board_model->count_guest_online_at_time(86400));
$data['num_of_topics_24'] = count($this->board_model->count_topics_added_at_time(86400));








	$this->load->view('/admin/header_view',$data);

	$this->load->view('admin/sidebar_view',$data);

	$this->load->view('admin/first_view',$data);
	$this->load->view('admin/footer_view');




}


public function our_users($offset = 0) {


  	$limit = 8;
  		$this->load->library('pagination');




        $data['items'] = $this->users_model->get_users($offset,$limit);




  	$config['base_url'] = site_url("admin/our_users");



  $config['total_rows'] = count($this->users_model->get_users(null,null));
  //$config['total_rows'] = $this->db->count_all('pages');

  	$config['per_page'] = $limit;

   //$config['uri_segment'] = 4;
  $config['first_tag_open'] = '<span class="w3-btn w3-blue w3-text-white">';
  $config['first_tag_close'] = '</span>';
  $config['last_tag_open'] = '<br><span class="w3-btn w3-blue w3-text-white">';
  $config['last_tag_close'] = '</span>';
  $config['first_link'] = 'First';



  $config['prev_link'] = 'Prev';
  $config['next_link'] = 'Next';
  $config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-blue w3-text-white">';
  $config['next_tag_close'] = '</span><br>';
  $config['prev_tag_open'] = '<span style="" class="w3-btn w3-blue w3-text-white">';
  $config['prev_tag_close'] = '</span>';
  $config['last_link'] = 'Last';
  $config['display_pages'] = false;

  	   $this->pagination->initialize($config);
  $data['pagination'] = $this->pagination->create_links();

      $data["title"] ="Pryper |Our Users ";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';

$this->load->view('/admin/header_view',$data);
	$this->load->view('admin/sidebar_view',$data);
	$this->load->view('admin/userslist_view',$data);
	$this->load->view('admin/footer_view');



}

public function add_common()
{




      $data['items'] = $this->pages_model->get_commons();





    $this->form_validation->set_rules("position","Common Element Position",
  "required"/*|is_unique[common_tab.position]*/);



  if($this->form_validation->run() == FALSE)
  {

  //show error

      //check login for admin here later

      $data['items'] = $this->pages_model->get_commons();

$data["title"] ="Pryper | Add Common Contents ";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';


  $this->load->view('/admin/header_view',$data);

    $this->load->view('admin/sidebar_view',$data);

            $this->load->view('admin/add_common_view',$data);
    $this->load->view('admin/footer_view');




  }else{
  //show next:input to db

  $this->pages_model->insert_common();
  
  $_SESSION['action_status_report'] ='<span class="w3-text-green">A new Common Space has been
  successfully created</span>';
  $this->session->mark_as_flash('action_status_report');
  show_page("admin/add_common");

  



  }





    }



  public function user_profile($id = NULL)
  {



$data['title'] ="Pryper | User Profile";
$data['description'] ="Admin Dashboard";

$data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
$limit = NULL;
$data['user'] = $this->users_model->get_user_by_its_id($id);


  $this->load->view('/admin/header_view',$data);

  $this->load->view('admin/sidebar_view',$data);

  $this->load->view('admin/user_profile_view',$data);
  $this->load->view('admin/footer_view');



}



  public function search_users($offset = NULL)
  {





  //    $limit = 10;
      $limit = 8;


    $data['items']= $this->admin_model->search_users($limit,$offset);
      $this->load->library('pagination');

    $config['base_url'] = site_url("admin/search_users");



$config['total_rows'] = count($this->admin_model->search_users(NULL,NULL));
    $config['per_page'] = $limit;

   //$config['uri_segment'] = 4;
  $config['first_tag_open'] = '<span class="w3-btn w3-blue w3-text-white">';
  $config['first_tag_close'] = '</span>';
  $config['last_tag_open'] = '<br><span class="w3-btn w3-blue w3-text-white">';
  $config['last_tag_close'] = '</span>';
  $config['first_link'] = 'First';



  $config['prev_link'] = 'Prev';
  $config['next_link'] = 'Next';
  $config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-blue w3-text-white">';
  $config['next_tag_close'] = '</span><br>';
  $config['prev_tag_open'] = '<span style="" class="w3-btn w3-blue w3-text-white">';
  $config['prev_tag_close'] = '</span>';
  $config['last_link'] = 'Last';
  $config['display_pages'] = false;

       $this->pagination->initialize($config);
  $data['pagination'] = $this->pagination->create_links();





$data['title'] = "Pryper | Search Result";

      $this->load->view('/admin/header_view',$data);

      $this->load->view('admin/sidebar_view',$data);

              $this->load->view('admin/user_search_view',$data);
      $this->load->view('admin/footer_view');





  }


public function email($id = NULL)
{
$data['title'] ="Pryper | Send Email to user";
$data['description'] ="Admin Dashboard";

$data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
$limit = NULL;


$this->form_validation->set_rules('title','
  Message Title', 'required');

$this->form_validation->set_rules('contents','
  Message Contents', 'required');





if(!$this->form_validation->run())
{
  $this->load->view('/admin/header_view',$data);

  $this->load->view('admin/sidebar_view',$data);

  $this->load->view('admin/send_email_view',$data);
  $this->load->view('admin/footer_view');
}else{


$user = $this->users_model->get_user_by_its_id($this->uri->segment(3));
$theemail = $user['email'];
  //db

$msg = array(

'receiver_id' => $this->uri->segment(3),
'title' => $this->input->post('title'),
'message' => $this->input->post('contents'),
'type' => $this->input->post('type'),
'status' => 'unread',
'time' => time()

);


$this->admin_model->save_message($msg);

//send email here

$this->load->library('email');

//email start here
$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;

$this->email->initialize($config);


$this->email->from('support@bankalert.com.ng', 'System');
$this->email->to($theemail);

$this->email->subject('IBOx | '.$this->input->post('title'));
$this->email->message($this->input->post('contents'));

$this->email->send();



  //sucesspage
    $_SESSION['action_status_report'] ='<span class="w3-text-green">The
     Email  has been sent successfully</span>';
    $this->session->mark_as_flash('action_status_report');
    show_page("admin/send_msg/".$this->uri->segment(3));

}
}

  public function credit($id = NULL)
{



$user = $this->users_model->get_user_by_its_id($id);

$this->form_validation->set_rules('credit',"Amount","required");

if($this->form_validation->run())
{

//credit account




$user['account_bal'] = $user['account_bal'] + $this->input->post('credit');

//insert to db


$dat =  array('account_bal' => $user['account_bal'] );
$this->admin_model->update_user($dat,$id);
$_SESSION['action_status_report'] = "ACcount Credited N".$this->input->post('credit')." successfully";
$this->session->mark_as_flash('action_status_report');
show_page('admin/user_profile/'.$id);

}







}







  public function debit($id = NULL)
{

$user = $this->users_model->get_user_by_its_id($id);

$this->form_validation->set_rules('debit',"Amount","required");

if($this->form_validation->run())
{

//credit account




$user['account_bal'] = $user['account_bal'] - $this->input->post('debit');

//insert to db


$dat =  array('account_bal' => $user['account_bal'] );
$this->admin_model->update_user($dat,$id);
$_SESSION['action_status_report'] = "ACcount Debited ".$this->input->post('debit')." successfully";
$this->session->mark_as_flash('action_status_report');
show_page('admin/user_profile/'.$id);

}







}


public function suspend($id = NULL)
{

$new_user_details = array('status' => "suspended" );

$this->admin_model->update_user($new_user_details,$id);


show_page('admin/user_profile/'.$id);


}

public function unsuspend($id = NULL)
{

$new_user_details = array('status' => "active" );

$this->admin_model->update_user($new_user_details,$id);


show_page('admin/user_profile/'.$id);


}



public function view_users_referred($username = NULL)
{

$data['title'] ="Pryper | User Profile";
$data['description'] ="Admin Dashboard";

$data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
//get users referred since reg 
$data['total_users_referred'] = count($this->admin_model->get_users_referred(array(
"refferal_username" => $username

),NULL,NULL));
//get premium users referred since registration
$data['total_premium_users_referred'] = count($this->admin_model->get_users_referred(array(
"refferal_username" => $username,
"paid_status" => "true"
),NULL,NULL));

//get users reffered since last withdrawal
$user_id = $this->users_model->get_user_by_its_username($username)['id'];
//get last withdrawal time
$withdrawals = $this->admin_model->get_withdrawal(array('user_id' => $user_id),NULL,NULL);

//check if withdrawal is greater 1 if yes he has withrawn 
//before 
if (count($withdrawals) > 1)
{

//index of last withdrawal
$last_index = count($withdrawals)-2;
$last_withdrawal_time = $this->admin_model->get_withdrawal(array('user_id' => $user_id),NULL,NULL)[$last_index]['time'];

//users refer since withdrawal
$data['users_referred_since_w'] = $this->admin_model->get_users_referred_at_time($last_withdrawal_time,$username);

$data['no_of_users_referred_since_w'] = count($data['users_referred_since_w'] ) ;
$data['last_withdrawal_time'] = $last_withdrawal_time;

}else{

$data['last_withdrawal_time'] = NULL;


}





      $this->load->view('/admin/header_view',$data);

      $this->load->view('admin/sidebar_view',$data);

              $this->load->view('admin/user_referred_list_view',$data);
      $this->load->view('admin/footer_view');




}

public function login_to_user_account($id = NULL)
{

$username = $this->users_model->get_user_by_its_id($id)['username'];

$_SESSION["id"] = $id;


$_SESSION["logged_in"] = true;


show_page("dashboard/index");





}


  public function edit_common($id =NULL)
  {



//get common from db here

      $data['items'] = $this->pages_model->get_commons();



        $data['item'] = $this->pages_model->get_common_id($id);

        $data['position'] = $data['item']['position'];
        $data['name'] = $data['item']['short_det'];
        $data['content'] = $data['item']['content'];



        $data['id2'] = $id;

        $this->form_validation->set_rules("content","Common Contents","required");


  if($this->form_validation->run() == FALSE)
  {



$data["title"] ="Pryper | Edit Contents ";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
    $this->load->view('/admin/header_view',$data);

    $this->load->view('admin/sidebar_view',$data);

            $this->load->view('admin/edit_common_view',$data);
    $this->load->view('admin/footer_view');

}else{



  //show next:input to db

  $this->pages_model->edit_common($this->input->post("id"));
  
  $_SESSION['action_status_report'] ="<span class='w3-text-green'>This Common
   Space  has been successfully Edited</span>";
  $this->session->mark_as_flash('action_status_report');

  show_page("admin/edit_common/".$this->input->post('id'));


}

  }





    public function delete_common($id =NULL)
    {


    if($this->pages_model->delete_common($id))
    {
    //sucesspage
    $_SESSION['action_status_report'] ='<span class="w3-text-green">This
     Common Space  has been successfully Deleted</span>';
    $this->session->mark_as_flash('action_status_report');
    show_page("admin/add_common/");

    }else{
    //error page
    $_SESSION['action_status_report'] ='<span class="w3-text-red">
    Unknown error occurred</span>';
    $this->session->mark_as_flash('action_status_report');

      show_page("admin/add_common/");

    }






  }
public function set_game_time()
{

$this->form_validation->set_rules('stime','Game Start Time','required');

if (!$this->form_validation->run()) {
 

   $data['title'] = "Pryper | Set Game Time";
$data['quiz_start'] = $this->dashboard_model->get_country_by_select_value('nigeria')['next_quiz_start'];
$data['quiz_end'] = $this->dashboard_model->get_country_by_select_value('nigeria')['quiz_end'];

   $this->load->view('/admin/header_view',$data);
   $this->load->view('/admin/sidebar_view',$data);
   $this->load->view('/admin/set_game_time_view',$data);
   $this->load->view('/admin/footer_view',$data);
}else{
//check if date is valid
  $start_time = $this->input->post('day').'-'.$this->input->post('month').'-'.$this->input->post('year').' '.$this->input->post('stime').' ';
$start_time =  strtotime($start_time);

if($start_time < time())
{
   $_SESSION['action_status_report'] ="<center><div class='w3-text-red'>Time is not valid;Please use time greater than ".date("F j, Y, g:i a",time())."</div></center>";
  $this->session->mark_as_flash('action_status_report'); 
  show_page('admin/set_game_time');
}else{

//date is valid

$end_time = $start_time + ($this->input->post('duration') * 60);

$this->admin_model->set_time($start_time,$end_time,$this->input->post('country'));
//on scale set country here

$_SESSION['action_status_report'] ="<center><div class='w3-text-green'>Time Set Successfully</div></center>";
  $this->session->mark_as_flash('action_status_report');  
  show_page('admin/set_game_time');

}
}
}


public function set_voting_time()
{

$this->form_validation->set_rules('stime','Game Start Time','required');

if (!$this->form_validation->run()) {
 

   $data['title'] = "Pryper | Set Voting Time";
$data['vote_start'] = $this->dashboard_model->get_country_by_select_value('nigeria')['next_voting_start'];
$data['vote_end'] = $this->dashboard_model->get_country_by_select_value('nigeria')['voting_end'];

   $this->load->view('/admin/header_view',$data);
   $this->load->view('/admin/sidebar_view',$data);
   $this->load->view('/admin/set_voting_time_view',$data);
   $this->load->view('/admin/footer_view',$data);
}else{
//check if date is valid
  $start_time = $this->input->post('day').'-'.$this->input->post('month').'-'.$this->input->post('year').' '.$this->input->post('stime').' ';
$start_time =  strtotime($start_time);

if($start_time < time())
{
   $_SESSION['action_status_report'] ="<center><div class='w3-text-red'>Time is not valid;Please use time greater than ".date("F j, Y, g:i a",time())."</div></center>";
  $this->session->mark_as_flash('action_status_report'); 
  show_page('admin/set_voting_time');
}else{

//date is valid

$end_time = $start_time + ($this->input->post('duration') * 60);

$this->admin_model->set_voting_time($start_time,$end_time,$this->input->post('country'));
//on scale set country here

$_SESSION['action_status_report'] ="<center><div class='w3-text-green'>Time Set Successfully</div></center>";
  $this->session->mark_as_flash('action_status_report'); 
  show_page('admin/set_voting_time');

}
}
}


  public function open_stage_tips()
{


    $this->form_validation->set_rules("stage","Stage","required");
  if($this->form_validation->run())
  {


$data["title"] ="Pryper | Stage Tips";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';

$data['tips'] = $this->admin_model->get_tips_by_stage_id($this->input->post('stage'));
  $this->load->view('/admin/header_view',$data);

    $this->load->view('admin/sidebar_view',$data);

            $this->load->view('admin/stage_tips_view',$data);
    $this->load->view('admin/footer_view');

}

}

public function delete_tip($id= NULL)
{

$this->db->delete('tips',array('id'=>$id));
$_SESSION['action_status_report'] ="<center><div class='w3-text-red'>Deleted Successfully</div></center>";
  $this->session->mark_as_flash('action_status_report'); 

show_page('admin/manage_tips');

}
public function view_tip_vote_result()
{


 $data["title"] ="Pryper | Vote Result";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
      

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


$this->load->view('/admin/header_view',$data);

    $this->load->view('admin/sidebar_view',$data);

           $this->load->view('user/vote_result_view',$data);
    $this->load->view('admin/footer_view');

           



}

public function manage_tips()
{

    $this->form_validation->set_rules("tip","Tips",
  "required|is_unique[tips.label]");



  if($this->form_validation->run() == FALSE)
  {


  $data['no_stage'] = count($this->question_model->get_stages());

$data["title"] ="Pryper | Manage Tips ";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';


  $this->load->view('/admin/header_view',$data);

    $this->load->view('admin/sidebar_view',$data);

            $this->load->view('admin/manage_tips_view',$data);
    $this->load->view('admin/footer_view');
}else{ 

$this->admin_model->insert_tip();
 $_SESSION['action_status_report'] ='<span class="w3-text-green">
    Tip Added successfully</span>';
    $this->session->mark_as_flash('action_status_report');

      show_page("admin/manage_tips");
}

}

  public function withdrawal($offset = NULL)
{
    $limit = 8;
      $this->load->library('pagination');

$cond =array(

"status" => "pending"

);
$data['items'] = $this->admin_model->get_withdrawal($cond,$offset,$limit);

    $config['base_url'] = site_url("admin/withdrawal");
      $config['total_rows'] = count( $this->admin_model->get_withdrawal($cond,null,null));
  //$config['total_rows'] = $this->db->count_all('pages');

    $config['per_page'] = $limit;

   //$config['uri_segment'] = 4;
  $config['first_tag_open'] = '<span class="w3-btn w3-blue w3-text-white">';
  $config['first_tag_close'] = '</span>';
  $config['last_tag_open'] = '<br><span class="w3-btn w3-blue w3-text-white">';
  $config['last_tag_close'] = '</span>';
  $config['first_link'] = 'First';



  $config['prev_link'] = 'Prev';
  $config['next_link'] = 'Next';
  $config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-blue w3-text-white">';
  $config['next_tag_close'] = '</span><br>';
  $config['prev_tag_open'] = '<span style="" class="w3-btn w3-blue w3-text-white">';
  $config['prev_tag_close'] = '</span>';
  $config['last_link'] = 'Last';
  $config['display_pages'] = false;

       $this->pagination->initialize($config);
  $data['pagination'] = $this->pagination->create_links();
$data['withdrawal_switch'] = $this->admin_model->get_withdrawal_switch()['variable_value'];

$data['withdrawal_info'] = $this->admin_model->get_withdrawal_switch_err_info()['long_value'];

$data['title'] ="Pryper | Admin Payment Page";
$data['description'] ="Admin Dashboard";

$data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
$limit = NULL;
$data['payment_items'] = $this->users_model->get_payment_items($offset,$limit);
$cond = array(
"status" => "pending"


);


  $this->load->view('/admin/header_view',$data);

  $this->load->view('admin/sidebar_view',$data);

  $this->load->view('admin/admin_withdrawal_view',$data);
  $this->load->view('admin/footer_view');

}
public function reward_winners()
{

$this->form_validation->set_rules('reward','Reward','required');
if(!$this->form_validation->run())
{
$_SESSION['action_status_report'] ="<span class='w3-text-red'>".validation_errors()."</span>";
$this->session->mark_as_flash('action_status_report');
show_page('admin/winners');

}else{

$cond = array(
"status" => "won",
"stage" =>  $no_stage,
"country" => $this->input->post('country')
);
$winners_session = $this->admin_model->get_winners($cond,$offset,$limit);
$each_reward = $this->input->post('reward')/count($winners_session);
foreach ($winners_session as $winner_session) {
//get user details by winner_session['user_id']
  $user = $this->users_model->get_user_by_its_id(winner_session['user_id']);
$user_country = $this->dashboard_model->get_country_by_select_value($user['country']);

  $new_bal = $user['account_bal']+$each_reward; 
  $this->users_model->edit_user_details(array('account_bal' => $new_bal),$user['id']);
  //insert to notification
  //insert to history

$noti = array(
                      'sender_id' => '@admin',
                      'receiver_id' => $user['id'],
                      'contents' => "You just Received a Reward of ".$user_country['currency_code']."".$each_reward,
                      'type' => 'reward',
                      'slug' => '',
                      'status' => 'unread',
                      'time' => time()
              );
              $this->db->insert('notifications', $noti);

$details = "Congratulations,You just Received a Reward of ".$user_country['currency_code']."".$each_reward;
      $h_dat =  array(
        'details' => $details,
        'action' => 'reward' ,
        'user_id' => $user['id'],
        'time' => time()
         );
      $this->users_model->insert_to_history($h_dat);


 $_SESSION['action_status_report'] ='<span class="w3-text-green">
    winners rewarded Successfully</span>';
    $this->session->mark_as_flash('action_status_report');
   show_page('winners');
}


}




}
public function winners($offset =0)
{

$limit = 8;
      $this->load->library('pagination');
           $no_stage = count($this->question_model->get_stages());

$cond =array(

"status" => "won",
"stage" =>  $no_stage

);
$data['winners'] = $this->admin_model->get_winners($cond,$offset,$limit);

    $config['base_url'] = site_url("admin/winners");
      $config['total_rows'] = count( $this->admin_model->get_winners($cond,null,null));
  
    $config['per_page'] = $limit;
  $config['first_tag_open'] = '<span class="w3-btn w3-blue w3-text-white">';
  $config['first_tag_close'] = '</span>';
  $config['last_tag_open'] = '<br><span class="w3-btn w3-blue w3-text-white">';
  $config['last_tag_close'] = '</span>';
  $config['first_link'] = 'First';



  $config['prev_link'] = 'Prev';
  $config['next_link'] = 'Next';
  $config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-blue w3-text-white">';
  $config['next_tag_close'] = '</span><br>';
  $config['prev_tag_open'] = '<span style="" class="w3-btn w3-blue w3-text-white">';
  $config['prev_tag_close'] = '</span>';
  $config['last_link'] = 'Last';
  $config['display_pages'] = false;

       $this->pagination->initialize($config);
  $data['pagination'] = $this->pagination->create_links();
$data['title'] ="Pryper | Winners";
$data['description'] ="Admin Dashboard";

$data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
$limit = NULL;



  $this->load->view('/admin/header_view',$data);
  $this->load->view('admin/sidebar_view',$data);
  $this->load->view('admin/winners_view',$data);
  $this->load->view('admin/footer_view');



}

public function process_withdrawal($id = NULL,$user_id)
{
$user = $this->users_model->get_user_by_its_id($user_id);
//add to total withdrawn

$new_e_bal = $user['earned_bal'] + $user['pending_bal'];

$this->users_model->edit_user_details(array(

"earned_bal" => $new_e_bal

),$user_id);

//empty pending
$this->users_model->edit_user_details(array(

"pending_bal" => 0.00

),$user_id);

//change withdrawal status to proccessed 

$this->admin_model->edit_withdrawal_single(array(

"status" => "processed"
),$id);



  //update neccessary details including history

  $this->admin_model->insert_new_history(array(
"user_id" => $user_id,
"action" => "w_process",
'time' => time(),
"details" => "Your Withdrawal Request Had been Processed"
),$user_id);

$_SESSION['action_status_report'] ="<span class='w3-text-green'>processed successfully</span>";
$this->session->mark_as_flash('action_status_report');
  show_page('/admin/withdrawal');


}



public function send_sms($user_id = NULL)
{
$this->form_validation->set_rules("message","Message",'required|max_length[160]');
$this->form_validation->set_rules("sender_name","Sender Name",'required|max_length[10]');
if (!$this->form_validation->run()) {



$data['title'] ="Pryper | Send SMS";
$data['description'] ="Admin Dashboard";

$data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
$limit = NULL;

if (empty($this->uri->segment(3))) {
 $data['hide_phone_box'] = TRUE;
}else{
$data['hide_phone_box'] = FALSE;
  $data['phone']= $this->users_model->get_user_by_its_id($this->uri->segment(3))['phone'];
}

  $this->load->view('/admin/header_view',$data);
  $this->load->view('admin/sidebar_view',$data);
  $this->load->view('admin/send_sms_view',$data);
  $this->load->view('admin/footer_view');



}else{
$_SESSION['message']  = $this->input->post('message');
$_SESSION['receivers']  = [];
if (empty($this->uri->segment(3))){
//send to all users
$users = $this->users_model->get_all_users();

foreach ($users as $user) {
 
array_push($_SESSION['receivers'] , $user['phone']);

 }
}else{
//send to specific user
array_push($_SESSION['receivers'] , $this->input->post('phone'));

}

 show_page('admin/process_sms/'.$this->uri->segment(3)) ;                                                               
}


}

public function process_sms($id=NULL)
{
$suc = 0;
$fail = 0;
foreach ($_SESSION['receivers'] as $receiver) {
  
//send to each
if ($receiver[0] == '0') {
    $receiver = "234".substr($receiver, 1);
}


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://api.africastalking.com/version1/messaging");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'apiKey:53243eb532defe82c84550ec554ef56576803265455955823d460436a2071c54',
    'Content-Type:application/x-www-form-urlencoded',
    'Accept:application/json'
));
curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, 
         http_build_query(array('username' => 'pryper','to' => $receiver,'message'=> $_SESSION['message'])));

// Receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

curl_close ($ch);
$result_array = json_decode($server_output,true);

if ($result_array['SMSMessageData']['Recipients'][0]['status'] == "Success") {
    $suc++;
}else{
$fail++;
}
   
}

/*var_dump($_SESSION['receivers']);
return;*/

 unset($_SESSION['receivers']);
unset($_SESSION['message']);
$error_msg = $fail." Failed Message ".$suc." Sent!";
$_SESSION['action_status_report']= "<span class='w3-text-green'>".$error_msg."</span>";
   $this->session->mark_as_flash('action_status_report');
    show_page('admin/send_sms/'.$this->uri->segment(3));
}
 

}

