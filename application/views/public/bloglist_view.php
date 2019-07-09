<br>

<div class="w3-padding w3-padding-top w3-row w3-center">
<span class='w3-text-theme w3-xlarge w3-serif'>
<b>Our Blog</b></span><br>

<?php

if (!empty($items))
{
foreach ($items as $item)
{

echo "<div>";
echo "<span class='w3-tag w3-theme w3-margin-top'>".str_replace('_', ' ', strtoupper($item['category']))."</span>";
echo "<div class='w3-text- w3-padding-large'><a href='".site_url("/blog/".$item['slug'])."'>".$item['title']."</b></a></div>";
echo "<span class=''>By <span class='w3-text-blue-grey'>".ucfirst($item['author'])."Custch</span> On ".date( "F j, Y, g:i a",$item['time'])."</span>";
echo  "<hr></div>";
    }}else{
echo "No blog entries";

}

?>
<center><?php echo $pagination; ?></center><br>



</div>

