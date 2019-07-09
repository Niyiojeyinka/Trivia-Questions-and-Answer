<div class="w3-twothird">
<div class='w3-container'>


<?=form_open('admin/manage_tips') ?>



<span class="w3-text-red"><?php
echo validation_errors(); ?>
</span>
<?php
if (isset($_SESSION['action_status_report'])) {
	
echo $_SESSION['action_status_report'];
	}

?>
<span class="w3-label w3-margin">Stage</span><br>
<select name="stage" class="w3-padding w3-margin">
	<?php 

	for ($i=1; $i <= $no_stage ; $i++) { 

echo "<option value='".$i."'>Stage ".$i."</option>";


}

	 ?>

</select>
<br>


<span class="w3-label w3-margin">Tips</span><br>
<input type="text" class="w3-padding" name="tip" placeholder="Tips Here"/>

<br>
<input type="submit" name="submit" class="w3-btn w3-blue w3-margin" value="Add Tip"/>
</form>

<hr>
<br>
<span class="w3-large w3-text-blue-gray">View Stage tips</span>
<br>
<?=form_open('admin/open_stage_tips') ?>


<span class="w3-label w3-margin">Stage</span><br>
<select name="stage" class="w3-padding w3-margin">
	<?php 

	for ($i=1; $i <= $no_stage ; $i++) { 

echo "<option value='".$i."'>Stage ".$i."</option>";


}

	 ?>

</select>
<input type="submit" name="submit" class="w3-btn w3-blue w3-margin" value="Go"/>

</form>
</div>
</div>