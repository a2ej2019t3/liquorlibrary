<?php
session_start();
$_SESSION['location'] = "index";
include_once "init.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Liquor Library Homepage</title>
  <?php
  include_once(ROOT_DIR . "partials/head.php");
  ?>
  <link rel="stylesheet" href="css/index.css">
</head>

<body>
  <!-- <div style="background:red; width:100vw; height:100vh; z-index: 99999; position:fixed; top:0;">
    <p style="width:inherit; height:inherit; text-align:center; top:50%;">loading...</p>
  </div> -->
  <?php  
  include_once(ROOT_DIR . "partials/header.php");
  include_once(ROOT_DIR . "partials/indicatorDown.php");
  ?>
  <section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12" id="mainscreen"></div>
      </div>
    </div>
  </section>
  <br><br><br><br>
  <section id="specialindex" style="margin-top:150px;">
    <div class="container">
      <?php
      include(ROOT_DIR . 'specialupload/specialindex.php');
      ?>
    </div>
  </section>
  <br><br><br><br>
  <hr>
  <section style="margin-top:150px;">

    <?php
    include(ROOT_DIR . 'partials/productindex.php');
    ?>

  </section>
  <hr>
  <section class="container p-t-3" id="aboutus">
    <div class="row" id="slider-text" style="margin-top:200px;">
      <div class="col-md-6">
        <h2 style="font-family: 'Josefin Sans', sans-serif;">ABOUT US</h2>
      </div>
    </div>
  </section>
  <section>
   
      <div class="container">
        <div class="aboutmain container">
          <p class="fourth-text">DEDICATED FOR 15 YEARS</p>
        </div>
       
          <!-- <img id="s3test" src="https://liquorlibrary-test.s3-ap-southeast-2.amazonaws.com/banner1.jpg" alt="asdf"> -->
          <div class="row">
            <div class="col-6">
              <img class="brandlogo" src="images/brandlogo.jpg" alt="">
              
            </div>
            <div class="col-6">
              
              <p class="aboutdes" style="margin-top:50px;">With <b>over 15 years experience</b> in Alcohol industry Liquor Library combines innovation with <b>traditional liquor</b> with access to <b>hundreds of on premises</b> and off premise retail location Nation wide along with extensive networks Globally to offer what we believe.</p>
            </div>
          </div>
        
        
      </div>
    

  </section>
  <?php
  include_once(ROOT_DIR . "partials/indicatorUp.php");
  include_once(ROOT_DIR . "partials/footer.php");
  include_once(ROOT_DIR . "partials/foot.php");
  ?>
  <script type="text/javascript" src="js/sub.js"></script>
  <script type="text/javascript" src="js/cart.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
  <script type="text/javascript" src="js/main.js"></script>

</body>

</html>