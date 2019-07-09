<div class="w3-twothird">
<div class='w3-container'>


<span class="w3-large w3-text-blue-gray">Stage <?=$this->input->post('stage')?> tips</span>
<br>
<?php
if (!empty($tips)) {
	

foreach ($tips as $tip) {
	echo "<div class='w3-margin'>";
	echo $tip['label'];
	echo "<a class='w3-button' href='".site_url('admin/delete_tip/'.$tip['id'])."'><span class='fa fa-trash w3-text-red w3-large w3-margin'></span></a>";
	echo "</div>";
}
}else{

	echo 'No tips Yet for this Stage';
}


?>
</div>
</div>