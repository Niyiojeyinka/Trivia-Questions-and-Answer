 <script type="text/javascript">
    var t = setInterval(function (){
var current_time = new Date().getTime();
var current_time = Math.floor(current_time/1000);
var countdown = <?= $election_start ?>;
var margin = countdown-current_time;
    var  mo =Math.floor(margin/(60*60*24*31));
    var d = Math.floor((margin % (60*60*24*31))/(60*60*24));
    var h = Math.floor(((margin % (60*60*24*31))%(60*60*24))/(60*60));
    var m = Math.floor((((margin % (60*60*24*31))%(60*60*24))%(60*60))/(60));
  var s =  Math.floor((((margin % (60*60*24*31))%(60*60*24))%(60*60))%(60));


document.getElementById('time_div').innerHTML =mo+'<span style="font-size:8px">months</span> '+d+'<span style="font-size:8px">days</span> '+h+'<span style="font-size:8px">hours</span> '+m+'<span style="font-size:8px">minutes</span> '+s+'<span style="font-size:8px">seconds</span> ';

    }, 1000);


  </script>
<div class='w3-container w3-center'><br>
	  <span class="w3-text-theme w3-large w3-margin w3-serif">Vote Tips</span><br>


<hr>

<!--create a loader here-->
<script type="text/javascript">
	setInterval(function(){
var icons = ["fa-hourglass-o","fa-hourglass-1","fa-hourglass-2","fa-hourglass-3","fa-hourglass-half","fa-hourglass"];
var max = icons.length ;
var min = 0;
 var i = Math.floor(Math.random() * (max - min) ) + min;
var loaderDiv = document.getElementById('loader');
loaderDiv.setAttribute('class','fa '+icons[i]+' w3-jumbo w3-text-theme w3-margin')

	},1000)



</script>

<p class='w3-serif w3-large'>Voting Start In</p><br>

<div class="" id="time_div">
  
</div>
<i id="loader" class="fa fa-hourglass-o w3-xlarge w3-text-theme w3-margin"></i>
	



</div><div style="display: none" id="useredirect"></div>

<script type="text/javascript">
    
var myVar = setInterval(myTimer, 1000);

function myTimer() {
    $("#useredirect").load("<?= site_url('dashboard/return_countdown_check') ?>", function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success")
        {

        if(responseTxt == 'start')
        {

     //redirect to voting area
         //in the voting area check for time

           window.location.assign("<?=site_url('dashboard/vote') ?>");

              
        }else if(responseTxt =='stop')
         {
               window.location.assign("<?=site_url('dashboard/post_vote') ?>");
         }
    }
    /* if(statusTxt == "error")
        {
            alert("Network Error: " + xhr.status + ": " + xhr.statusText);
        }*/
    });
}



</script>