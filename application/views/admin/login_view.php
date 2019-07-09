<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="robots" content="noindex, nofollow">
<meta name="author" content="">
<title>Admin Login</title>
<link rel="stylesheet"  href="<?php echo base_url('assets/css/w3.css'); ?>">
<style>

</style>





<meta name="viewport" content="width=device-width, initial-scale=1.0">
</script>
<noscript>Pls turn on JavaScript!</noscript>
</head>
<body class="">

<center>

<div class="w3-container w3-teal w3-text-blue-grey w3-padding-jumbo">

    <a class="w3-large w3-margin w3-text-white" href="<?php echo site_url();?>">Pryper </a>


</div>
<span class="w3-text-red">
<?php echo validation_errors();
 ?>
</span>
<?php
if (isset($_SESSION['action_status_report'])) {
	echo $_SESSION['action_status_report'];
}

?>
<?php echo form_open("page/admin_login");

?>
       

<span class="w3-label">Username:</span><br>

<input  class="w3-padding w3-margin" name="name" value="<?php echo set_value("name"); ?>" placeholder="Username" required/>
<br>

<span class="w3-label">Password:</span><br>
<input class="w3-padding w3-margin" type='password' name="password" value="<?php echo set_value('password'); ?>" placeholder="Password" required/>
<br>

<input class="w3-btn w3-teal w3-margin" name="submit" type="submit" value="Sign In"></center>


</form>

<div>

<div class="w3-teal w3-padding-jumbo w3-text-white">
<center>

All right reserved<span class="w3-large">|</span>A Pryper Internet ltd<br>
<?php
if (date('y') == 19)
{
echo "© 20".date('y');
}else{
echo "© 2019 - 20".date('y');
}
?>
</center>
</div>
</div>
</div>
</body>
</html>