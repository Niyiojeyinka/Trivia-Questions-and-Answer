<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_question extends CI_Controller {

public function __construct()
{
     parent::__construct();

     $this->load->model(array('team_model','admin_question_model','question_model' ,
     'dashboard_model' ,'admin_blog_model','pages_model','users_model'));
     $this->load->helper(array('url','form_helper','blog_helper','time_helper','page_helper'));
     $this->load->library(array('form_validation','session'));
     //  session_start();
     	//get this from db later

   
 if (!isset($this->session->admin_logged_in))
 {

show_page('page/admin_login');

 }




}
/*
//callback function
public function if_question_exist() {
//check uniqueness

$condition_array = array('subject' => $this->input->post('subject'),'year' => $this->input->post('year'),
'paper_type'  => $this->input->post('paper_type'),'question_number'  => $this->input->post('question_number') );
$outp = $this->admin_question_model->get_questions($condition_array);
if(empty($outp))
{
  $_SESSION['action_status']= '<b class="w3-text-green">
  Question not already exists</b>';
  $this->session->mark_as_flash('action_status');

return TRUE;
}else{

  $_SESSION['action_status']= '<b class="w3-text-red">
  question Already Exists</b>';
  $this->session->mark_as_flash('action_status');
  return FALSE;


}

 }*/
	public function add_question()
	{
     $this->form_validation->set_rules("fifty_answer","Fifty Fifty Answer","required");
      $this->form_validation->set_rules("time_allowed","Time Allowed","required");
     $this->form_validation->set_rules("answer","Answer","required");
     $this->form_validation->set_rules("option_a","Option A","required");
     $this->form_validation->set_rules("option_b","Option B","required");
     $this->form_validation->set_rules("option_c","Option C","required");
     $this->form_validation->set_rules("option_d","Option D","required");
     $this->form_validation->set_rules("option_type","Option Type","required");
     $this->form_validation->set_rules("question_type","Question Type"/*,"callback_if_question_exist"*/);
     $this->form_validation->set_rules("question","Question","required|max_length[256]");



	$config['upload_path'] = "assets/questions";
	$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
  $config['max_size'] = '2000';
   

 $this->load->library('upload', $config);





	if($this->form_validation->run() == FALSE)
	{

      $data["title"] ="Pryper | Add Question";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';

           $data['no_stage'] = count($this->question_model->get_stages());



 	$this->load->view('/admin/header_view',$data);

		$this->load->view('admin/sidebar_view',$data);

						$this->load->view('admin/questions/add_question_view',$data);
		$this->load->view('admin/footer_view');




	}else{
	//show next:input to db
	if($this->upload->do_upload('question_img') !=FALSE)
	{
	$qimg = $this->upload->data("file_name");


	}

	if($this->admin_question_model->insert_question())
	{
	//sucesspage
  $_SESSION['action_statu']=  '<b class="w3-text-green">
  New Question Added Successfully</b>';
  $this->session->mark_as_flash('action_statu');
	show_page("admin_question/add_question");

	}else{
	//error page
  $_SESSION['action_statu']= '<b class="w3-text-red">
  Unknown error occurred</b>';
  $this->session->mark_as_flash('action_statu');
  show_page("admin_question/add_question");

	}




	}


	}
  public function edit_question($id = NULL)
  {

//get saved data
    $data['question'] = $this->question_model->get_question_by_its_id($id);

    
     $this->form_validation->set_rules("fifty_answer","Fifty Fifty Answer","required");
      $this->form_validation->set_rules("time_allowed","Time Allowed","required");
     $this->form_validation->set_rules("answer","Answer","required");
     $this->form_validation->set_rules("option_a","Option A","required");
     $this->form_validation->set_rules("option_b","Option B","required");
     $this->form_validation->set_rules("option_c","Option C","required");
     $this->form_validation->set_rules("option_d","Option D","required");
     $this->form_validation->set_rules("option_type","Option Type","required");
     $this->form_validation->set_rules("question_type","Question Type"/*,"callback_if_question_exist"*/);
     $this->form_validation->set_rules("question","Question","required|max_length[256]");



  $config['upload_path'] = "assets/questions";
  $config['allowed_types'] = 'gif|jpg|png|jpeg'; $config['max_size'] = '500';
   $config['max_width'] = '800'; 
   $config['max_height'] = '600';

 $this->load->library('upload', $config);





  if($this->form_validation->run() == FALSE)
  {

 $data["title"] ="Pryper | Edit Question";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';

           $data['no_stage'] = count($this->question_model->get_stages());



  $this->load->view('/admin/header_view',$data);

    $this->load->view('admin/sidebar_view',$data);

            $this->load->view('admin/questions/edit_question_view',$data);
    $this->load->view('admin/footer_view');




  }else{


//edit here 
//show next:input to db
        $question = $this->question_model->get_question_by_its_id($id);

  if($this->upload->do_upload('question_img') !=FALSE)
  {
  $qimg = $this->upload->data("file_name");


  }else{

  $qimg = $question['question_img'];

  }

  if($this->admin_question_model->edit_question($this->uri->segment(3),$qimg))
  {
  //sucesspage
  $_SESSION['action_status_report']=  '<b class="w3-text-green">Question 
  Edited  Successfully</b>';
  $this->session->mark_as_flash('action_status_report');
  show_page("admin_question/edit_question/".$this->uri->segment(3));

  }else{
  //error page
  $_SESSION['action_status_report']= '<b class="w3-text-red">
  Unknown error occurred</b>';
  $this->session->mark_as_flash('action_status_report');
  show_page("admin_question/edit_question/".$this->uri->segment(3));

  }



  }




  }

 public function  perform_action($action,$id= null)
 {

  //action here can be unpublish,publish
if ($action == 'publish') {
 $this->db->update('questions',array('status' => 'published'),array('id' => $id));

 $_SESSION['action_status_report']= '<b class="w3-text-green">Question Published</b>';
  $this->session->mark_as_flash('action_status_report');
  show_page("admin_question/questions/nigeria/");
}else{
 $this->db->update('questions',array('status' => 'unpublished'),array('id' => $id));

 $_SESSION['action_status_report']= '<b class="w3-text-green">
 Question UnPublished</b>';
  $this->session->mark_as_flash('action_status_report');
  show_page("admin_question/questions/nigeria/");
}
}

 
public function delete_question($id = NULL)
{
if (!empty($id)) {
  

$this->question_model->delete_item('questions',array('id' => $id));
$_SESSION['action_status_report'] = "<span class='w3-text-green'>Question Deleted Successfully</span>";
$this->session->mark_as_flash('action_status_report');

/*on scaling get admin country here*/
show_page('admin_question/questions/nigeria');
//get admin country on reg.

}

}

public function questions($country= NULL,$offset = 0)
{


  $limit = 20;
    $this->load->library('pagination');
    $data['items'] = $this->admin_question_model->get_questions(array('country' => $country),$offset,$limit);
  $config['base_url'] = site_url("admin_question/questions/".$this->uri->segment(3));

//$config['total_rows'] = count($this->admin_question_model->get_bulklist(null,null));
$config['total_rows'] = $this->db->count_all('questions');

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


 $data["title"] ="Pryper | ".$country." Questions";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';



    $this->load->view('/admin/header_view',$data);

      $this->load->view('admin/sidebar_view',$data);

      $this->load->view('admin/questions/questions_view',$data);
      $this->load->view('admin/footer_view');


}


}
