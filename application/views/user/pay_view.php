
<div class="w3-container"><div class='w3-container w3-center'>
<b>Payment options</b>

<li class='w3-text-theme'>Pay Online</li>
<form class='w3-center' method='POST' action='<?php echo site_url('Dashboard/payment'); ?>'>


        <?php
        echo '<div class="w3-text-red">'.validation_errors().'</div>';

        if(isset($_SESSION['err_msg']))
        {

          echo '<div class="w3-text-red">'.$_SESSION["err_msg"].'</div>';
          unset($_SESSION["err_msg"]);
        }
        ?>


<div class='w3-row'>
    <i  style='margin-right:3%' class="fa fa-heart
     w3-large w3-text-theme w3-center w3-margin"></i>

<select onchange="calculate(this.value)" class="w3-padding w3-border-theme w3-round" name="no_lives">
  <?php

  for ($i=$country['minimum_no_live']; $i <= 200; $i =$i+$country['minimum_no_live']) { 
?>

<option value="<?=$i ?>"><?= $i ?> Lives</option>
<?php
  }
  ?>
</select>
<div id="show_price" class="w3-large w3-margin-left">
  
<?=  $country['currency_code']?>  <?= (float)($country['cost_per_live'] * $country['minimum_no_live']) ?> 
</div>
<script type="text/javascript">
  
function calculate(no_lives){

  var one_price = <?= $country['cost_per_live'] ?>;
  var priceDiv = document.getElementById('show_price');
  priceDiv.innerHTML = " <?= $country['currency_code']?> "+ (no_lives * one_price);
  
}

</script>

   
</div>
<?php


$array_char = array('A','B','C','D');
$i = mt_rand(0,3);
$ref = 'ppr'.uniqid().$array_char[$i];



 ?>

 <input type="hidden" name="ref" value="<?= $ref ?>"/>

<div class="">

</div>
<input class='w3-center w3-button w3-theme w3-margin-top w3-margin-bottom'
 type='submit' name='submit' value='Pay Online'/>
</form>

</div>
<!--<div class='w3-container w3-center'>
<li class='w3-text-theme'>Pay With Airtime</li>
<form class='w3-center' method='POST' action='<?php echo
site_url('Dashboard/micro_payment'); ?>'>


        <?php
        echo '<div class="w3-text-red">'.validation_errors().'</div>';

        if(isset($_SESSION['err_msg']))
        {

          echo '<div class="w3-text-red">'.$_SESSION["err_msg"].'</div>';
          unset($_SESSION["err_msg"]);
        }
        ?>


<div class='w3-row'>
    <i  style='margin-right:3%' class="fa fa-mobile
     w3-large w3-text-theme w3-center w3-margin"></i>
     <input class='w3-center' type='number' min='150' name='amount'
      placeholder='Amount'/><span class="w3-text-indigo"><del>N</del</span>
</div>
<?php


$array_char = array('A','B','C','D');
$i = mt_rand(0,3);
$ref = 'HM'.uniqid().$array_char[$i];



 ?>

 <input type="hidden" name="ref" value="<?= $ref ?>"/>

<div class="">
<img class="w3-image" style="max-height:65px" src="<?= base_url('assets/images/9mobile_logo.jpg') ?>" />
<img class="w3-image" style="max-height:80px" src="<?= base_url('assets/images/mtn_logo.png') ?>" />
<img class="w3-image" style="max-height:60px" src="<?= base_url('assets/images/airtel_logo.png') ?>" />
<img class="w3-image" style="max-height:65px" src="<?= base_url('assets/images/glo_logo.png') ?>" />

</div>
<input class='w3-center w3-button w3-theme w3-margin-top w3-margin-bottom'
 type='submit' name='submit' value='Pay with Airtel'/>
</form>

</div>-->
</div>
