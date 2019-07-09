<div class="w3-container w3-twothird w3-center"><br>
<span class="w3-text-blue-grey w3-xlarge">
Withdrawal Requests
<?php
if ($withdrawal_switch == "false")
{
echo "<span class='w3-large w3-text-red'>OFF</span>";

}else{

echo "<span class='w3-large w3-text-green'>ON</span>";



}





?>


</span><br>

<?php
if(isset($_SESSION['action_status_report']))
{

	echo $_SESSION['action_status_report'];
}


?>
<form method="POST" action="<?=site_url('admin/control_withdrawal') ?>">
	<select name="control" class="w3-padding">
	<option value="true">Enable Withdrawal Request</option>	
	<option value="false">Disable Withdrawal Request</option>
	</select><br>
	<span class="w3-label">Information To Show Those Above #5000</span><br>
	<span class="w3-tiny w3-green">if you are disabling withdrawal</span><br>
<textarea name="info"><?=$withdrawal_info ?> </textarea><br>
<input type="submit" class="w3-btn w3-blue" name="submit" value="Submit">
</form>




</form>

<div class="w3-container">
	<?php
if(!empty($items))
{
foreach ($items as $item) {
$user_details  = $this->users_model->get_user_by_its_id($item['user_id']);


$wlink = site_url('admin/process_withdrawal/'.$item['id']).'/'.$user_details['id'];
$p_button = "<a class='w3-btn w3-blue w3-margin' href='".$wlink."'>Process</a>";
echo "<div class='w3-border w3-border-black'>";
echo $user_details['firstname']." ".$user_details['lastname']."(".$user_details['username'].") <br> <span class='w3-small'>Amount:<del>N</del>".$item['amount']."</span>$p_button<br>";
echo "<div class='w3-small w3-serif'> Bank Name:".$user_details['bank_name'];
echo "<br>";
echo "Account Number:".$user_details['bank_acct'];
echo "<br>";
echo " Account Name:".$user_details['bank_det'];
echo "<br>";
echo "<a class='w3-btn w3-pale-blue w3-margin' href='".site_url("admin/view_users_referred/".$user_details['username'])."'>View User Referred</a>";

echo "</div>";



}

echo $pagination;

}else{

echo "No Withdrawal Requests";



}
	




?>




<br><br>
</div>







</div>
