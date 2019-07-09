
<nav class="w3-sidebar w3-bar-block w3-card" id="mySidebar">
<div class="w3-container w3-theme-d2">
  <span onclick="closeSidebar()" class="w3-button w3-display-topright w3-large">X</span>
  <br>
  <div class="w3-padding w3-center">
  <a href="<?php
  echo site_url('dashboard/profile');
  ?>"> <div class="w3-center w3-margin-bottom"><img class='w3-image w3-round-jumbo'style='max-width: 100%;' src="<?php
if(!empty($user_details['profile_img']))
{
  echo base_url('assets/images/profiles/'.$user_details['profile_img']);
}else{
  echo base_url('assets/images/prypericon.png');
}

   ?>"/></div>
</a>  </div>
</div>
<a class="w3-bar-item w3-button w3-border" href="<?php
echo site_url('Dashboard');
?>">  <i  style='margin-right:3%' class="fa fa-home
   w3-large w3-text-theme w3-center"></i>Home</a>

<a class="w3-bar-item w3-button w3-border" href="<?php
echo site_url('dashboard/Notifications');
?>">  <i  style='margin-right:3%' class="fa fa-bell
   w3-large w3-text-theme w3-center"></i>Notifications</a>
<a class="w3-bar-item w3-button w3-border" href="<?php
echo site_url('dashboard/Profile');
?>">  <i  style='margin-right:3%' class="fa fa-user
   w3-large w3-text-theme w3-center"></i>Profile</a>

<a class="w3-bar-item w3-button w3-border" href="<?php
echo site_url('dashboard/account');
?>">  <i  style='margin-right:3%' class="fa fa-money
   w3-large w3-text-theme w3-center"></i>Account Balance</a>


<a class="w3-bar-item w3-button w3-border" href="<?php
echo site_url('dashboard/account#transfer');
?>">  <i  style='margin-right:3%' class="fa fa-arrow-circle-right
   w3-large w3-text-theme w3-center"></i>Transfer Bold</a>


     <a class="w3-bar-item w3-button w3-border" href="<?php
     echo site_url('dashboard/change_password');
     ?>">  <i  style='margin-right:3%' class="fa fa-key
        w3-large w3-text-theme w3-center"></i>Change Password</a>

     
     <a class="w3-bar-item w3-button w3-border" href="<?php
     echo site_url('Dashboard/payment');
     ?>">  <i  style='margin-right:3%' class="fa fa-heart
        w3-large w3-text-theme w3-center"></i>Buy Lives</a>

       

       <a class="w3-bar-item w3-button w3-border" href="<?php
      echo site_url('affilate');
      ?>">  <i  style='margin-right:3%' class="fa fa-users
         w3-large w3-text-theme w3-center"></i>Affilate</a>

       <a class="w3-bar-item w3-button w3-border" href="<?php
      echo site_url('dashboard/withdrawal');
      ?>">  <i  style='margin-right:3%' class="fa fa-cogs
         w3-large w3-text-theme w3-center"></i>Withdrawal Settings</a>

 <a class="w3-bar-item w3-button w3-border" href="<?php
      echo site_url('dashboard/History');
      ?>">  <i  style='margin-right:3%' class="fa fa-clock-o
         w3-large w3-text-theme w3-center"></i>Account History</a>

<a class="w3-bar-item w3-button w3-border" href="<?php
      echo site_url('contact');
      ?>">  <i  style='margin-right:3%' class="fa fa-envelope
         w3-large w3-text-theme w3-center"></i>Contact Us</a>

      <a class="w3-bar-item w3-button w3-border" href="<?php
      echo site_url('Dashboard/logout');
      ?>">  <i  style='margin-right:3%' class="fa fa-minus
         w3-large w3-text-theme w3-center"></i>Logout</a>
 </nav>
