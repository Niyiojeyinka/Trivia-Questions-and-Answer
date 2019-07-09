<div class="w3-container"> 
<div class="w3-container w3-center"> 


	<div class="w3-xlarge w3-text-theme w3-serif w3-margin"> Live Quiz</div>
<div class="w3-center"><span class="">Bold Balance:</span>
 <?php
echo $user_details['balance_live'];

  echo ' <i class="fa fa-heart w3-text-red w3-large"></i>';

?>
</div>
<br>
<span class="w3-large w3-text-theme w3-serif"><b>Stage <?=$question['level'] ?></b></span><br>
	<div class="w3-container">
	
	<div class="w3-light-grey w3-round">
  <div class="w3-container w3-round w3-theme" style="width:<?=($question['level']/$no_of_stages)*100 ?>%"><?=(int)(($question['level']/$no_of_stages)*100) ?>%</div>
</div>
</div>
<br>



  <div class="w3-serif w3-text-gray">

 Quiz Elapse Time : <?=date('F j, Y,g :i a',$quiz_end) ?>
  </div>




    <script>

    var t = setInterval(theTimer, 1000);

  function theTimer() {
    
    d = new Date();
    var date = d.getTime(); d = d/1000; d = new Number(d);
    d = d.toFixed();

   //console.log(getLiveTime);

  var e = <?php echo $question_start + $question['time_allowed']; ?>;

  if(e > d)
  {
    var diff = e - d;
         var min = Math.floor(diff/60);
          var sec = (diff % 60);
          var tim = min+'min :'+sec+'  secs ';
      document.getElementById("time_div").innerHTML = tim;
      //rowcontainers.insertAdjacentHTML('beforeend',newrow);

  }else if (e <= d) {

    //submit
    //document.getElementById("q_div").style.display = "none";
  //window.location.assign('<?php echo site_url('question/submit'); ?>');
  }


  }
  </script>
<br>




  <div class="w3-tag w3-round w3-theme" style="padding:3px">
  <div class="w3-tag w3-round w3-theme w3-border w3-border-white">
    You have <span id='time_div'>

  </span> for this Question
  </div>
</div>
    <br><br>
<?=form_open('question/submit_question')?>

<div class="w3-left w3-container" style="text-align: justify;">


<div style="width:90%" class='w3-container w3-small '>

<?php echo  $question['comp']; ?>

</div>
<div class="w3-margin">
  <?php
if (isset($_SESSION['action_status_report'])) {
  
echo $_SESSION['action_status_report'];

  }

  ?>
</div>
<!--

<div class="w3-large w3-serif">
<?php echo  $question['question']; ?></div>
<br>
-->

<div>
  <?php
if ($question['question_type'] =='text') {
 ?>

 <!-- although this is image its regard as text from db its converted to image in the helper class--->
  <img class="w3-image" src="<?= site_url('question/get_quiz_text_image') ?>" />
 <?php
}else{
  ?>
  <!-- question type is image--->
  <img class="w3-image" src="<?= base_url('assets/questions/'.$question['question_img']) ?>" />
  <?php
}


  ?>
 
</div>


<br>
<div  class="<?php 

if(isset($_SESSION['options_to_leave']))
{
  if($_SESSION['options_to_leave'][0] == 'a' ||$_SESSION['options_to_leave'][1] == 'a' )
  {
        echo '';

  }else{
        echo 'w3-hide';

  }
}

 ?>"><span class="w3-large">A </span>
<input type="radio" name="option"  value="a" class="w3-radio w3-small" />
<?php echo  $question['option_a']; ?> <?php 

if(isset($_SESSION['hint_answer']) && $_SESSION['hint_answer'] == 'a' )
{
  
        echo '<span class="fa fa-check w3-text-green w3-large"></span>';

  
}

 ?></div>

<div class="<?php 

if(isset($_SESSION['options_to_leave']))
{
  if($_SESSION['options_to_leave'][0] == 'b' ||$_SESSION['options_to_leave'][1] == 'b' )
  {
        echo '';

  }else{
        echo 'w3-hide';

  }
}

 ?>"><span class="w3-large">B </span>
<input type="radio" name="option" value="b" class="w3-radio w3-small" />
<?php echo  $question['option_b']; ?> <?php 

if(isset($_SESSION['hint_answer']) && $_SESSION['hint_answer'] == 'b' )
{
  
        echo '<span class="fa fa-check w3-text-green w3-large"></span>';

  
}

 ?> </div>

<div class="<?php 

if(isset($_SESSION['options_to_leave']))
{
  if($_SESSION['options_to_leave'][0] == 'c' ||$_SESSION['options_to_leave'][1] == 'c' )
  {
        echo '';

  }else{
        echo 'w3-hide';

  }
}

 ?>"><span class="w3-large">C </span>
<input type="radio" name="option" value="c" class="w3-radio w3-small" />
<?php echo  $question['option_c']; ?> <?php 

if(isset($_SESSION['hint_answer']) && $_SESSION['hint_answer'] == 'c' )
{
  
        echo '<span class="fa fa-check w3-text-green w3-large"></span>';

  
}

 ?></div>

<div class="<?php 

if(isset($_SESSION['options_to_leave']))
{
  if($_SESSION['options_to_leave'][0] == 'd' ||$_SESSION['options_to_leave'][1] == 'd' )
  {
        echo '';

  }else{
        echo 'w3-hide';

  }
}

 ?>"><span class="w3-large">D</span>
<input type="radio" name="option" value="d" class="w3-radio w3-small" />
<?php echo  $question['option_d']; ?> <?php 

if(isset($_SESSION['hint_answer']) && $_SESSION['hint_answer'] == 'd' )
{
  
        echo '<span class="fa fa-check w3-text-green w3-large"></span>';

  
}

 ?></div>

<div class="<?php 

if(isset($_SESSION['options_to_leave']))
{
  if($_SESSION['options_to_leave'][0] == 'e' || $_SESSION['options_to_leave'][1] == 'e' )
  {
        echo '';

  }else{
        echo 'w3-hide';

  }
}

 ?>">
<?php
if($question["option_e"] != NULL)
{

  echo '<span class="w3-large">E </span>';
echo '<input type="radio" name="option" value="e" class="w3-radio w3-small"/> ';
 echo  $question['option_e'];

} ?> <?php 

if(isset($_SESSION['hint_answer']) && $_SESSION['hint_answer'] == 'e' )
{
  
        echo '<span class="fa fa-check w3-text-green w3-large"></span>';

  
}

 ?>
</div>

</div>

</div>
<br>
<div>
<!--<input type="button" name="fifty" class="w3-btn w3-theme w3-margin w3-circle" value="50 -50"/>-->
<button name="fifty" class="w3-btn w3-theme w3-margin w3-circle">50-50</button>
<button name="hint" class="w3-btn w3-theme w3-margin w3-circle">Hint</button>
<button name="change" class="w3-btn w3-theme w3-margin w3-circle"><i class="fa fa-refresh"></i></button></div>
<br>
<input type="submit" name="submit" class="w3-btn w3-theme w3-round w3-margin" value="Submit"/><br>
</form>


<!--redirect if game end -->
<div id="useredirect"></div>

<script type="text/javascript">
   
function myEndRedirector() {
  
    $("#useredirect").load("<?= site_url('question/ajax_check_game_question_end') ?>", function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success")
        {

        if(responseTxt == 'end')
        {
           window.location.assign("<?=site_url('question/end') ?>");

              
        }else if(responseTxt =='timeout')
         {
               window.location.assign("<?=site_url('question/timeout') ?>");
         }else{
          console.log('unexpected');
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
</div>
