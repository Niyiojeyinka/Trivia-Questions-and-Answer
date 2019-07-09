<div class='w3-container w3-center'>
  <hr>
  <div class='w3-container w3-card'>

<div class="w3-text-theme w3-large w3-margin">Account Balance</div>
           
         <p><i class="fa fa-credit-card fa-fw w3-margin-right w3-text-theme"></i> Total Amount Withdrawn: <i><?=  $country['currency_code']?> <?= $user_details['earned_bal'] ?></i></p>
         <p><i class="fa fa-money fa-fw w3-margin-right w3-text-theme"></i>  Account Balance Now : <i><?=  $country['currency_code']?> <?= $user_details['account_bal'] ?></i></p>
         <p><i class="fa fa-get-pocket w3-text-theme fa-fw w3-margin-right w3-text-theme"></i> Pending Bal: <i><?=  $country['currency_code']?> <?= $user_details['pending_bal'] ?></i></p>
       
<br>
<div class="w3-container w3-margin">

<div class="w3-center w3-margin"><span class="">Bold Balance:</span><br>
<br>
	 <?php
echo $user_details['balance_live'];

  echo ' <i class="fa fa-heart w3-text-red"></i>';

?>
  
  
</div>

</div>
<div id='transfer'>
<hr>
<span class="w3-text-theme w3-large">Transfer</span><br>
<i class="w3-small">You can send live<i class="fa fa-heart w3-text-red"></i> to family and friends here</i><br>

<?= form_open('dashboard/send_live') ?>
<?php
if(isset($_SESSION['action_status_report']))
{
	echo $_SESSION['action_status_report'];
	echo "<br>";
}


?>
<input min="<?=$country['minimum_no_live'] ?>" type="number" name="quantity" class="w3-padding" placeholder="Quantity" /><br>
<input type="email" name="email" class="w3-padding" placeholder="Receiver Email Address" /><br>
<input type="submit" name="submit" value="Send Now" class="w3-button w3-theme w3-round-large w3-margin"/><br>
</hr></div>

  </div></div>