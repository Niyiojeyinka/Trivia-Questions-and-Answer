<!DOCTYPE html>
<html>
<title><?php
 echo $title;
    ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
<meta name="description" content="<?php echo $descriptions; ?>">
<meta name="keywords" content="<?php
echo $keywords;
?>">
<link rel="shortcut icon" href="<?php echo base_url('assets/images/pryperfavicon.png'); ?>" />


<meta property="og:image" content="<?php

echo base_url('assets/images/prypersocialimage.png'); ?>" />
<style>
a {
text-decoration:none;

}
 a:active{
background-color:ndigo;

}
 </style>


<meta property="og:description" content="<?php echo $descriptions; ?>" />

<meta property="og:url"content="<?php echo current_url(); ?>" />

<meta property="og:title" content="<?php echo $title; ?>" />
<?php
if(isset($noindex))
{
echo $noindex;

}
 ?>
 <?php
 if($this->pages_model->get_common("head_content") != NULL)
 {

   foreach ($this->pages_model->get_common("head_content") as  $value) {
     echo $value['content'];


   }

 }
  ?>

	 

<link rel="stylesheet" href="<?php echo base_url('assets/css/w3mobile.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/w3-theme-teal.css'); ?>">
<link rel="stylesheet"  href="<?php echo base_url('assets/css/w3.css'); ?>">
<link rel="stylesheet"  href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet"  href="<?php echo base_url('assets/css/font-awesome-4.7.0/css/font-awesome.min.css'); ?>">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<style>
body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
body {font-size: 16px;}
img {margin-bottom: -8px;}
.mySlides {display: none;}
</style>
		<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>





 
