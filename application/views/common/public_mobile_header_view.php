<body   class="w3-animate-zoom" style="max-width:1000px;">
  <div style="background-image: url(<?= base_url('assets/images/backgroundmobile.jpg') ?>);">

<header class="w3-bar w3-card  w3-cell-row w3-text-theme">
    <a class="w3-bar-item w3-button w3-xxlarge w3-margin-top w3-hover-themeb w3-cell w3-right"
     onclick="openMenu()"><i  style='margin-right:3%' class="fa fa-bars w3-text-theme"></i>
   </a>
    <a href="<?= site_url() ?>"><img  style='height:30px;margin-top:32px;margin-bottom:32px;display: inline' class='w3-margin-left w3-image'
      src='<?php echo base_url('assets/images/pryper.png'); ?>'
       alt='Pryper'/></a>
<!--<i style='height:30px;margin-top:32px'  class="fa fa-facebook 
w3-margin-right w3-text-theme"></i>  --> 

</header>
<nav class="w3-bar w3-car horizontalmenu" style="display: none;"  id="myMenu">

   <a href="<?php echo site_url(); ?>" class="w3-bar-item w3-button  w3-round-jumbo">Home</a>
  <a href="<?php echo site_url('users/login'); ?>" class="w3-bar-item w3-button w3-hover-theme w3-round-jumbo">Login</a>
  <a href="<?php echo site_url('users/register'); ?>" class="w3-bar-item w3-button w3-hover-theme  w3-round-jumbo">Register</a>
  <a href="#" class="w3-bar-item w3-button w3-hover-theme  w3-round-jumbo">Terms & Condition</a>
  <a href="#" class="w3-bar-item w3-button w3-hover-theme  w3-round-jumbo">Privacy & Policy</a>
    <a href="<?=site_url('board/category/blog') ?>" class="w3-bar-item w3-button w3-hover-theme  w3-round-jumbo">Our Blog </a>
  <a href="<?= site_url('contact')?>" class="w3-bar-item w3-button w3-hover-theme  w3-round-jumbo">Contact Us</a>
  <a href="#" onClick='closeMenu()' class="w3-bar-item w3-button w3-hover-theme">X</a>

</nav>

