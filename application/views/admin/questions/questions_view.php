<div class="w3-container">

<div class="w3-center">
<b class="w3-xlarge w3-text-blue-grey">Add New Question:</b><br>
 
<?php

if(isset($_SESSION['action_status']))
{

  echo $_SESSION['action_status'];

}

echo "<BR>";
?>
<div class="w3-margin w3-padding">

	<?php
	if(!empty($items))
	{
foreach ($items as $item) {
	
echo "<div class='w3-margin'>";
echo "<span class='w3-margin'>";
echo 'Question '.$item['id'].' '.$item['country'];
echo " Stage ".$item['level'];
echo "</span>";
echo "<span>90% Got it Right(Functional in next Update)</span>";
echo "<a class='w3-text-red w3-margin' href='".site_url('admin_question/delete_question/'.$item['id'])."'><span class='fa fa-close w3-text-red'></span></a>";
echo "<a class='w3-margin' href='".site_url('admin_question/edit_question/'.$item['id'])."'><span class='fa fa-edit w3-text-blue'></span></a>";
if ($item['status'] == 'published') {

echo "<a class='w3-margin' href='".site_url('admin_question/perform_action/unpublish/'.$item['id'])."'><span class='fa fa-file w3-text-yellow'></span></a>";

}else{
	echo "<a class='w3-text-green w3-margin' href='".site_url('admin_question/perform_action/publish/'.$item['id'])."'><span class='fa fa-floppy-o'></span></a>";

}


echo "</div>";


}
echo $pagination;
}else{
	echo "No Question Available yet";
	
}?>

</div>
	
</div>