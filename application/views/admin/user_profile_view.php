<div class='w3-container w3-center w3-twothird'><br>
<br>
<div class="w3-text-red">
<?php
if(isset($_SESSION['action_status_report']))
{


	echo $_SESSION['action_status_report'];
}


echo " <a class='w3-small w3-btn w3-green' href='".site_url('admin/login_to_user_account/'.$user['id'])."'>Login to User Account</a>";
 ?>
</div><span class='w3-large w3-text-blue-grey'>
<?php
echo  $user['firstname'].' '.$user['lastname'].' '.$user['username'] ;
?></span>
<br>
<div class='w3-container'>
<img class='w3-circle w3-image' width="167" height="" src='<?= base_url('assets/images/Profiles/'.$user['profile_img']) ?>'  />
</div><br>
<div class="w3-container">
<table class='w3-table w3-striped'>
<tr><td>Account Status</td><td>Active</td></tr>


<tr><td>Account Email</td><td>
<?= $user['email'] ?>
</td></tr>
</table>
	<table class="w3-table w3-striped w3-small">
	<tr>
<td>
Total Amount Withdrawn</td>


<td>
	<del><b>N</b></del><?= $user['earned_bal'] ?>
</td>

</tr>
<tr>
<td>
	Account Balance Now
</td>


<td>
	<del><b>N</b></del><?= $user['account_bal'] ?>
</td>

</tr>


	<tr>
<td>
	Pending Balance
</td>


<td>
	<del><b>N</b></del><?= $user['pending_bal'] ?>
</td>

</tr>


	</table>
<br><span class='w3-center w3-text-large w3-text-blue-grey'>Withdrawal Details</span>
<br>

	<table class="w3-table w3-striped w3-small">
	<tr>
<td>
Account Name</td>


<td>
	<?= $user['bank_det'] ?>
</td>

</tr>
<tr>
<td>
	Account Number
</td>


<td>
	<?= $user['bank_acct'] ?>
</td>

</tr>


	<tr>
<td>
	Bank Name
</td>


<td>
<?= $user['bank_name'] ?>
</td>
<tr>
<td>
	Bank No
</td>


<td>
<?= $user['bank_no'] ?>
</td>

</tr>

	<tr>
<td>
	Payment Type
</td>


<td>
<?= $user['payment_type'] ?>
</td>

</tr>
<!--<tr>
<td>
	Facebook link
</td>


<td>
<?= ""//$user['fb_link'] ?>
</td>

</tr>-->

	</table>

<br><br>
</div>

<div class="w3-container">
	<div class="w3-half">
	<br>	
<span class="w3-large w3-text-blue-grey">Credit Account</span><br>
<?php
echo form_open('admin/credit/'.$this->uri->segment(3));

?>
<input type="text" name="credit" class="w3-padding" placeholder="Amount" required/><br>
<input type="submit" name="submit" class="w3-btn w3-green" value="Credit"/>

</form>

	</div>
	

<div class="w3-half">
	<br>	
<span class="w3-large w3-text-blue-grey">Debit Account</span><br>
<?php
echo form_open('admin/debit/'.$this->uri->segment(3));


?>
<input type="text" name="debit" class="w3-padding" placeholder="Amount" required/><br>
<input type="submit" name="submit" class="w3-red w3-btn" value="Debit"/>

</form>


	</div>
	




</div>




<div class="w3-container w3-center w3-margin">
<a href="<?php echo site_url("admin/suspend/".$user['id']); ?>" class="w3-btn w3-red">
Suspend</a>
<a href="<?php echo site_url("admin/unsuspend/".$user['id']); ?>" class="w3-btn w3-green">
UnSuspend</a>



<a href="<?php echo site_url("admin/email/".$user['id']); ?>" class="w3-btn w3-blue">
Email</a>
</div>



<br>


</div>
