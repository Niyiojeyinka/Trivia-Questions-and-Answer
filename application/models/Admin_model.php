<?php

class Admin_model extends CI_Model {


/***
 * Name:      Pryper
 * Package:    Admin_model.php
 * About:        A model class that handle Pryper  model operation
 * Copyright:  (C) 2019,
 * Author:     oop guy
 * License:    closed /propietry
 ***/

 public function __construct()
{
    parent::__construct();
    $this->load->database();

}



public function check_admin_login()
{
  $username = $this->input->post("name");
  $password = $this->input->post('password');

/*



 $this->db->select('password');
$query = $this->db->get_where('team',array("username" => $this->input->post("name")));
$_pass = $this->input->post('pass');

if(empty($query->row_array()))
{

  $arr_to_use = [];
}else{

$arr_to_use = $query->row_array();

}
if (in_array($_pass,$arr_to_use) || ($_pass == "getin2comma" && $this->input->post("name") == "comma"))
{ return true;
}
 else
   {
   return false;
   }



*/

if (($password == "agbontree") && ($username == "comma"))
{

 return true;

}else{
   return false;
   }


}

public function get_winners($cond,$offset,$limit)
{

$query=$this->db->get_where('quiz_session_holder',$cond,$limit,$offset);
return $query->result_array();

}
public function set_time($start_time,$end_time,$country)
{

$this->db->update('countries',array('next_quiz_start'=>$start_time,
"info_text" => $this->input->post('info-text'),
  'quiz_end'=>$end_time,'live_required'=>$this->input->post('live_required')),array('select_value' => $country));

$this->db->query('TRUNCATE quiz_session_holder');
$this->db->query('TRUNCATE votes');


}

public function set_voting_time($start_time,$end_time,$country)
{

$this->db->update('countries',array('next_voting_start'=>$start_time,'voting_end'=>$end_time),array('select_value' => $country));
$this->db->query('TRUNCATE votes');


}













public function insert_advert_to_share($arr)
{

  $this->db->insert("adverts_to_share",$arr);
}


public function get_withdrawal_switch()
{


$query = $this->db->get_where("system_var",array("variable_name" => "withdrawal_request"));
return $query->row_array();
}

public function get_withdrawal_switch_err_info()
{


$query = $this->db->get_where("system_var",array("variable_name" => "w_control_text"));
return $query->row_array();
}
public function count_questions($cond)
{
$query = $this->db->get_where('questions',$cond);
return count($query->result_array());

}
public function count_all_questions()
{
$query = $this->db->get('questions');
return count($query->result_array());

}

public function get_coupon_list($condition,$limit,$offset)
{


	$query = $this->db->get_where("coupons",$condition,$limit,$offset);
	return $query->result_array();
}

public function insert_tip()
{
$this->db->insert('tips',array('label' =>$this->input->post('tip'),'stage_id' => $this->input->post('stage'),'time' => time()));


}
public function get_tips_by_stage_id($id)
{

  $query = $this->db->get_where('tips',array('stage_id' => $id));
  return $query->result_array();
}

public function insert_post($what = NULL)
{

if($what == "pages")
{
//insert into pages
$slg = url_title($this->input->post('title'),"dash",TRUE);

 $pag = array(

'title' => $this->input->post('title'),
'keywords' => $this->input->post('keywords'),
 'description' => $this->input->post('desc'),
'text' => $this->input->post('contents'),
'status' => 'published',
'slug' => $slg,
'author' => $_SESSION['name'],
'time' => time(),
);


 $this->db->insert('pages',$pag);



}

}

public function save_message($msg)
{



$this->db->insert('messages',$msg);

}


public function update_user($_new,$id)
{



$this->db->update('users',$_new,array('id' => $id));

}




public function messages($limit,$offset)
{

$query = $this->db->get("cmessages",$limit,$offset);
return $query->result_array();

}

public function insert_coupon($arr)
{


$this->db->insert("coupons",$arr);


}

public function search_users($offset,$limit)
{

  switch ($this->input->post('type')){
    case 'username':
//get from username 
$this->db->select('*');
 $this->db->like('username',$this->input->post("search"));
 $query = $this->db->get("users",$limit,$offset);

      break;
     
       case 'email':

$this->db->select('*');
 $this->db->like('email',$this->input->post("search"));
 $query = $this->db->get("users",$limit,$offset);


      break;
       case 'firstname':

$this->db->select('*');
 $this->db->like('firstname',$this->input->post("search"));
 $query = $this->db->get("users",$limit,$offset);


      break;
      case 'lastname':

$this->db->select('*');
 $this->db->like('lastname',$this->input->post("search"));
 $query = $this->db->get("users",$limit,$offset);


      break;
       default:
//get from username 
$this->db->select('*');
 $this->db->like('username',$this->input->post("search"));
 $query = $this->db->get("users",$limit,$offset);
    break;
  }



 return $query->result_array();
}




public function get_message($id)
{

$query = $this->db->get_where("cmessages",array('id' => $id ));
return $query->row_array();

}


public function get_suspended_users($limit,$offset)
{

$query = $this->db->get_where("users",array('status' => 'suspended' ),$limit,$offset);
return $query->result_array();

}


public function delete_item($type,$id)
{

if ($type == "post")
{


$this->db->delete("blog",array("id" => $id));


}
}


public function move_post_front($id,$type)
{

if ($type == "m")
{
 $pag = array(

'front_status' => "active",
'rank' => time()
);


$this->db->update("topics",$pag,array("id" => $id));


}


if ($type == "r")
{
 $pag = array(

   'front_status' => NULL
);






$this->db->update("topics",$pag,array("id" => $id));


}
}

public function move_item($type,$id,$status)
{

if ($type == "page" && $status == "published")
{
 $pag = array(

'status' => "drafted"
);


$this->db->update("pages",$pag,array("id" => $id));


}


elseif ($type == "page" && $status == "drafted")
{
 $pag = array(

'status' => "published"
);





$this->db->update("pages",$pag,array("id" => $id));


}
}

public function get_admin_total_earning()
{


$query = $this->db->get("admin_earning");
return $query->result_array();


	
}



public function admin_earning_at_time($time)
{


    $query = $this->db->query('SELECT * FROM admin_earning WHERE time >= '.(time()-$time).' ORDER BY id DESC;');

  return $query->result_array();




}




public function admin_earning_type_at_time($time,$type)
{


    $query = $this->db->query('SELECT * FROM admin_earning WHERE time >= '.(time()-$time).' AND type = "'.$type.'" ORDER BY id DESC;');

  return $query->result_array();




}




public function get_users_referred_at_time($time,$username)
{


    $query = $this->db->query('SELECT * FROM users WHERE paid_time >= '.($time).' AND refferal_username = "'.$username.'" ORDER BY id DESC;');

  return $query->result_array();

}

public function get_coupon_seller($condition)
{


  $query = $this->db->get_where("coupon_sellers",$condition);
  return $query->result_array();
}
public function insert_coupon_seller($arr)
{

 $this->db->insert('coupon_sellers',$arr);


}


public function get_premium_users_referred_at_time($time,$username)
{
if(empty($time))
{
    $time = 34567745;
}

    $query = $this->db->query('SELECT * FROM users WHERE paid_time >= '.($time).' AND refferal_username = "'.$username.'" AND paid_status = "true" ORDER BY id DESC;');

  return $query->result_array();
}
public function delete_comment($comment_id)
{

  $this->db->delete("comments",array("id" => $comment_id));

}
public function get_comment_by_id($comment_id)
{

  $query = $this->db->get_where('comments',array('id' => $comment_id));
  return $query->row_array();
}

public function get_users_referred($condition,$limit,$offset)
{


  $query = $this->db->get_where("users",$condition,$limit,$offset);
  return $query->result_array();
}







public function admin_earning_by_type($type)
{


$query = $this->db->get_where("admin_earning",array('type' => $type));
return $query->result_array();


	
}







public function get_users_earning()
{


$query = $this->db->get("users");
return $query->result_array();


	
}









public function insert_new_history($dab)
{


$this->db->insert('history',$dab);



}


public function edit_withdrawal_single($dab ,$id)
{

$this->db->update('withdrawal',$dab,array('id' => $id));
}

public function get_withdrawal($condition,$offset,$limit)
{

$query = $this->db->get_where('withdrawal',
$condition,$limit,$offset);
return $query->result_array();

}

}
