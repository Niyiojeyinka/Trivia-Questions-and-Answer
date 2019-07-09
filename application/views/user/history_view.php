<div class='w3-container w3-center'>
	<br>
	<span class="w3-large w3-text-large">Account History</span><br>
<div class="">
	<?php

if(!empty($history))
{
foreach ($history as  $value) {

echo "<div class='w3-medium w3-serif'>".$value['details']." at ".date( "F j, Y, g:i a",(int)$value["time"])."</div><br>";
}


echo $pagination;
}else{

	echo "<div class='w3-small w3-serif w3-text-grey'>No History Available</div>";
}

?>

</div>


</div>