<div class="w3-center">
<br>
  <span class="w3-text-theme w3-large w3-margin-top"><?php echo ucfirst($slug); ?></span><br>
<div class="">
<?php
if(!empty($categories))
{

  foreach ($categories as  $value) {

  echo '<hr><a class="" href="'.site_url('board/topic/'.$value['slug']).'">';
  echo  '<div class="w3-container">';
    echo  '<h6 class="w3-text-theme">'.ucfirst($value['title']).'</h6>';
    echo  '<p class="w3-tiny">'.get_blog_excerpt($value['contents'],42).'...</p>';
  $user= $this->users_model->get_user_by_its_id($value['user_id']);
  if (is_numeric($value['user_id'])) {
//then its user's post else admin
echo "<span class='w3-tiny'>by ".$user['firstname']." ".$user['lastname']." at ".date( "F j, Y, g:i a",$value["time"])
  ;

  }else{
    echo "<span class='w3-tiny'>by <span class='w3-text-theme'><b>Admin</b></span> at ".date( "F j, Y, g:i a",$value["time"])
  ;
  }
  


  echo '</div></a>
  <hr>';
  }

echo $pagination;
}else{
   echo "Sorry,this category is empty!";
}


 ?>
</div>
</div>
<!--crazy thing here, have to deploy this project as fast as possible no time-->


</div>
</div></div>
</div></div>
</div>