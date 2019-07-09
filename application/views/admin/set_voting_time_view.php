<div class="w3-twothird w3-center">
	<span class="w3-serif w3-text-xlarge w3-text-indigo">
		SET VOTING TIME & DATE
	</span>
	<?php
	echo validation_errors();

if(isset($_SESSION['action_status_report']))
{
	echo $_SESSION['action_status_report'];
}

	?>
  
<?= form_open('admin/set_voting_time') ?>


 <span class="w3-label">Country</span><br>

<!--List of african countries-->
<select type="text" class="w3-padding" name="country" id="african-countries"> 
  <?php

require('application/views/common/countrylist.php');


  ?>
  </select>
<br>  


<span>Day  Month Year</span><br>
<select class="w3-padding" name='day'>

<?php
for ($i=1; $i <32 ; $i++) { 
echo "<option value'".$i."'>".$i."</option>";
}
?>
</select>


<select class="w3-padding" name='month'>
<option value="1">JANUARY</option>
<option value="2">FEBRUARY</option>
<option value="3">MARCH</option>
<option value="4">APRIL</option>
<option value="5">MAY</option>
<option value="6">JUNE</option>
<option value="7">JULY</option>
<option value="8">AUGUST</option>
<option value="9">SEPTEMBER</option>
<option value="10">OCTOBER</option>
<option value="11">NOVEMBER</option>
<option value="12">DECEMBER</option>
</select>

<select class="w3-padding" name='year'>

<?php
for ($i=2019; $i <= 2099 ; $i++) { 
echo "<option value='".$i."'>".$i."</option>";
}
?>
</select>
<br>
<span class="w3-text-indigo w3-serif">Game Start Time</span><br>
<input class="w3-padding" type="time" name="stime"/><br>

<br>
<span class="w3-text-indigo w3-serif">Game Duration</span><br>
<select class="w3-padding" name='duration'>

<?php
for ($i=5; $i < 1440 ; $i = $i+5) { 
	if($i < 60)
	{
echo "<option value='".$i."'>".$i." Minutes</option>";
	}
}

for ($i=1; $i <= 48 ; $i++) { 
	if($i < 60)
	{
echo "<option value='".($i*60)."'>".$i." Hours</option>";
	}
}
?>
</select>
<br>

<input type="submit" name="submit" class="w3-btn w3-indigo w3-margin w3-round" value="Set Time"/>

</form>
<div class="w3-container w3-padding">
	Current Start Time : <?= date('F,j Y,g:i a',$vote_start) ?><br>
		Current End Time : <?= date('F,j Y,g:i a',$vote_end) ?>

</div>



  </div>