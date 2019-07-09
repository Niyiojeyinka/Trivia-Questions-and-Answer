<div class="w3-center">
    <br>
<span class="w3-text-theme w3-large w3-margin">Notifications</span><br>
<div class="">
<?php
if(!empty($notifications))
{
foreach ($notifications as $not) {
  $design = 'w3-margin w3-small';
  if($not['status'] == 'unread')
  {
    $design = 'w3-light-grey w3-padding w3-margin w3-round w3-small';
  }

  switch ($not['type']) {
    case 'new_user':

echo "<div class='".$design."'>".$not['contents']."<br><span class='w3-right w3-tiny'>".date('F j, Y,g:i a',(int)$not['time'])."</span></div>";
      break;
    case 'bold_receive':
echo "<div class='".$design."'>".$not['contents']."<br><span class='w3-right w3-tiny'>".date('F j, Y,g:i a',$not['time'])."</span></div>";
      break;
       case 'board_post_like':
echo "<a href='".site_url('board/topic/'.$not['slug'])."'><div class='".$design."'>".$not['contents']."<br><span class='w3-right w3-tiny'>".date('F j, Y,g:i a',$not['time'])."</span></div></a>";
      break;
 case 'board_reply_like':
echo "<a href='".site_url('board/view_comment_like/'.$not['slug']."/".$not['ref_id'])."'><div class='".$design."'>".$not['contents']."<br><span class='w3-right w3-tiny'>".date('F j, Y,g:i a',$not['time'])."</span></div></a>";
      break;
  case 'board_post_reply':
echo "<a href='".site_url('board/topic/'.$not['slug'])."'><div class='".$design."'>".$not['contents']."<br><span class='w3-right w3-tiny'>".date('F j, Y,g:i a',$not['time'])."</span></div></a>";
      break;
  
  }
  echo "<hr>";
}
}else{

  echo "<br>No Notifications yet";
}
echo "<br>".$pagination;
?>
</div>
</div>
