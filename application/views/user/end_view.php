<div class="w3-container w3-center"> 


	<div class="w3-xlarge w3-text-theme w3-serif w3-margin">Live Quiz</div>

<div class="w3-center"><span class="">Bold Balance:</span>
 <?php
echo $user_details['balance_live'];

  echo ' <i class="fa fa-heart w3-text-red w3-large"></i>';

?>
</div>
<br>
  <div class="w3-serif w3-text-gray">

 Quiz Elapse Time : <?=date('F j, Y,g :i a',$quiz_end) ?>
  </div>
  <div class="w3-container">
  	<i class="w3-jumbo w3-text-red fa fa-clock-o w3-padding-jumbo"></i>
  	<div class="w3-small">Oops,Game Ended<br>
<a href="<?=site_url('dashboard') ?>" class='w3-btn w3-theme w3-margin w3-round-large'>Go To Home</a>
  	</div>
  </div>
</div>