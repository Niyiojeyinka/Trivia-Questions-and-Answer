 <script type="text/javascript">
    var t = setInterval(function (){
var current_time = new Date().getTime();
var current_time = Math.floor(current_time/1000);
var countdown = <?= $quiz_start ?>;
var margin = countdown-current_time;
    var  mo =Math.floor(margin/(60*60*24*31));
    var d = Math.floor((margin % (60*60*24*31))/(60*60*24));
    var h = Math.floor(((margin % (60*60*24*31))%(60*60*24))/(60*60));
    
    var m = Math.floor((((margin % (60*60*24*31))%(60*60*24))%(60*60))/(60));
    
  var s =  Math.floor((((margin % (60*60*24*31))%(60*60*24))%(60*60))%(60));


document.getElementById('time_div').innerHTML =mo+'<span style="font-size:8px">months</span> '+d+'<span style="font-size:8px">days</span> '+h+'<span style="font-size:8px">hours</span> '+m+'<span style="font-size:8px">minutes</span> '+s+'<span style="font-size:8px">seconds</span> ';

    }, 1000);


  </script>
  <div class="w3-container w3-padding w3-center <?php
if (!$no_unread_notifications > 0) {
echo "w3-hide";
}

  ?>">
   <br><a class="w3-margin-top" href="<?= site_url('dashboard/notifications') ?>">Notification <span class="w3-text-red">(<?=$no_unread_notifications?>)</span></a>
  </div>
<hr>
<div class="w3-center"><br><br><span class="w3-padding-top">Bold Balance:</span>
 <?php
echo $user_details['balance_live'];

  echo ' <i class="fa fa-heart w3-text-red"></i>';

?>
</div>
<br>
<div class="w3-container w3-center">
 

<hr>
<hr> 
<div class="w3-card-8">
  <div class="w3-padding-large w3-blue w3-center">Next Quiz Notice</div>
  <div class="w3-padding-large"><?=$info_text ?></div>
</div>
<hr>
<hr>

<a href="<?=site_url('dashboard/pre_tip_vote')?>">
<div>
  <i class="fa fa-cube w3-text-theme w3-jumbo"></i><br>
  <span class=''>Vote Topic</span>

</div>
<hr>
<hr>
<?php

if(time() < $quiz_start )
 {
  ?>
Next Quiz Start  by<br>

<?= date("F, j Y, g:ia",$quiz_start) ?>

<br>

<div class="w3-small" id="time_div">
  
</div>
<?php
}else{
?>
<a href="<?=site_url('question')?>">

<div>
  <i class="fa fa-play w3-text-theme w3-jumbo"></i><br>
  <span class=''>Start Live Quiz</span>

</div></a>

<?php  
}

?>
<span class="w3-small w3-text-theme">Minimum Live Required <span class="w3-large  w3-text-green"><?=$live_required ?></span></span>

<hr>
<hr><div class="w3-container w3-center  w3-margin-top">
<span class="w3-text-theme w3-small">Trending In The Forum</span><br>
<div class="w3-container w3-center  w3-margin-top">


  <?php
  if(!empty($items))
  {
  foreach ($items as  $value) {

  echo '<hr><a class="" href="'.site_url('board/topic/'.$value['slug']).'">';
  echo  '<div class="w3-container">';
    echo  '<h6 class="w3-text-theme">'.ucfirst($value['title']).'</h6>';
    echo  '<p class="w3-tiny">'.strip_tags(get_blog_excerpt($value['contents'],60)).'...</p>';
  $user= $this->users_model->get_user_by_its_id($value['user_id']);
  if (is_numeric($value['user_id'])) {
//then its user's post else admin
echo "<span class='w3-tiny'>by ".$user['firstname']." ".$user['lastname']." at ".date( "F j, Y, g:i a",$value["time"])
  ;

  }else{
    echo "<span class='w3-tiny'>by <span class='w3-text-theme'><b>Admin</b></span> at ".date( "F j, Y, g:i a",$value["time"])
  ;
  }
  


  echo '</div></a>
  <hr>';
  }

  echo $pagination;
  }else{
     echo "<span class='w3-small w3-serif'>Sorry,Front Page is empty,Please check others Category!</span>";
  }


   ?>



</div></div><hr>
<hr>
<a href="<?=site_url('board')?>">

<div>
  <i class="fa fa-users w3-text-theme w3-jumbo"></i><br>
  <span class=''>Forum</span>

</div></a><hr>




</div>
<div id="useredirect"></div>

<script type="text/javascript">
   
function myEndRedirector() {
  
    $("#useredirect").load("<?= site_url('dashboard/ajax_check_if_game_start') ?>", function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success")
        {

        if(responseTxt == 'start')
        {
           window.location.assign("<?=site_url('question') ?>");

              
        }
    }
    /* if(statusTxt == "error")
        {
            alert("Network Error: " + xhr.status + ": " + xhr.statusText);
        }*/
    });
}


var myVar = setInterval(myEndRedirector, 1000);

</script>