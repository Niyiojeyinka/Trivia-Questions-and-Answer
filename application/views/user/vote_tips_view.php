<script type="text/javascript">
    var t = setInterval(function (){

var timeToEnd = <?=$election_end ?>;
var rightNow = new Date().getTime();
var rightNow = Math.floor(rightNow/1000);

var margin = timeToEnd-rightNow;
    var  mo =Math.floor(margin/(60*60*24*31));
    var d = Math.floor((margin % (60*60*24*31))/(60*60*24));
    var h = Math.floor(((margin % (60*60*24*31))%(60*60*24))/(60*60));
    
    var m = Math.floor((((margin % (60*60*24*31))%(60*60*24))%(60*60))/(60));
    
  var s =  Math.floor((((margin % (60*60*24*31))%(60*60*24))%(60*60))%(60));
document.getElementById('liveTimer').innerHTML =mo+'<span style="font-size:10px">months</span> '+d+'<span style="font-size:10px">days</span> '+h+'<span style="font-size:10px">hours</span> '+m+'<span style="font-size:10px">minutes</span> '+s+'<span style="font-size:10px">seconds</span> ';

    }, 1000);


  </script>
  <center>
                  <span>Voting End In</span><br>
<div id="liveTimer" class="">


</div>
<!--error messages here-->

<div>
  <?php
if(isset($_SESSION['error_messages']))
{
  foreach ($_SESSION['error_messages'] as $err) {
    echo $err;
   } 
}

  ?>
</div>
                 <br>
              <!-- voting area-->
              <div class="w3-container" style="overflow-y: scroll;height: 320px">
	<span class="w3-large w3-serif w3-text-theme">Vote Your Tips</span>
<br>
<a href="<?=site_url('dashboard/view_vote_result') ?>" class="w3-button w3-theme w3-margin w3-round-xxlarge">View Result</a>
<br>
<?= form_open('dashboard/vote') ?>
<?php
for ($i=0; $i < count($holder); $i++) {
echo "<span style=''>".$holder[$i]['position_name']."</span><br>";

  if(empty( $holder[$i]['tips']))
  {
echo "<br><span class='w3-small'>No Tips For this Stage</span><br><br>";
  }else{

echo "<select class='w3-round w3-padding w3-border-theme' name='".$holder[$i]['position_id']."'>";

  echo "<option value=''>Choose</option>";

foreach ($holder[$i]['tips'] as $tip) {
  
  echo "<option value='".$tip['id']."'>".$tip['label']."</option>";
}
    echo "</select>";
echo "<br><br>";

echo "</select>";

}
}

?>

<input  type="submit" class="w3-button w3-teal w3-round-large w3-margin" name="submit" value="Vote Now"/>

<br>

</form>


</div>
            	    
            </center>

<div style="display: none;" id="usediv"></div>

<script type="text/javascript">
   
var myVar = setInterval(myTimer, 500);

function myTimer() {
    $("#usediv").load("<?= site_url('dashboard/return_countdown_check') ?>", function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success")
        {
        
       if(responseTxt =='stop')
         {
               window.location.assign("<?=site_url('dashboard/view_vote_result') ?>");
         }else if(responseTxt =='wait')
        {
               
               window.location.assign("<?=site_url('dashboard') ?>");


        }
    }
    /* if(statusTxt == "error")
        {
            alert("Network Error: " + xhr.status + ": " + xhr.statusText);
        }*/
    });
}



</script>
