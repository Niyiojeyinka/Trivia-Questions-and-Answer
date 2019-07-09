<?php
/***
 * Name:       Pryper
 * Package:     Initial.php
 * About:        A controller that handle auto table creation operation operation
 * Copyright:  (C) 2019,
 * Author:     Ojeyinka Philip Olaniyi
 * License:    closed /propietry
 ***/


class Initial extends CI_Controller {
    function index()
    {

    $this->load->database();

  $sql1 = "CREATE TABLE users (
            id int(11) NOT NULL AUTO_INCREMENT,
            firstname varchar(128),
            lastname varchar(128),
            username varchar(128),
            username_edit varchar(2),
            password varchar(128),
            country varchar(128),
            email varchar(128),
            medals int,
            balance_live int,
            phone varchar(128),
            profile_img varchar(128),
            phonevc varchar(128),
            status varchar(128),
            short_status varchar(128),
            time int(20),
            account_bal DECIMAL(19,4),
            pending_bal DECIMAL(19,4),
            earned_bal DECIMAL(19,4),
            platform varchar(128),
            browser varchar(128),
            lastlog varchar(128),
            bank_name varchar(128),
            bank_acct varchar(128),
            bank_det varchar(128),
            bank_no varchar(128),
            payment_type varchar(128),
            temp_ref_count int,
            referral_username varchar(128),
            PRIMARY KEY (id)
    );";

    $sql2 = "CREATE TABLE blog (
        id int(11) NOT NULL AUTO_INCREMENT,
        title varchar(128) NOT NULL,
        slug varchar(128),
        author varchar(128),
        time int(20) NOT NULL,
        keywords varchar(225),
        description varchar(225),
        img_url varchar(225),
        status varchar(225),
        text text NOT NULL,
        PRIMARY KEY (id)
);";


//receiver_status options: unread,read
//sender_status options: sent,delivered

 //type options: image,text,imagetext

 $sql3 = "CREATE TABLE questions (
        id int(11) NOT NULL AUTO_INCREMENT,
        answer varchar(2),
        fifty_answer varchar(2),
        question_img varchar(128),
        option_a varchar(255),
        option_b varchar(255),
        option_c varchar(255),
        option_d varchar(255),
        option_e varchar(255),
        option_type varchar(128),
        question text,
        comp text,
        time_allowed varchar(128),
        question_type varchar(128),
        country varchar(128),
        level int(2),
        instructions text,
        explanation text,
        status varchar(128),
        time int(20),
         PRIMARY KEY (id)
);";
//status :published,unpublished
//level options:1,2,3,4
//account type :free,premium
//option type:image,text



    $sql4 = "CREATE TABLE pages (
        id int(11) NOT NULL AUTO_INCREMENT,
        title varchar(128) NOT NULL,
        slug varchar(128) NOT NULL,
        author varchar(128),
        time varchar(128) NOT NULL,
         keywords varchar(225),
        description varchar(225),
        status varchar(225),
        text text NOT NULL,
       PRIMARY KEY (id)
);";



     $sql5 = "CREATE TABLE cmessages (
        id int(11) NOT NULL AUTO_INCREMENT,
        email varchar(128),
        name varchar(128),
        phone varchar(128),
        title varchar(128) NOT NULL,
        sender_id varchar(128) NOT NULL,
        username varchar(128),
        message  text NOT NULL,
        status varchar(128),
        solved varchar(128),
        logged_in varchar(128),
        time varchar(128),
        PRIMARY KEY (id)
);";




     $sql6= "CREATE TABLE newsletter (
        id int(11) NOT NULL AUTO_INCREMENT,
        email varchar(128),
        name varchar(128),
        status varchar(128),
        PRIMARY KEY (id)
);";




     $sql7 = "CREATE TABLE media (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(128),
        time int(20),
        link varchar(128),
        type varchar(128),
        PRIMARY KEY (id)
);";



 $sql8 = "CREATE TABLE system_var (
    id int(11) NOT NULL AUTO_INCREMENT,
    variable_name varchar(128),
    variable_value varchar(128),
    long_value text,
    PRIMARY KEY (id)
);";


     $sql9 = "CREATE TABLE history (
        id int(11) NOT NULL AUTO_INCREMENT,
        user_id varchar(128),
         details varchar(128),
        action varchar(128),
         time int(20),
         PRIMARY KEY (id)
);";




     $sql10 = "CREATE TABLE common_tab (
        id int(11) NOT NULL AUTO_INCREMENT,
        position varchar(128),
        short_det varchar(128),
         content text,
        PRIMARY KEY (id)
);";




     $sql11 = "CREATE TABLE comments (
        id int(11) NOT NULL AUTO_INCREMENT,
        time varchar(128),
        email varchar(128),
        slug varchar(128),
        status varchar(128),
        img_url varchar(128),
        user_id varchar(128),
        is_reply varchar(128),
        reply_to varchar(128),
        report_status varchar(128),
        content text,
        likes text,
        PRIMARY KEY (id)
);";

//is_reply column is of "true" or "false"






    $sql12 = "CREATE TABLE results (
        id int(11) NOT NULL AUTO_INCREMENT,
        user_id varchar(128) NOT NULL,
        standard_score varchar(128),
        percentage_got varchar(128),
        time int(20) NOT NULL,
        no_of_question varchar(225),
        time_used varchar(128),
        time_used_percentage varchar(128),
        start_time varchar(128),
        time_allowed varchar(128),
         PRIMARY KEY (id)
);";



     $sql13 = "CREATE TABLE notifications (
        id int(11) NOT NULL AUTO_INCREMENT,
        sender_id varchar(128),
        receiver_id varchar(128),
        slug varchar(128),
        contents varchar(128),
        ref_id varchar(128),
        type varchar(128),
        status varchar(128),
        time varchar(128),
          PRIMARY KEY (id)
);";

  
      $sql14 = "CREATE TABLE topics (
         id int(11) NOT NULL AUTO_INCREMENT,
         title varchar(128),
         slug varchar(128),
         user_id varchar(128) NOT NULL,
         status varchar(128),
         front_status varchar(128),
         category varchar(128),
         img_url varchar(128),
         report_status varchar(128),
         rank varchar(128),
         contents text,
         likes text,
         time int(20),
         PRIMARY KEY (id)
      );";


      $sql15 = "CREATE TABLE views (
         id int(11) NOT NULL AUTO_INCREMENT,
         user_id varchar(128),
         user_type varchar(128),
         slug varchar(128),
         time varchar(128),
           PRIMARY KEY (id)
      );";



            $sql16 = "CREATE TABLE guests (
         id int(11) NOT NULL AUTO_INCREMENT,
               lastlog varchar(128),
               time varchar(128),
                 PRIMARY KEY (id)
            );";



         $sql17 = "CREATE TABLE countries (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(128),
        select_value varchar(128),
        language varchar(128),
        currency_code varchar(128),
        currency_name varchar(128),
        xchange_rate DECIMAL(19,4) NOT NULL,
        minimum_payout  DECIMAL(19,4) NOT NULL,    
        cost_per_live  DECIMAL(19,4) NOT NULL,
        minimum_no_live int(3),     
        live_required int(3),     
        flag_slug  varchar(128),
        next_quiz_start  varchar(128),
        quiz_end  varchar(128),
        next_voting_start  varchar(128),
        voting_end  varchar(128),
        country varchar(128),
        info_text text,
        time varchar(128),
          PRIMARY KEY (id)
);";



 $sql18= "CREATE TABLE stages (
    id int(11) NOT NULL AUTO_INCREMENT,
    label varchar(128),
    stage_img varchar(128),
    country varchar(128),
    PRIMARY KEY (id)
);";

 $sql19 = "CREATE TABLE votes (
            id int(11) NOT NULL AUTO_INCREMENT,
            voter_id varchar(128) NOT NULL,
            tip_id varchar(128) NOT NULL,
            stage_id varchar(22),
            time int(20),
            PRIMARY KEY (id)
    );";

  $sql20 = "CREATE TABLE tips (
            id int(11) NOT NULL AUTO_INCREMENT,
            label varchar(128),
            stage_id varchar(22),
            time int(20),
            PRIMARY KEY (id)
    );";

$sql21 = "CREATE TABLE payments (
        id int(11) NOT NULL AUTO_INCREMENT,
        user_id varchar(128) NOT NULL,
        user_type varchar(128) NOT NULL,
        method varchar(128) NOT NULL,
        phone int,
        amount DECIMAL(19,4) NOT NULL,
        status varchar(128),
        particular varchar(128),
        payment_type varchar(128),
        time varchar(128),
        time_of_completion varchar(128),
        ldetails text,
        PRIMARY KEY (id)
);";

$sql22 = "CREATE TABLE quiz_session_holder (
            id int(11) NOT NULL AUTO_INCREMENT,
            stage int(2),
            user_id varchar(22),
            balance_live_used int(2),
            question_id varchar(22),
            status varchar(22),
            time int(20),
            stage_time_start varchar(22),
            country varchar(122),
            PRIMARY KEY (id)
    );";
    //clear this for new quiz to start
    //status here have vallue:missed,won
    
    $sql23 = "CREATE TABLE withdrawal (
        id int(11) NOT NULL AUTO_INCREMENT,
        user_id varchar(128) NOT NULL,
        ref varchar(128) NOT NULL,
        method varchar(128) NOT NULL,
        phone int,
        amount DECIMAL(19,2) NOT NULL,
        status varchar(128),
        approval varchar(128),
        email varchar(128),
        time int(20),
        details text,
        PRIMARY KEY (id)
);";
 $arr = array($sql1,$sql2,$sql3,$sql4,$sql5,$sql6,$sql7,$sql8,$sql9,$sql10,
 $sql11,$sql12,$sql13,$sql14,$sql15,$sql16,$sql17,$sql18,$sql19,$sql20,$sql21,$sql22,$sql23);

 foreach($arr as $value)
 {
  if ( $this->db->query($value))
  {

  echo "Tables sucessfully created<br>";

  }
  }
}


}
