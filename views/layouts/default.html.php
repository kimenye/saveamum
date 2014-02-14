<!doctype html>
<html class="no-js" lang="en" xmlns:fb="https://www.facebook.com/2008/fbml">
	<head>
		<title>Buy a Rose | Save a Mum</title>
		<meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    	<link rel="stylesheet" href="/stylesheets/app.css" />
      <script src="/js/modernizr.js"></script>     
      <script src="/js/monster.js"></script>    	
	</head>

	<body class="<?php if (isset($_SESSION['user'])) echo 'donate'; else '' ?>">
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '579225228839064',
          status     : true,
          xfbml      : true
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/all.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));

      window.twttr = (function (d,s,id) {
        var t, js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
        js.src="https://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
        return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
      }(document, "script", "twitter-wjs"));
    </script>
    <div class="hero">
      <!-- Top Banner -->
      <div id="topBanner" class="row">
        <div class="small-11 small-centered medium-5 medium-centered large-4 large-centered columns">
          <div class="logos">  
            <a href="http://chasefoundation.co.ke" class="primary"><img src="/images/logo.png" /></a>
            <a href="http://chasefoundation.co.ke" class="secondary"><img src="/images/amref.png" /></a>
          </div>
        </div>
      </div>
      <!-- End Top Banner -->
      
      
      <!-- Main CTAs -->
      <div class="row container">
        <div class="small-12 large-4 medium-5 columns woman-container">
          <div class="woman">
          </div>
        </div>
        
        <?php echo $content;?>        
      </div>
    </div>

    <!-- Start footer -->
    <div class="footer">
      <div class="grass">        
      </div>
      <div class="footer-body">
        <div class="row">
          <div class="large-7 large-centered counter columns">
            <?php
              

              $number = count($donations);
              // $number = 82015;
              $num_str = "".$number;
              $ones = $number % 10;
              $tens = floor(($number % 100) / 10);
              $hundreds = floor(($number % 1000) / 100);
              $thousands = floor(($number % 10000) / 1000);
              $ten_thousands = floor(($number % 100000) / 10000);

            ?>
            <div class="countdown">
              <span class="digit ten-thousand">
                <?php echo $ten_thousands ?>
              </span>
              <span class="digit thousand">
                <?php echo $thousands ?>
              </span>
              <span class="spacer">,</span>
              <span class="digit hundred">
                <?php echo $hundreds ?>
              </span>
              <span class="digit ten">
                <?php echo $tens ?>
              </span>
              <span class="digit one">
                <?php echo $ones ?>
              </span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="copy small-12 columns">
            <p>
              Join us in supporting this initiative to help reduce maternal mortality by improving access to reproductive health services. 
              <br>
              Our aim is to increase national awareness as well as use the funds to train 15,000 midwives by 2015 in order to contribute towards the reduction of maternal deaths</p>
          </div>
      </div>
    </div>
    
    <script src="/js/jquery.min.js"></script>
    <script src="/js/foundation.min.js"></script>
    <script src="/js/app.js"></script>
  </body>
</html>