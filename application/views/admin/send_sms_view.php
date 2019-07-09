<div class="w3-container w3-twothird">

<b class="w3-center w3-text-grey w3-xlarge">Send SMS</b><br>
<div>
<?php

if(isset($_SESSION['action_status_report']))
{
	echo $_SESSION['action_status_report'];
}



echo form_open('admin/send_sms/'.$this->uri->segment(3));

?>	

<?php

if (!$hide_phone_box) {
?>
<br>
<span class="w3-label w3-large">Mobile Number:</span><br>
<input type="text" class="w3-padding w3-margin-top" name="phone" value="<?=isset($phone)?$phone:"" ?>" placeholder="Ex 090XXXXXXXXX" required/>


<?php
}
	
	?>

<br>
<span class="w3-label w3-large">SMS Sender:</span><br>
<input type="text" class="w3-padding w3-margin-top" name="sender_name" value="<?= set_value('sender_name') ?>" placeholder="Sender Name" required/>


<br><br>
<textarea 
cols="20" 
rows="15" 
class="w3-border w3-margin-top" name="message">Your SMS here</textarea>
<br>

<br><input type="submit" name="submit" class="w3-btn w3-blue" value="Send"/>
</form>

<br>
</div>


</div>


</div>