<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

public function __construct()
{
     parent::__construct();
     $this->load->model(array('board_model','users_model','pages_model','admin_model'));
     $this->load->helper(array('url','form','page_helper'));
     $this->load->library(array('form_validation','user_agent'));
}

public function enterprise(){




      $data["title"] ="Pryper | Answer Trivia Questions for FREE and be rewarded";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

   $this->load->view('common/desktop_headermeta_view',$data);
        $this->load->view('public/desktop/enterprise',$data);
      

}

public function make_advertise_request()
{
  $this->form_validation->set_rules('email','Email Address','required|valid_email');
  $this->form_validation->set_rules('phone','Mobile Number','required|is_numeric');

  if(!$this->form_validation->run())
  {

show_page('enterprise');
  }else{
    //send email to support@pryper.com


//send email here
$message = $this->input->post('phone').' '.$this->input->post('email').' Make A Enterprise Request of Type '.$this->input->post('type')." at ".date('F,j Y,g:ia',time());

$this->load->library('email');

//email start here
$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;

$this->email->initialize($config);


$this->email->from($this->input->post('email'), 'System');
$this->email->to('support@pryper.com');

$this->email->subject('Pryper Enterprise | '.$this->input->post('email'));

$this->email->message($message);

$this->email->send();

$action_message ="Request Successfull,You Will receive a response report soon from contact@pryper.com.Thank You For Partnering With Us";
echo "<script>";
echo "alert('".$action_message."');";
echo "setTimeout(function(){
  window.location.assign('".site_url('enterprise')."');
},100);";

echo "</script>";

  }

}

public function resume(){

      $data["title"] ="Olaniyi Ojeyinka Philip";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";
$this->load->view('common/headmeta_view',$data);
        $this->load->view('common/resume',$data);

}
public function letter(){

      $data["title"] ="Olaniyi Ojeyinka Philip";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";
$this->load->view('common/headmeta_view',$data);
        $this->load->view('common/letter',$data);

}

	public function index($slug = null)
	{
   
   if (!$this->agent->is_mobile()) {
     show_page('enterprise');
   }else{
         show_page('mobile');

   }

     	$data["title"] ="Pryper | Answer Trivia Questions for FREE and be rewarded";
     	$data["keywords"] ="pryper,questions,Trivia,africa,reward,";
     	$data["author"] ="Pryper";
		 $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
		 for getting Trivia Questions Right.No Initial Payment or Registration fee required";

		$this->load->view('common/headmeta_view',$data);
        $this->load->view('common/public_mobile_header_view',$data);
        //$this->load->view('common/nav_view',$data);
		$this->load->view('public/home_view',$data);
        $this->load->view('common/public_mobile_footer_view',$data);
	}

public function mobile($slug = null)
  {
   
  

      $data["title"] ="Pryper | Answer Trivia Questions for FREE and be rewarded";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

    $this->load->view('common/headmeta_view',$data);
        $this->load->view('common/public_mobile_header_view',$data);
        //$this->load->view('common/nav_view',$data);
    $this->load->view('public/home_view',$data);
        $this->load->view('common/public_mobile_footer_view',$data);
  }




public function single_page($slug = NULL)
{
       $data['item'] = $this->pages_model->get_pages($slug);

        if (empty($data['item']) || $slug == NULL)
        {
                show_404();
        }


        $data['title'] = 'Pryper | '.$data['item']['title'];
      $data['keywords'] = $data['item']['keywords'];
      $data['keywords'] = $data['item']['description'];
      $data['author'] = $data['item']['author'];
      $data['description'] = $data['item']['description'];


        $data['page_code'] = $data['item']['text'];


        		$this->load->view('common/headmeta_view',$data);
                $this->load->view('common/header_view',$data);
                $this->load->view('common/nav_view',$data);
        		$this->load->view('public/single_view',$data);
        		$this->load->view('common/footer_view',$data);


}
public function contact_us()
{

$this->form_validation->set_rules('name','Name','required');
$this->form_validation->set_rules('email','Email','required');
$this->form_validation->set_rules('message','Message Contents','required');
if(!$this->form_validation->run())
{
 
     	$data["title"] ="Pryper | Contact Us";
     	$data["keywords"] ="pryper,questions,Trivia,africa,reward,";
     	$data["author"] ="Pryper";
		 $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
		 for getting Trivia Questions Right.No Initial Payment or Registration fee required";

		
      if(isset($_SESSION['id']))
      {
        $this->load->view('common/headmeta_view',$data);
        $data['user_details'] = $this->users_model->get_user_by_id();
        $this->load->view('user/common/users_nav_view',$data);

        $this->load->view('common/header_view',$data);


      }else{

        $this->load->view('common/headmeta_view',$data);

        $this->load->view('common/header_view',$data);

        $this->load->view('common/board_nav_view',$data);

      }
      $this->load->view('user/common/pre_content_view',$data);

           $this->load->view('user/contact_view',$data);
           $this->load->view('user/common/post_content_view',$data);

      $this->load->view('common/footer_view',$data);

}else{

  //send the message to admin


//send email here


$this->load->library('email');

//email start here
$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;

$this->email->initialize($config);


$this->email->from($this->input->post('email'), 'System');
$this->email->to('support@pryper.com');

$this->email->subject('Pryper Contact Us | '.$this->input->post('name'));

$this->email->message($this->input->post('message'));

$this->email->send();



$_SESSION['action_status_report'] = "<span class='w3-text-green'>Message Sent</span>";
$this->session->mark_as_flash('action_status_report');

show_page('contact');

}



}
//admin login 

public function admin_login()
{

$this->form_validation->set_rules('name','Username','required');

$this->form_validation->set_rules('password','Password','required');

if (!$this->form_validation->run()){
//admin login page


      $data["title"] ="Pryper | Account Balance";
      $data["keywords"] ="pryper,questions,Trivia,africa,reward,";
      $data["author"] ="Pryper";
     $data["descriptions"] ="Pryper is a FREE Daily Quiz platform that reward its Users 
     for getting Trivia Questions Right.No Initial Payment or Registration fee required";

       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
       

      $this->load->view('admin/login_view',$data);
      



}else{
/*
for now password and username will be hardcoded
later team and permission facilty will be provided
*/

if($this->admin_model->check_admin_login())
{
  $_SESSION['admin_logged_in'] = TRUE;
  $_SESSION['admin_name'] = $this->input->post('username');
show_page('admin');

}else{

$_SESSION['action_status_report'] ='<span class="w3-text-red">Wrong Details Provided</span>';
$this->session->mark_as_flash('action_status_report');
show_page('page/admin_login');
}

}





}
}
