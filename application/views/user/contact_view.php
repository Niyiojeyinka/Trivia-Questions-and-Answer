<center>

<div class="w3-container w3-card">
<br>
<span class="w3-text-theme w3-serif w3-xlarge">Contact Us</span>
<BR>
<span class="w3-small">Please note that you can also send us a message via our email ( <a class="w3-text-theme" href="mailto:support@pryper.com"> support@pryper.com</a> ) or via social media pages.</span>
<br>

<span class="w3-text-pink">
<?php if(isset($_SESSION['action_status_report']))
 {
  echo $_SESSION['action_status_report'];
 }
  ?>
<?php echo validation_errors(); ?></span>
<br>
 <?php echo form_open('page/contact_us'); ?>
<span class="w3-label">Name</span><br>
 <input type="text" class="w3-padding" name="name" value="<?php
if(isset($user_details))
{
	echo $user_details['firstname']." ".$user_details['lastname'];
	}else{
echo set_value("name"); 

	}
  ?>" <?php

if(isset($user_details))
{

  echo "readonly";
}else{
	echo " required";
}
?>/> <br>
<span class="w3-label">Email</span><br>
 <input type="email" class="w3-padding" name="email" value="<?php
if(isset($user_details))
{
	echo $user_details['email'];
	}else{
echo set_value("email"); 
		
	}
  ?>" <?php

if(isset($user_details))
{

  echo "readonly";
}else{
	echo " required";
}
?>/> <br>


<span class="w3-label">Message</span><br>
<textarea cols="25" rows="10" class="w3-padding" name="message"><?php echo set_value("message"); ?></textarea>
 <br>

 <b><input type="submit" class="w3-btn w3-border w3-theme" name="submit" value="Send"/></b>
  <br>
  <br>




</div>
</center>
