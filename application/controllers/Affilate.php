<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Affilate extends CI_Controller {
/*

Name:Pryce to PryPer
Date:Start Rewriting  it on Oct 6, 2017 1:09:25 PM



*/



public function __construct()
{
     parent::__construct();

    $this->load->model(array('users_model','dashboard_model','pages_model','question_model'));
    $this->load->helper(array('url','form','page_helper'));
     $this->load->library(array('form_validation','session'));
//user login check here

      if (!isset($this->session->id) || !isset($this->session->logged_in))
       {   
show_page('login');
           }


}



public function index($slug = null)
{

  
      $data["title"] ="Pryper | Affilate Program";
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
           $this->load->view('user/affilate_view',$data);
           $this->load->view('user/common/post_content_view',$data);
      $this->load->view('common/footer_view',$data);

}
public function r($username)
{








}
}