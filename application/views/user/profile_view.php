<div class='w3-container w3-center'>
  <hr>
  <div class='w3-container w3-card'>
    <div class="w3-padding w3-center"><br>
      <img class="w3-circle" style='width:30%;height:50%' src="<?php
if(!empty($user_details['profile_img']))
{
  echo base_url('assets/images/profiles/'.$user_details['profile_img']);
}else{
  echo base_url('assets/images/prypericon.png');
}

   ?>" alt="avatar" style="width:75%">

    <br>  <a  onclick="document.getElementById('container0').style.display='block'"
      class="w3-button w3-text-theme" >Change Profile Picture</a>
    </div>



     <!-- modal div -->

      <div id="container0" style='max-width:600px;<?php
    //echo display = block when neccessary
    if(isset($_SESSION["picture_err_msg"]))
    {
    echo 'display:block';

    }

        ?>' class="w3-modal">
       <div class="w3-modal-content w3-theme">
         <header class="w3-container"><h2>Pryper</h2>
           <span onclick="document.getElementById('container0').style.display='none'"
           class="w3-button w3-display-topright">&times;</span>

         </header>

             <div class="w3-container w3-white">
               <p>Change Profile Picture</p>
               <div class='w3-small w3-text-red'><?php
               //echo display = block when neccessary
               if(isset($_SESSION["picture_err_msg"]))
               {
               echo $_SESSION["picture_err_msg"];

               }

                 ?></div>
               <div class='w3-container'>
                 <?php
                 echo form_open_multipart("/dashboard/change_profile_picture");
                 ?>

                   <i  style='margin-right:3%' class="fa fa-image
                    w3-large w3-text-theme w3-center"></i>

                    <input class='w3-center' style='width:60%' type='file' name='picture'  />
    <br>
    <input class='w3-center w3-button w3-theme w3-margin-top w3-margin-bottom' type='submit' name='submit' value='Upload Picture'/>
    <br>
    </form>

               </div>


             </div>

             <footer class="w3-container w3-theme">
               <p>&copy; Pryper <?php
              if (date('y') == 18)
              {
              echo "20".date('y');
              }else{
              echo "2018 - 20".date('y');
              }
              ?></p>
             </footer>



        </div>

     </div>
    <!--modal ends here-->





    <?php


    echo "<b>".strtoUpper($item['firstname']).'  '.strtoUpper($item['lastname']).
    "(".ucfirst(strtolower($item['username'])).")</b></br>"; ?>
    <!-- modal button -->
<a  onclick="document.getElementById('container1').style.display='block'"
class="w3-button w3-text-theme" >Edit</a>



 <!-- modal div -->

  <div id="container1" style='max-width:600px;<?php
//echo display = block when neccessary
if(isset($_SESSION["username_err_msg"]))
{
echo 'display:block';

}

    ?>' class="w3-modal">
   <div class="w3-modal-content w3-theme">
     <header class="w3-container"><h2>Pryper</h2>
       <span onclick="document.getElementById('container1').style.display='none'"
       class="w3-button w3-display-topright">&times;</span>

     </header>

         <div class="w3-container w3-white">
           <p>Edit Username</p>
           <p class="w3-small">E.g @Willa</p>
           <div class='w3-small w3-text-red'><?php
           //echo display = block when neccessary
           if(isset($_SESSION["username_err_msg"]))
           {
           echo $_SESSION["username_err_msg"];

           }

             ?></div>
           <div class='w3-container'>
             <form class='w3-center' method='POST' action='<?php echo site_url('dashboard/edit_username'); ?>'>

               <i  style='margin-right:3%' class="fa fa-user
                w3-large w3-text-theme w3-center"></i>

                <input class='w3-center' style='width:60%' type='text' name='username' value='<?php echo $item['username']; ?>' placeholder='Username'/>
<br>
<input class='w3-center w3-button w3-theme w3-margin-top w3-margin-bottom' type='submit' name='submit' value='Edit Username'/>
<br>
</form>

           </div>


         </div>

         <footer class="w3-container w3-theme">
           <p>&copy; Pryper <?php
          if (date('y') == 18)
          {
          echo "20".date('y');
          }else{
          echo "2018 - 20".date('y');
          }
          ?></p>
         </footer>



    </div>

 </div>
<!--modal ends here-->



<br>

<div class='w3-center'>
<span><b>Status:</b></span><br>
<?php
 echo  "<div class='w3-small'>".$item['short_status'];
 ?>
 <!-- modal button -->
<a  onclick="document.getElementById('container2').style.display='block'"
class="w3-button w3-text-theme" >Edit</a>



<!-- modal div -->

<div id="container2" style='max-width:600px;<?php
//echo display = block when neccessary
if(isset($_SESSION["status_err_msg"]))
{
echo 'display:block';

}

  ?>' class="w3-modal">
 <div class="w3-modal-content w3-theme">
   <header class="w3-container"><h2>Pryper</h2>
     <span onclick="document.getElementById('container2').style.display='none'"
     class="w3-button w3-display-topright">&times;</span>

   </header>

       <div class="w3-container w3-white">
         <p>Edit Status</p>
         <div class='w3-small w3-text-red'><?php
         //echo display = block when neccessary
         if(isset($_SESSION["status_err_msg"]))
         {
         echo $_SESSION["status_err_msg"];

         }

           ?></div>
         <div class='w3-container'>
           <form class='w3-center' method='POST' action='<?php echo site_url('dashboard/edit_status'); ?>'>

             <i  style='margin-right:3%' class="fa fa-user
              w3-large w3-text-theme w3-center"></i>
<textarea name='status' class=''><?php echo $item['short_status']; ?></textarea>
 <br>
<input class='w3-center w3-button w3-theme w3-margin-top w3-margin-bottom' type='submit' name='submit' value='Edit Status'/>
<br>
</form>

         </div>


       </div>

       <footer class="w3-container w3-theme">
         <p>&copy; Pryper <?php
        if (date('y') == 18)
        {
        echo "20".date('y');
        }else{
        echo "2018 - 20".date('y');
        }
        ?></p>
       </footer>



  </div>

</div>
<!--modal ends here-->


</div><br>

</div>





<hr>
<span><b>Medals:</b></span><br>
<?php
for ($i=0; $i < $item['medals']; $i++) { 
echo "<img class='' style='max-width:20%' src='".base_url('assets/images/prypericon.png')."'/>";

}


?>
<hr>
<span><b>Last Seen:</b></span><br>
<?php echo date( "F j, Y, g:i a",$item['lastlog']);
;
 ?>



<br>
<br>



</div>


   </div>
   <hr>




</div>
