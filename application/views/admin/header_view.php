<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="description" content="<?php //echo $description; ?>">
<meta name="keywords" content="<?php
/*foreach ($keywords as $keyw)
{
echo $keyw.',';
}*/
?>">
<meta name="author" content="<?php //echo $author;?>">
<meta name="robots" content="noindex, nofollow">
<link rel="shortcut icon" href="<?php echo base_url('assets/images/pryperfavicon.png'); ?>" />

<title><?php echo $title; ?></title>
<link rel="stylesheet"  href="<?php echo base_url('assets/css/w3.css'); ?>">
<style>
a {
text-decoration:none;
}
@media screen and (min-width:400px){
#menuc {
width:50%;
}
#imgmedia {
display:inline-block;
width:40%;
height:50%;
}
}
</style>





<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet"  href="<?php echo base_url('assets/css/font-awesome-4.7.0/css/font-awesome.min.css'); ?>">

</head>
<body class="">

<div style="height:2%;width:100%;padding:1%;" class="w3-bar w3-black w3-text-white">
<div style="height:auto;width:20%;padding:;display:inline" class="w3-bar w3-black w3-text-white">
<?php
if(isset($team_name))
{
echo $team_name;
}
?>

</div>


<div style="display:inline">
Total Number of User:<?php echo count($this->users_model->get_users(NULL,NULL));    ?>
<a class="w3-text-white w3-padding w3-hover-white" href="<?php echo site_url("/admin_blog/reports");?>">Reports</a>

<span class=""><?= date('WS',time())."Week" ?></span><br><br>
</div>

</div>


<div class=""><!--container div-->
