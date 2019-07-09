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
  	<div class="w3-center w3-margin-bottom"><img class='w3-image w3-round-jumbo'style='max-width: 100%;' src="<?php
echo base_url('assets/images/prypericon.png');
   ?>"/></div>
  	<div class="w3-small">Congratulations, You just won a medal.Your Account will be credit accordingly as soon as Possible.<br>
<a href="<?=site_url('dashboard') ?>" class='w3-btn w3-theme w3-margin w3-round-large'>Go To Home</a>
  	</div>
  </div>
</div>