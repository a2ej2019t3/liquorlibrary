<?php
    session_start();
    $_SESSION['location'] = 'productlist';
    include_once ('connection.php');
    // main deals search 
    $maindeal_sql = "SELECT `specialId`, `specialName`, `specialType`, `specialPrice`, `specialInfo`, `specialImg`, `startTime`, `finishTime` FROM `specials` WHERE `specialType`=1;";
    $maindeal_res = mysqli_query($connection, $maindeal_sql);
    
    if ($maindeal_res != "") {
        $maindeal_arr = mysqli_fetch_all($maindeal_res);
        $resultcount=count($maindeal_arr);
        $imgpath = 'images/';
    } else {
        alert("result empty");
    }
 ?>

<!DOCTYPE html>
<html lang="en">
<?php
    include_once ("partials/head.php");
  ?>
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Special Deals</title>
<style>
    /* 
font-family: 'Lato', sans-serif;
font-family: 'Shadows Into Light', cursive;
font-family: 'Cinzel', serif;
font-family: 'Roboto', sans-serif;
font-family: 'Open Sans', sans-serif;
font-family: 'Montserrat', sans-serif;
font-family: 'Playfair Display', serif;
*/
    .carousel-caption{
    text-align:center;
    margin: 10px auto;
    position:absolute;
    top: 30px;
    z-index:1000;
    font-family: 'Cinzel', serif;
    }
    .carousel-caption .info{
    font-size:3rem;
    }
    @media(max-width: 660px){
        .carousel-caption .info{
        font-size:1.5rem;
        }
    }
    .carousel-caption .priceinfo{
    font-size:2rem;
    color: #8B0000;
    }
    @media(max-width: 660px){
        .carousel-caption .info{
        font-size:0.7rem;
        color: #8B0000;
        }
    }
</style>
</head>
<body style="height: 110%;">

<section>
        <?php
            include_once ("partials/header.php");
        ?>        
</section>
<br><br>

<section>
<!-- image slides -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="overflow:visible!important;">
  <ol class="carousel-indicators">

     <?php
         for($a = 0; $a <count($maindeal_arr); $a++){
            echo '<li data-target="#carouselExampleIndicators" data-slide-to='.$a.' class=""></li>';
         }
     ?>
  </ol>
  <div class="carousel-inner" style="height: 470px; margin-top: 80px;">;

    <?php
        for($b = 0; $b <count($maindeal_arr); $b++){

            echo '<div class="carousel-item">
                         <img class="d-block w-100" src='.$imgpath.$maindeal_arr[$b][5].' alt="slide">;
                         <div class="carousel-caption d-md-block d-lg-block">';
                       echo '<p class="info">'.$maindeal_arr[$b][4].'</p>';                       
                            if($maindeal_arr[$b][3]!=0){
                                echo'<div class="specialprice">Only NZ$<span class="priceinfo">'.$maindeal_arr[$b][3].'</span></div>';
                            }
                            else{}                                                     
                            
              echo '</div>
                  </div>';
        };
    ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!-- image slides end -->

</section>
<?php
    include_once ("partials/foot.php");
  ?>  
  <script type="text/javascript" src="js/subcategory.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
  <script>
        $(document).ready(function () {
        $('#carouselExampleIndicators').find('.carousel-item').first().addClass('active');
        });
  </script>
</body>
</html>
