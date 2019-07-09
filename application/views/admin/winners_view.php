<div class="w3-container w3-twothird">
<span class="w3-large w3-text-blue-gray">Winners</span><br>
<span class="w3-small">No of Winners: <?=count($winners) ?></span>
<br>
<?php
if (!empty($winners)) {
foreach ($winners as $winner) {
//get the winner details by id

}


	# code...
}else{

	echo "No winner for this game";
}

?>

<br><div class="w3-padding w3-margin">
<?= form_open('admin/reward_winners') ?>
	 <span class="w3-label">Reward</span><br>

<input type="text" name="reward" class="w3-padding"/>
	<br> <span class="w3-label">Country</span><br>
<!--List of african countries-->
<select type="text" class="w3-padding" name="country" id="african-countries"> 
  <?php

require('application/views/common/countrylist.php');


  ?>
  </select>
<br> 
<input type="submit" class="w3-margin w3-btn w3-blue" name="submit" value="Reward"/>
</form>	</div>
</div>
