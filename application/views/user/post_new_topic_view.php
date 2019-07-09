
<div class="w3-container w3-center"><br>
<span class="w3-text-theme">Post New Topic</span><br><br>
<div class="">
<?php echo form_open_multipart("board/post_new_topic");?>
  <span class="w3-text-red"><?php echo validation_errors(); ?></span><br>
  <span class="w3-text-red"><?php
  if(isset($_SESSION['err_report']))
  {
    echo  $_SESSION['err_report'];


  }
  if(isset($upload_err))
  {

    echo $upload_err;

  }

  ?></span><br>

<input type="text" name="title" value="<?php  echo set_value('title'); ?>" placeholder="Title" class="w3-border w3-border-theme w3-round w3-padding" size="10"/>
<br>
<span class="w3-text-theme">Category</span><br>
<select name="category" class="">

<?php

foreach ($categories as $key => $value) {
if ($value == "Admin") {
  continue;
}
 echo '<option value="'.$value.'">'.$value.'</option>';

}


 ?>
</select>
<br>
<br>
<center>
<span class="w3-text-theme">Contents</span><br>


<script type="text/javascript" src="<?= base_url('assets/js/nicEdit.js') ?>"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
  
  new nicEditor({iconsPath : '/nicEditorIcons.gif'}).panelInstance('contents');
  
});
</script>



<textarea  class="w3-center
w3-border-blue-grey w3-round-xlarge" id="contents" name="contents"    rows="12" cols="20">
<?php  echo set_value('contents'); ?></textarea><br><br>
<span class="w3-text-theme">Feature Image</span><br>

<input type="file" name="topic_image" /><br><br>
<input type="submit" class="w3-btn w3-theme w3-round-jumbo" value="Post Now" name="submit"></input><br>


  <br>
</center>
</form>

</div>
</div>
</div>