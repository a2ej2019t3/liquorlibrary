
<?php
    // session_start();
    $_SESSION['location'] = 'productlist';
    // $_SESSION['ref'] = $SERVER['QUERYSTRING'];
    include ('connection.php');
    // Sale product search 

    $searchSale_sql = "SELECT `specialId`, `specialName`, `specialType`, `specialPrice`, `specialInfo`, `specialImg`, `startTime`, `finishTime`, `productID` FROM `specials` WHERE  `specialType`=2";
    $searchSale_res = mysqli_query($connection, $searchSale_sql);
    
    if ($searchSale_res != "") {
        $searchSale_arr = mysqli_fetch_all($searchSale_res);
        $resultcount=count($searchSale_arr);
    } else {
        alert("result empty");
    }
 ?>
<div class="row">
    <div class="col-sm-5 col-md-5 col-5">
        <div class="imgwrap">
           <img src="images/banner5.jpg" alt="indeximg" style="width:100%; height:100%;"> 
        </div>
    </div>
    <div class="col-sm-7 col-md-7 col-7">
        <div><span class="headingforspecial">Celerbrate your moment with us now</span></div>
        <div class="productsliderwrapper">
<!-- slider starts -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="overflow:visible!important;">
  <ol class="carousel-indicators">

     <?php
         for($a = 0; $a <count($searchSale_arr); $a++){
            echo '<li data-target="#carouselExampleIndicators" data-slide-to='.$a.' class=""></li>';
         }
     ?>
  </ol>
  <div class="carousel-inner" style="height: 470px; margin-top: 80px;">;

    <?php
        $imgpath = 'images/';
    
        for ($b = 0; $b <count($searchSale_arr); $b++) {
            echo '
                
                 
                <div class="product-grid__product col-sm-12 col-md-12 col-lg-12" style="text-align: center; font-family: Montserrat, sans-serif;">
                    <div class="product-grid__img-wrapper" style="height: 185px; text-algin:center; ">			
                             <img src='.$imgpath.$searchSale_arr[$b][5].' style="width: 120px; max-height: 170px;margin: 0 auto;">
                     </div><br>
                    <div class="product-grid__title" style="font-size: 1.2rem;font-weight: 600;"><span>'.$searchSale_arr[$b][1].'</span></div><br>';
            echo   '<div class="product-grid__price"><span style="font-size:1.4rem;">NZ$'.$searchSale_arr[$b][3].'</span></div>';                      
                  
             echo  '</div>';
        
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

<!-- slider ends -->
        </div>
    </div>         
</div>
<!-- /* 
font-family: 'Lato', sans-serif;
font-family: 'Shadows Into Light', cursive;
font-family: 'Cinzel', serif;
font-family: 'Roboto', sans-serif;
font-family: 'Open Sans', sans-serif;
font-family: 'Montserrat', sans-serif;
font-family: 'Playfair Display', serif;
*/ -->
<style>
.headingforspecial{
    font-size: 3rem;
    font-family: 'Playfair Display', serif;
    margin: 10px auto;
    font-weight: 600;
  }  

  </style>
    <script>
        $(document).ready(function () {
        $('#carouselExampleIndicators').find('.carousel-item').first().addClass('active');
        });

  </script>