<?php
  session_start();
  $_SESSION['location'] = "index";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Liquor Library Homepage</title>
  <?php
    include_once ("partials/head.php");
  ?>
  <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php
    include_once ("partials/header.php");
    ?>
    <section>
      <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12" id="mainscreen"></div>
            </div>
        </div>
    </section>
    <br><br><br><br>
    <section id="aboutus">
      <div class="container-fluid">
            <div class="container-fluid">
              <div class="aboutmain container-fluid"><p class="fourth-text">DEDICATED FOR 15 YEARS</p></div>
              <div class="aboutdes container"><p class="aboutdes">With <b>over 15 years experience</b> in Alcohol industry Liquor Library combines innovation with <b>traditional liquor</b> with access to <b>hundreds of on premises</b> and off premise retail location Nation wide along with extensive networks Globally to offer what we believe.</p></div>
              <div class="brand container-fluid">
                <img class="brandlogo" src="images/brandlogo.jpg" alt="">
              </div>
            </div>
        </div>

    </section>

  <?php
    include_once ("partials/foot.php");
  ?>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
  

</body>
</html>