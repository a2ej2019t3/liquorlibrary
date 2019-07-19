<?php
session_start();
$_SESSION['location'] = "index";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Liquor Library Homepage</title>
  <?php
  include_once("partials/head.php");
  ?>
  <link rel="stylesheet" href="css/index.css">
  <style>
    svg {
      margin-left: -8px;
      margin-top: 42vh;
      width: 100vw;
      height: 100vh;
    }

    path {
      stroke: #fded81;
      stroke-width: 100vh;
      stroke-linecap: round;
      fill: none;
    }

    #front {
      color: rgba(255, 255, 255, 0.4);
      top: 50%;
      left: 0;
      position: fixed;
      width: 100vw;
      height: 100vh;
      padding-top: 0px;
      margin-top: -5rem;
      text-align: center;
      font-size: 6rem;
      z-index: 100;
      text-shadow: 0px 1px 6px rgba(255, 255, 255, 0.3);
    }

    #back {
      z-index: -100;
      color: rgba(0, 0, 0, 0.9);
      top: 50%;
      left: 0;
      position: fixed;
      width: 100vw;
      height: 100vh;
      padding-top: 0px;
      margin-top: -5rem;
      text-align: center;
      font-size: 6rem;
      text-shadow: 0px 1px 3px rgba(0, 0, 0, 0.8);
    }

    #slogan {
      z-index: 100;
      color: rgba(0, 0, 0, 0.7);
      top: 100%;
      left: 0;
      position: fixed;
      width: 100vw;
      height: 100vh;
      padding-top: 0px;
      margin-top: -5rem;
      text-align: center;
      font-size: 1rem;
      font-family: 'Open Sans', sans-serif;
    }

    #loadingScreen {
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1000000;
    }

    #loadingBackground {
      background-color: #fdf9ef;
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      z-index: -200;
    }
  </style>
  <script>
    let xs = [];
    let windowWidth = screen.width;
    let windowHeight = screen.height;
    // alert(windowWidth);
    for (var i = 0; i <= windowWidth; i++) {
      xs.push(i);
    }
    let t = 0;

    function animate() {
      let points = xs.map(x => {
        let y = (windowHeight * 0.57) + 20 * Math.sin((x + t) / 400);
        return [x, y];
      })

      let path = "M" + points.map(p => {
        return p[0] + "," + p[1]
      }).join("L")

      console.log(path);

      document.querySelector("path").setAttribute("d", path);

      t += 5;

      requestAnimationFrame(animate);
    }
    var x = 0;
    window.addEventListener("resize", function() {
      windowWidth = window.innerWidth;
      windowHeight = window.innerHeight;
      for (var i = 0; i <= windowWidth; i++) {
        xs.push(i);
      }
    });
    animate();
    // $(window).load(function() {
    //   $('#loadingScreen').hide();
    // });
  </script>
</head>

<body>
  <div id="mainContent">
    <?php
    include_once("partials/header.php");
    include_once("partials/indicatorDown.php");
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
        include('specialupload/specialindex.php');
        ?>
      </div>
    </section>
    <br><br><br><br>
    <hr>
    <section style="margin-top:150px;">

      <?php
      include('partials/productindex.php');
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
    include_once("partials/indicatorUp.php");
    include_once("partials/footer.php");
    ?>
  </div>
  <?php
  include_once("partials/foot.php");
  ?>

  <script type="text/javascript" src="js/sub.js"></script>
  <script type="text/javascript" src="js/cart.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
</body>

<div id='loadingScreen'>
  <div id="loadingBackground">
  </div>
  <svg>
    <path d="M10,10 L50,100 L90,50"></path>
  </svg>
  <p id="front" style="font-family: 'Cinzel', serif;">Liquor Library</p>
  <p id="back" style="font-family: 'Cinzel', serif;">Liquor Library</p>
  <p id="slogan">THE NEW INDUSTRY STANDARD</p>
</div>

</html>