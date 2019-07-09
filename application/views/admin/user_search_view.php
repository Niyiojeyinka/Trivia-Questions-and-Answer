<div class="w3-container w3-twothird w3-center">
<br>
	<span class="w3-center w3-text-blue-grey
	w3-large">Users Result</span>
	<br>
<div>
	

<div>
	


<?= form_open('admin/search_users') ?>

<input type="Search" name="search" placeholder="Search Users by Username" class="w3-padding w3-border" />

<input type="submit" name="submit" value="Search" class="w3-btn w3-blue"><br>

<select name="type" class="w3-padding">
	<option value="username">By Username</option>
	<option value="email">By Email</option>
	<option value="firstname">Firstname</option>
	<option value="Lastname">Lastname</option>
</select>
</form>


</div>
<br>


<?php

if (!empty($items))
{



foreach ($items as $item)
{



$color = "";

 
echo "<div class='w3-container w3-border w3-padding w3-margin'>";
 echo "<a ".$color." href='".site_url('admin/user_profile/'.$item['id'])."'>";
echo $item['firstname']." ".$item['lastname']." ".$item['username']."<br>";
echo "</a>";
echo "<span class='w3-small'>Last Seen:";
echo " ".date( "F j, Y, g:i a",$item["lastlog"]);
echo "</span><br>";
echo "<div class='w3-text-blue'> <a href='".site_url('admin/email/'.$item['id'])."'>Email</a>   <a class='w3-text-red' href='".site_url('admin/suspend/'.$item['id'])."'>Suspend User</a></div>";

echo "   <a class='w3-small w3-btn w3-green' href='".site_url('admin/login_to_user_account/'.$item['id'])."'>Login to User Account</a>";

echo "<a class='w3-small w3-btn w3-green' href='".site_url('admin/send_sms/'.$item['id'])."'>Send SMS</a>";
echo "</div>";
}



echo $pagination;

}else{
echo "No user entries";

}


?>



</div>


</div>
