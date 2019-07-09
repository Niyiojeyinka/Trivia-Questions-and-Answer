<div class="w3-container w3-center"> 


	<div class="w3-xlarge w3-text-theme w3-serif w3-margin">Live Quiz</div>

<div class="w3-center"><span class="">Bold Balance:</span>
 <?php
echo $user_details['balance_live'];

  echo ' <i class="fa fa-heart w3-text-red w3-large"></i>';

?>
</div>
<br>
<div>
  You Dont have Enough live balance Please buy more bold live <a href="<?=site_url('dashboard/payment') ?>" class='w3-button w3-text-theme w3-white'>Here</a> 
</div>
<br>



  <div class="w3-serif w3-text-gray">
 Quiz Start By : <?=date('F j, Y,g :i a',$quiz_start) ?>

 Quiz End In : <?=date('F j, Y,g :i a',$quiz_end) ?>
  </div>
  <div class="w3-container">
  	<i class="w3-jumbo w3-text-red fa fa-info w3-padding-jumbo"></i>
  	<div class="w3-small">Oops, Insufficient Live Balance<br>
<a href="<?=site_url('dashboard') ?>" class='w3-btn w3-theme w3-margin w3-round-large'>Go To Home</a>
  	</div>
  </div>
</div>