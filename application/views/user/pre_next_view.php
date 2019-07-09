<div class="w3-container w3-center"> 


	<div class="w3-xlarge w3-text-theme w3-serif w3-margin"> Live Quiz</div>

<div class="w3-center"><span class="">Bold Balance:</span>
 <?php
echo $user_details['balance_live'];

  echo ' <i class="fa fa-heart w3-text-red w3-large"></i>';

?>
</div>
<br>
<span class="w3-large w3-text-theme w3-serif"><b>Stage <?=$_SESSION['stage'] ?></b></span><br>
	<div class="w3-container">
	
	<div class="w3-light-grey w3-round">
  <div class="w3-container w3-round w3-theme" style="width:<?=($_SESSION['stage']/$no_of_stages)*100 ?>%"><?=(int)(($_SESSION['stage']/$no_of_stages)*100 )?>%</div>
</div>
</div>
<br>



  <div class="w3-serif w3-text-gray">

 Quiz Elapse Time : <?=date('F j, Y,g :i a',$quiz_end) ?>
  </div>
  <div class="w3-container">
  	<i class="w3-jumbo w3-text-theme fa fa-check-circle-o w3-padding-jumbo"></i>
  	<div class="w3-small">Congratulations, You Qualify for the next Stage<br>
<a href="<?=site_url('question/index') ?>" class='w3-btn w3-theme w3-margin w3-round-large'>Next Stage</a>
  	</div>
  </div>
</div>