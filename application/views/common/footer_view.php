
<footer class="w3-container w3-theme w3-center w3-padding-xxlarge w3-margin-top">
 ©Pryper <?php
if (date('y') == 19)
{
echo "20".date('y');
}else{
echo "2019 - 20".date('y');
}
?>

</footer>

<script>
closeSidebar();
function openSidebar() {
    document.getElementById("mySidebar").style.display = "block";
}
function closeSidebar() {
   document.getElementById("mySidebar").style.display = "none";
}

function closeMenu() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>

</body>
