

<div class='w3-container  w3-card-4 w3-panel w3-leftbar w3-rightbar w3-border-teal' style="box-shadow: none;">
    <form class='w3-center' method='POST' action='<?php echo site_url('users/more_kyc'); ?>'>

 <div>

<h4 class='w3-text-theme'><b>Select Country</b></h4>
<span class="w3-small">Please Note that the country you select, determine your account currency</span>
<div class='w3-text-red'><?php echo validation_errors();
if(isset($_SESSION['err_msg']))
{

 echo $_SESSION['err_msg'];

}
 ?></div>


<div class='w3-row'>
    <i  style='margin-right:3%' class="fa fa-flag
     w3-large w3-text-theme w3-center"></i>
     



<!--List of african countries-->
<select type="text" class="w3-padding" name="country" id="african-countries"> 
  <?php

require('application/views/common/countrylist.php');


  ?>
  </select>
<br>



</div>
<div class="w3-margin">
  <span class="w3-label"><b>Referral Code</b>(if any)</span><br>
  <input type="text" name="referral_code" class="w3-padding" placeholder="Referral Code(if any)" />

</div>


<input class='w3-center w3-button w3-theme w3-margin-top w3-margin-bottom w3-round-jumbo' type='submit' name='submit' value='Register'/>



</div>
   </form>



   <center>
      <div class="w3-text- w3-small w3-margin-bottom w3-margin-bottom">Already have Account? <span class="w3-text-theme"><?php
   echo "<a href='";
   echo site_url('users/login');
   echo "'>Login Here</a>";

        ?></span></div>
   </center>
 </div>

