<div class="w3-twothird">


<div class="w3-center">
<b class="w3-xlarge w3-text-blue-grey">Edit Question:</b><br>
 <?php
echo form_open_multipart('/admin_question/edit_question/'.$this->uri->segment(3));
?>

<span class="w3-text-red"><?php
echo validation_errors(); ?>
</span>
<?php

if(isset($_SESSION['action_status_report']))
{

  echo $_SESSION['action_status_report'];

}

echo "<BR>";
?>
<br>
<div class='w3-row'>
  <div class='w3-third'>
<span class="w3-label">Question Image</span><br>
  <input type="file" class="w3-border-blue-grey"  name="question_img" ></input>


</div>

<div class='w3-third'>
<!--free space-->

<br><br>
</div>

<div class='w3-third'>
  <!--free space-->
<span class="w3-label">Stage</span><br>
<select class="w3-padding" name='stage'>
<?php
for ($i=1; $i <= $no_stage ; $i++) { 
if($question['stage'] == $i)
{
echo "<option value='".$i."' selected>Stage ".$i."</option>";
}else{
echo "<option value='".$i."'>Stage ".$i."</option>";



}

}

?>
</select>

</div>

  </div>

  <br>
  <div class='w3-row'>
    <div class='w3-third'>

<span class="w3-label">Fifty Answer</span><br>
    <select  class="w3-padding" name="fifty_answer">
      <?php
switch ($question['fifty_answer']) {
  case 'a':
$fan1 = 'selected';
    break;
     case 'b':
$fan2 = 'selected';
    break;
     case 'c':
$fan3 = 'selected';
    break;
     case 'd':
$fan4 = 'selected';
    break;
 case 'e':
$fan5 = 'selected';
    break;
}


echo  '<option value="a" '.$fan1.'>A</option>';
echo  '<option value="b" '.$fan2.'>B</option>';
echo  '<option value="c" '.$fan3.'>C</option>';
echo  '<option value="d" '.$fan4.'>D</option>';
echo  '<option value="e" '.$fan5.'>E</option>';


 ?>


    </select>
    </div>

  <br><br>
  </div>

  <div class='w3-third'>
  <span class="w3-label w3-padding">Question  Type</span><br>
  <select class="w3-padding" name="question_type">
    <?php
    if($question["question_type"] == 'image')
 {
 $qt1 = 'selected';

 }else{

 $qt2 = 'selected';

 }
 echo  '<option value="text" '.$qt2.'>Text</option>';
 echo ' <option value="image"'.$qt1.'>Image</option>';


 ?>


  </select>
  </div>

  <div class='w3-third'>
  <!-- -->
      <span class="w3-label">Time Allowed (secs)</span><br>

  <input type="number" min="1" name="time_allowed" class="w3-padding" value="<?=$question['time_allowed'] ?>">
  <br><br>
  </div>

    </div>
    <br>
    <div class='w3-row'>
      <div class='w3-third'>
    <span class="w3-label">Instructions</span><br>
    <input type="text" class="w3-border-blue-grey w3-padding" name="instructions" value="<?=$question['instructions'] ?>" placeholder="Instructions"></input>
    <br><br>
    </div>

    <div class='w3-third'>
    
<!--country input was-->
        </div>

    <div class='w3-third'>
    <span class="w3-label">Answer</span><br>
    <select  class="w3-padding" name="answer">
      <?php
switch ($question['answer']) {
  case 'a':
$an1 = 'selected';
    break;
     case 'b':
$an2 = 'selected';
    break;
     case 'c':
$an3 = 'selected';
    break;
     case 'd':
$an4 = 'selected';
    break;
 case 'e':
$an5 = 'selected';
    break;
}
echo  '<option value="a" '.$an1.'>A</option>';
echo  '<option value="b" '.$an2.'>B</option>';
echo  '<option value="c" '.$an3.'>C</option>';
echo  '<option value="d" '.$an4.'>D</option>';
echo  '<option value="e" '.$an5.'>E</option>';


 ?>


    </select>
    </div>

      </div>

      <br>
      <div class='w3-row'>
        <div class='w3-half'>
      <span class="w3-label">Status</span><br>
      <select class="w3-padding" name="status">
        <?php
if($question["status"] == 'published')
{
$s1 = 'selected';

}else{

  $s2 = 'selected';

}
  echo  '<option value="published" '.$s1.'>Published</option>';
  echo ' <option value="drafted"'.$s2.'>Drafted</option>';


     ?>


    </select>
      </div>

      <div class='w3-half'>
      <span class="w3-label">Option  Type</span><br>
       <select class="w3-padding" name="option_type">
         <?php
      if($question["option_type"] == 'image')
      {
      $op1 = 'selected';

      }else{

      $op2 = 'selected';

      }
      echo  '<option value="text" '.$op2.'>Text</option>';
      echo ' <option value="image"'.$op1.'>Image</option>';


      ?>

      </select>
      </div>

</div>
       <span class="w3-label">Question:</span><br>
      <textarea placeholder="Question" class="w3-center w3-border-blue-grey" name="question"    rows="10" cols="25"><?php  echo $question['question']; ?></textarea><br>

      <br>


      <br>
          <div class='w3-row'>
              <div class='w3-twothird'>
            <div class='w3-third'>
          <span class="w3-label">Option A</span><br>
          <input type="text" class="w3-border-blue-grey w3-padding"  name="option_a" value="<?php echo $question['option_a']; ?>" placeholder="Option A"></input>
          <br><br>
          </div>

          <div class='w3-third'>
          <span class="w3-label">Option B</span><br>
          <input type="text" class="w3-border-blue-grey w3-padding"  name="option_b" value="<?php echo $question['option_b']; ?>" placeholder="Option B"></input>
          <br><br>
          </div>

          <div class='w3-third'>
          <span class="w3-label">Option C</span><br>
          <input type="text" class="w3-border-blue-grey w3-padding" name="option_c" value="<?php echo $question['option_c'] ?>" placeholder="Option C"></input>
          <br><br>
          </div>
            </div>
<div class='w3-third'>
          <div class='w3-half'>
          <span class="w3-label">Option D</span><br>
          <input type="text" class="w3-border-blue-grey w3-padding"  name="option_d" value="<?php echo $question['option_d']; ?>" placeholder="Option D"></input>
          <br><br>
          </div>

          <div class='w3-half'>
          <span class="w3-label">Option E</span><br>
          <input type="text" class="w3-border-blue-grey w3-padding" name="option_e" value="<?php echo $question['option_e']; ?>" placeholder="Option E"></input>
          <br><br>
          </div>


      </div>
      <a class='w3-button w3-text-green' href='<?php echo site_url('media'); ?>'>Go To Media</a>
            </div>



<div id='compdiv'>
 <span class="w3-label">Comprehension:</span><br>
<textarea placeholder="Comprehension" class="w3-center w3-border-blue-grey" name="comp"  rows="20" cols="40"><?php  echo $question['comp']; ?></textarea><br>
</div>
<br>

<input type="submit" class="w3-btn w3-blue" value="Edit" name="submit"></input><br>

<BR>
</div>
