<link href="https://fonts.googleapis.com/css?family=Handlee|Kalam|Marck+Script&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script&display=swap&subset=latin-ext" rel="stylesheet">
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
    <div class="col-sm-6 col-md-6 col-6">
        <div class="imgwrap">
           <img src="images/banner5.jpg" alt="indeximg" style="width:100%; height:100%;"> 
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-6">
        <div><span class="headingforspecial">Celerbrate your moment with us now</span></div>
       <!-- findout picture -->
       <div class="findoutimgwrap">
            <img src="images/banner7.jpg" alt="findout" style="height:100%; width:100%;">
        </div>
       <!-- picture ends -->
        <div class="productsliderwrapper">
<!-- slider starts -->
<div id="carouselIndicators" class="carousel slide" data-ride="carousel" style="overflow:visible!important;">
  <div class="carousel-inner">

    <?php
        $imgpath = 'images/';
    
        for ($b = 0; $b <count($searchSale_arr); $b++) {
            echo '
                
                 
                <div class="carousel-item product-grid__product col-sm-12 col-md-12 col-lg-12" style="text-align: center; font-family: Montserrat, sans-serif;">
                <img class="backgroundimg" src="images/productcardbackground2.png" style="height: 100%; width:100%; border-radius: 25px; margin:0; padding:0;">
                <div class="proinfo">
                <span class="dailyheading">Daily Special Deal</span>    
                <div class="product-grid__img-wrapper" style="height: 170px; text-algin:center; ">			
                             <img src='.$imgpath.$searchSale_arr[$b][5].' style="width: 120px; max-height: 170px;margin: 0 auto;">
                     </div><br>
                     <button type="button" class="btn btn-secondary btn-sm" id="checkbutton">
                     <a href="productlist.php?pid='.$searchSale_arr[$b][8].'">
                     CHECK NOW
                     </a>
                     </button>
                    <div class="product-grid__title" style="font-size: 1.2rem;font-weight: 600;margin:0;"><span>'.$searchSale_arr[$b][1].'</span></div><br>';
            echo   '<div class="proprice"><span class="offer">Special Offer</span><br><span class="specialprice"><span class="offer">NZ$</span>'.$searchSale_arr[$b][3].'</span></div>';                      

             echo  '</div>
                    </div>';
        
        };

    ?>
  </div>
  <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true" ></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselndicators" role="button" data-slide="next">
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
  .carousel-item{
      margin-top: 30px;
      border: 2px solid rgba(144, 180, 148, 1);
      border-radius:25px;
      height: 100%;
    }

.dailyheading{
    font-size:1.5rem;
    font-family: 'Roboto', sans-serif;
    font-weight:600;
}
.carousel-control-prev-icon {
 background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E") !important;
 z-index: 1000;
}

.carousel-control-next-icon {
  background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E") !important;
  z-index: 1000;
}
.proinfo{
    position: absolute;
    top: 20px;
    left: 40px;
}
.proprice{
    position: absolute;
    top: 30%;
    left: 90%;
    width: 100%;
}
.offer{
    font-size: 18px;
    font-weight: 500;
    margin-left: -20px;
}
.specialprice{
    margin:0;
    font-size: 50px;
    font-weight:700;
    font-family: 'Kalam', cursive;
    color: #8B0000;
    margin-right: -30px;
}
#checkbutton{
      background-color: black;
      border: 1px solid black;
      width: 150px;
      height: 45px;
      font-size: 16px;
      position: absolute;
      bottom: 60px;
      margin-left:150px;
  }

#checkbutton:hover{
      background-color: white;
      border: 1px solid black;
      color: black;
  }
  #checkbutton a{
    color: white!important;
    text-decoration: none!important;
}
#checkbutton a:hover{
    color: black!important;
    text-decoration: none!important;
}
  </style>
<?php
    include_once ("partials/foot.php");
  ?>  
  <script type="text/javascript" src="js/subcategory.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
  <script>
        $(document).ready(function () {
        $('#carouselIndicators').find('.carousel-item').first().addClass('active');
        });

  </script>