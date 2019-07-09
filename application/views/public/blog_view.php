<div class="w3-container w3-white">

<b class="w3-serif w3-xlarge"><?php
echo $item['title']; ?></b><br>
<i>Posted by <a class="w3-text-theme" href="<?php

echo site_url();
?>">Pryper

<?php

?></a> at <?php
echo date( "F j, Y, g:i a",$item['time']);
?></i>

<div class="w3-image w3-center">
<!--feature image-->
<?php

if (!empty($item['img_url']))
{
echo '<img src="'.site_url('assets/media/images/'.$item['img_url']).'" class="w3-image w3-center" style="width:40%;height:40%" alt="'.$item['title'].'" img></img>';
}
?>
</div><br>

<center style="margin-left:5%"><?php echo $item['text']; ?></center>
</div>
 