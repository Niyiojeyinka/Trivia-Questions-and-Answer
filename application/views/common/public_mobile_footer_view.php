



<footer class="w3-container w3-center w3-padding-xxlarge w3-margin-top">
 © Pryper <?php
if (date('y') == 19)
{
echo "20".date('y');
}else{
echo "2019 - 20".date('y');
}
?>
<center class='w3-text-theme w3-serif'><a href='<?= site_url('enterprise') ?>'>Pryper For Businesses</a></center>
</footer>



<script>
closeSidebar();
function openMenu() {
	var menu = document.getElementById("myMenu");
   if(menu.style.display == "block") 
   {
   	menu.style.display = "none";
   }else{
   menu.style.display = "block";
   }
}


function closeMenu() {
  document.getElementById("myMenu").style.display = "none";
}
</script>

</body>
</html>