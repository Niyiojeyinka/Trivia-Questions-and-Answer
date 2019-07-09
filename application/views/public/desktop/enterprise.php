<body class="w3-content w3-black" style="max-width:1500px;">

<!-- Header with Slideshow -->
<header class="w3-display-container w3-center">
 
  <div class="mySlides w3-animate-opacity">
    <img class="w3-image" src="<?= base_url('assets/images/nbn.jpg')?>" alt="Image 1" style="min-width:500px" width="1500" height="1000">
    <div class="w3-display-left w3-padding w3-hide-small" style="width:35%">
      <div class="w3-black w3-opacity w3-hover-opacity-off w3-padding-large w3-round-large">
        <h1 class="w3-xlarge">Pryper for Advertisers</h1>
        <hr class="w3-opacity">
        <p>Advertise your product and services on pryper and get higher returns for less! </p>
        <p><a href="#advertiser" class="w3-btn w3-block w3-teal w3-round">Get Started</a></p>
      </div>
    </div>
  </div>
  <div class="mySlides w3-animate-opacity">
    <img class="w3-image" src="<?=base_url('assets/images/imi.jpg') ?>" alt="Image 2" style="min-width:500px" width="1500" height="1000">
    <div class="w3-display-left w3-padding w3-hide-small" style="width:35%">
      <div class="w3-black w3-opacity w3-hover-opacity-off w3-padding-large w3-round-large">
        <h1 class="w3-xlarge w3-text-red"><b>Pryper Sponsorship</b></h1>
        <hr class="w3-opacity">
        <p>Be our Sponsor and get your Campaign in the minds of your Prospects</p>
        <p>        <p><a href="#sponsor" class="w3-btn w3-block w3-teal w3-round">Get Started</a></p>
</p>
      </div>
    </div>
  </div>
  <div class="mySlides w3-animate-opacity">
    <img class="w3-image" src="<?= base_url('assets/images/imagr.jpg') ?>" alt="Image 3" style="min-width:500px" width="1500" height="1000">
    <div class="w3-display-left w3-padding w3-hide-small" style="width:35%">
      <div class="w3-black w3-opacity w3-hover-opacity-off w3-padding-large w3-round-large">
        <h1 class="w3-xlarge">Pryper for Business & creators</h1>
        <hr class="w3-opacity">
        <p>Want us to ask question(s) about your product or services for our Users to know more about your product/service ?</p>
        <p>        <p><a href="#creator" class="w3-btn w3-block w3-teal w3-round">Get Started</a></p>
<i class="fa fa-music"></i> <i class="fa fa-globe"></i></a></p>
      </div>
    </div>
  </div>
  <a class="w3-btn w3-opacity w3-hover-opacity-off w3-display-right w3-margin-right w3-round w3-hide-small w3-hover-teal" onclick="plusDivs(1)"><i class='w3-small'>Want More </i><i class="fa fa-angle-right"></i></a>
  <a class="w3-button w3-block w3-black w3-hide-large w3-hide-medium" onclick="plusDivs(1)">Want More <i class="fa fa-angle-right"></i></a>
</header>

<!-- The App Section -->
<div class="w3-padding-64 w3-white">
  <div class="w3-row-padding">
    <div class="w3-col l8 m6">
      <h1 class="w3-jumbo"><b>Pryper Trivia</b></h1>
      <h1 class="w3-xxlarge w3-text-teal"><b>Educating,fun and rewarding</b></h1>
      <p><span class="w3-xlarge">Acquire More Customer.</span> With Pryper Enterprise solutions, which consists of Advertising Package that let you advertise your Product or Services on our website and Forum ,Sponsorship Package which allow you/your business to sponsor a game and have your business/product name attach to the game and also a bonus of advertising package,The Creator Package, this let you promote your product/service/music etc by asking a trivia question on such item(We give tips on where users should expect question from, a day before our daily Game).</p>
    <a href='<?= site_url('mobile') ?>' class="w3-btn w3-light-grey w3-padding-large w3-section w3-hide-small w3-border">
        <i class="fa fa-globe"></i> Use Our Mobile Web
      </a>
      <p><i class="w3-small">Compatible with</i> <i class="fa fa-android w3-xlarge w3-text-green"></i> <i class="fa fa-apple w3-xlarge"></i> <i class="fa fa-windows w3-xlarge w3-text-blue"></i> <i class="fa fa-opera w3-xlarge w3-text-red w3-small"></i> <i class="fa fa-chrome w3-xlarge w3-text-yellow w3-small"></i> <i class="fa fa-firefox w3-xlarge w3-text-indigo  w3-small"></i> <i class="fa fa-safari w3-xlarge w3-text-indigo w3-small"></i></p>
    </div>
    <div class="w3-col l4 m6">
      <img src="<?= base_url('assets/images/mobile.png') ?>" class="w3-image w3-right w3-hide-small" width="335" height="471">
      <div class="w3-center w3-hide-large w3-hide-medium">
       <a href='<?= site_url('') ?>' class="w3-btn w3-light-grey w3-padding-large w3-section w3-border">
        <i class="fa fa-globe"></i> Use Our Mobile Web
      </a>
        <img src="<?= base_url('assets/images/pryper.png') ?>" class="w3-image w3-margin-top" width="335" height="471">
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="advertisem" class="w3-modal w3-animate-opacity">
  <div class="w3-modal-content" style="padding:32px">
    <div class="w3-container w3-white">
      <i onclick="document.getElementById('advertisem').style.display='none'" class="fa fa-remove w3-xlarge w3-button w3-transparent w3-right w3-xlarge w3-text-teal"></i>
      <?= form_open('page/make_advertise_request') ?>

      <h2 class="w3-wide">Advertisement Package</h2>
      <p>Let Your Advert Fly across all our Platform.</p>
       <div>
        <ul><li>You will receive a call and email from us</li>
          <li>The email will include payment details,payment Link and How upload your advertising Material</li></ul>
      </div>
       <p><input name="phone" class="w3-input w3-border" type="text" placeholder="Enter your Mobile Number"></p>
      <p><input name="email" class="w3-input w3-border" type="text" placeholder="Enter your e-mail"></p>
            <p><input name="type" class="w3-hide" type="text" value="advertiser"></p>

     <input type="submit" name="submit" class="w3-button w3-block w3-padding-large w3-teal w3-margin-bottom" value="Make a Request">
   </form>
    </div>
  </div>
</div>


<!-- Modal -->
<div id="creatorm" class="w3-modal w3-animate-opacity">
  <div class="w3-modal-content" style="padding:32px">
    <div class="w3-container w3-white">
      <i onclick="document.getElementById('creatorm').style.display='none'" class="fa fa-remove w3-xlarge w3-button w3-transparent w3-right w3-xlarge w3-text-teal"></i>
      <?= form_open('page/make_advertise_request') ?>

      <h2 class="w3-wide">Creator Package</h2>
      <p>Lets you get you/your Product/work added to our Pre-Game Tips for Propects to want to know more about you or your Product since Questions will asked from Tips.</p>
       <div>
        <ul><li>You will receive a call and email from us</li>
          <li>The email will include payment details,payment Link and How to submit your product details. </li></ul>
      </div>
       <p><input name="phone" class="w3-input w3-border" type="text" placeholder="Enter your Mobile Number"></p>
      <p><input name="email" class="w3-input w3-border" type="text" placeholder="Enter your e-mail"></p>
      <p><input name="type" class="w3-hide" type="text" value="creator"></p>

     <input type="submit" name="submit" class="w3-button w3-block w3-padding-large w3-teal w3-margin-bottom" value="Make a Request">
   </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="sponsorm" class="w3-modal w3-animate-opacity">
  <div class="w3-modal-content" style="padding:32px">
    <div class="w3-container w3-white">
      <i onclick="document.getElementById('sponsorm').style.display='none'" class="fa fa-remove w3-xlarge w3-button w3-transparent w3-right w3-xlarge w3-text-teal"></i>
      <?= form_open('page/make_advertise_request') ?>

      <h2 class="w3-wide">Sponsorship Package</h2>
      <p>Let Your Advert Fly across all our Platform while also letting you/your Product be in the minds of your prospect.</p>
       <div>
        <ul><li>You will receive a call and email from us</li>
          <li>The email will include payment details,payment Link and ,Reward Details, How to upload your advertising Material</li></ul>
      </div>
       <p><input name="phone" class="w3-input w3-border" type="text" placeholder="Enter your Mobile Number"></p>
      <p><input name="email" class="w3-input w3-border" type="text" placeholder="Enter your e-mail"></p>
    <p><input name="type" class="w3-hide" type="text" value="sponsor"></p>

     <input type="submit" name="submit" class="w3-button w3-block w3-padding-large w3-teal w3-margin-bottom" value="Make a Request">
   </form>
    </div>
  </div>
</div>

<!-- who Section -->
<div class="w3-padding-64 w3-light-grey">
  <div class="w3-row-padding">
    <div class="w3-col l4 m6">
      <img class="w3-image w3-round-large w3-hide-small w3-grayscale" src="<?= base_url('assets/images/pryper.png') ?>" alt="App" width="335" height="471">
    </div>
    <div class="w3-col l8 m6">
      <h1 class="w3-jumbo"><b>Business</b></h1>
      <h1 class="w3-xxxlarge w3-text-teal"><b>For who?</b></h1>
      <p><span class="w3-xlarge">Everyone who do business!!!.</span> Medium,Small and Large Scale Business can use either of our Advertising or Sponsorship Package to advertise there product or services.Upcoming Artist ,Developers,Designers etc can use our Creator package to promote there Contents.</p>
    </div>
  </div>
</div>



<!-- Pricing Section -->
<div class="w3-padding-64 w3-center w3-white">
  <h1 class="w3-jumbo"><b>Packages & Pricing</b></h1>
  <p class="w3-large">Choose the Package that fits your needs.</p>
  <div class="w3-row-padding" style="margin-top:64px">
    <div id="advertiser" class="w3-third w3-section">
      <ul class="w3-ul w3-card w3-hover-shadow">
        <li class="w3-teal w3-xlarge w3-padding-32">Advertising Package</li>
        <li class="w3-padding-16"><b>468X60</b> Banner</li>
        <li class="w3-padding-16"><b>1</b> Week</li>
        <li class="w3-padding-16"><b>3</b> Banner Ad Rotation</li>
         <li class="w3-padding-16"><b>Ad</b> Display Across our Platform</li>
        <li class="w3-padding-16">
          <h2 class="w3-opacity">10% OFF </h2>
        </li>
        <li class="w3-light-grey w3-padding-24">
          <button class="w3-button w3-black w3-padding-large" onclick="document.getElementById('advertisem').style.display='block'"><i class="fa fa-caret-right"></i> Get Started</button>
        </li>
      </ul>
    </div> <div id="sponsor" class="w3-third w3-section">
      <ul class="w3-ul w3-card w3-hover-shadow">
        <li class="w3-dark-grey w3-xlarge w3-padding-32">Sponsorship Package</li>
        <li class="w3-padding-16"><b>468X60</b> Banner</li>
        <li class="w3-padding-16"><b>Name</b> Attached To Game</li>
        <li class="w3-padding-16"><b>Offer</b> Reward to Winner(s)</li>
         <li class="w3-padding-16"><b>Cover</b> Image Advert in Pre-game Screen </li>
        <li class="w3-padding-16">
<br>
<!--List of african countries-->
 <i  style='margin-right:3%' class="fa fa-flag
     w3-large w3-text-theme w3-center"></i>

<select type="text" class="w3-padding" name="country" id="african-countries"> 
  <?php

require('application/views/common/countrylist.php');


  ?>
  </select>        </li>
        <li class="w3-light-grey w3-padding-24">
          <button class="w3-button w3-black w3-padding-large" onclick="document.getElementById('sponsorm').style.display='block'"><i class="fa fa-caret-right"></i> Get Started</button>
        </li>
      </ul>
    </div>
    <div id="creator" class="w3-third w3-section">
      <ul class="w3-ul w3-card w3-hover-shadow">
        <li class="w3-teal w3-xlarge w3-padding-32">Creator Package</li>
        <li class="w3-padding-16"><b>Ads</b> In Tip Voting Section</li>
        <li class="w3-padding-16"><b>1</b> Question from Product/Content</li>
        <li class="w3-padding-16"><b>3</b> Access Link Slot</li>
        <li class="w3-padding-16"><b>Promotion</b> in Forum Pre-Game Post</li>
        
        <li class="w3-padding-16">
          <h2 class="w3-opacity">7% OFF </h2>
        </li>
        <li class="w3-light-grey w3-padding-24">
          <button class="w3-button w3-black w3-padding-large" onclick="document.getElementById('creatorm').style.display='block'"> <i class="fa fa-caret-right"></i> Get Started</button>
        </li>
      </ul>
    </div>
  </div>
  <br>
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-32 w3-light-grey w3-center w3-xlarge">
  <div class="w3-section">
    <a href="http://m.facebook.com/prypertrivia"><i class="fa fa-facebook-official w3-hover-opacity"></i></a>
    <a href="http://twitter.com/prypertrivia">
    <i class="fa fa-twitter w3-hover-opacity"></i></a>
     <a href="http://instagram.com/prypertrivia"><i class="fa fa-instagram w3-hover-opacity"></i></a>
  </div>
  <p class="w3-medium">Pryper Enterprise </p>
</footer>

<script>
// Slideshow
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>

</body>
</html>
