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
        // alert("result empty");
    }
 ?>
 <div id="firstsection">
 <section class="container p-t-3">
<div class="row" id="slider-text">
    <div class="col-md-6" >
      <h2 style="font-family: 'Josefin Sans', sans-serif;">SPECIAL COLLECTION</h2>
    </div>
  </div>
</section>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-6" >
        <div class="container" >
           <img src="images/banner5.jpg" alt="indeximg" style="width:100%; height:100%; padding:0;"> 
           <div class="overlay"></div>
           <div class="hovermsg">
             <div class="dealheading">Exclusive special deal</div><br>
             <button class="Gocheck" onClick="window.location='specials.php';">FIND MORE</button>
           </div>

        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div><span class="headingforspecial col-12">Celerbrate your moment with us</span></div>
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
                <div class="headtag"><span class="dailyheading">'.$searchSale_arr[$b][1].'</span></div>      
                  <img class="backgroundimg" src="images/productcardbackground2.png" style="height: 100%; width:100%; border-radius: 25px; margin:0; padding:0;">
                    
                        <div class="proinfo">
                                    <div class="product-grid__img-wrapper" style="height: 170px; text-algin:center; ">			
                                  <img src='.$imgpath.$searchSale_arr[$b][5].' class="img-fluid proimage" style="width:300px;">
                                    </div><br>
                                    <button type="button" class="btn btn-secondary btn-sm" id="checkbutton">
                                    <a href="categorysearch.php?pd='.$searchSale_arr[$b][8].'&location=category">
                                    
                                    CHECK NOW
                                    </a>
                                    </button>';
                        echo   '<div class="proprice"><span class="offer">Special Offer</span><br>
                        <span class="specialprice">NZ$'.$searchSale_arr[$b][3].'</span></div>';                      
                                  
                echo  '  
                        </div>
                    </div>';
        
        };

    ?>
  </div>
  <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true" ></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
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
font-family: 'Josefin Sans', sans-serif;
*/ -->
<style>
.headtag{
  max-width:400px; 
  padding: 4px 10px;
  border: none;
  height:40px;
  border-top-left-radius:25px;
  border-top-right-radius: 25px;
  background: linear-gradient(-90deg, rgba(219, 207, 176, 1), rgba(144, 180, 148, 1));
  position: absolute;
  top: -20px;
  right: 29px;
  z-index: 100;
}
.headingforspecial{
    font-size: 3rem;
    font-family: 'Playfair Display', serif;
    margin: 10px auto;
    font-weight: 600;
  }  
@media(max-width:700px){
  .headingforspecial{
    font-size: 2.5rem;
    margin: 22px auto;
    font-weight:500;
  }
}

  .carousel-item{
      margin-top: 30px;
      border: 2px solid rgba(144, 180, 148, 1);
      border-radius:25px;
      height: 100%;
    }

.dailyheading{
    font-size:1.6rem;
    width:100%;
    font-family: 'Roboto', sans-serif;
    font-weight:600;

    
}
@media(max-width:890px){
  .dailyheading{
    font-size:2.5rem;
}

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
    font-size: 2rem;
    font-weight: 800;
    position: absolute;
    left: -30px;

}
@media(max-width: 1200px){
  .offer{
    font-size: 1.5rem;
    font-weight: 800;
    position: absolute;
    left: -60px;

}  
}

.specialprice{
    margin:0;
    font-size: 50px;
    font-weight:700;
    font-family: 'Playfair Display', serif;
    color: #8B0000;
    top: 60px;
    position: absolute;
    left: -30px;
}
#checkbutton{
      background-color: black;
      border: 1px solid black;
      width: 150px;
      height: 45px;
      font-size: 16px;
      position: absolute;
      margin-top: 10px;
      right: -50%;
  }

#checkbutton:hover{
      background-color: white;
      border: 1px solid black;
      color: black;
  }
  #checkbutton:hover a{
    color: black!important;
  }
  #checkbutton a{
    color: white!important;
    text-decoration: none!important;
}
#checkbutton a:hover{
    color: black!important;
    text-decoration: none!important;
}
.container {
  position: relative;
  /* margin-top: 50px;
  width: 500px;
  height: 300px; */
  padding:0;
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0);
  transition: background 0.5s ease;
  padding:0;
}
.container:hover .overlay {
  display: block;
  background: rgba(0, 0, 0, .6);
  
}
.Gocheck {
  width: 150px;
  font-size:1.5rem;
  height:100%;
  border: 1px solid white;
  color: white;
  background-color: transparent;
  transition: opacity .35s ease;
  font-family: 'Roboto', sans-serif;
}
.Gocheck:hover{
    background-color: white;
    color: rgba(48, 43, 41,1);
}
.dealheading{
  color: white;
  font-family: 'Roboto', sans-serif;
  text-align:center;
  font-size:2rem;
}
.container:hover .hovermsg {
  opacity: 1;
}
.hovermsg{
  position: absolute;
  width:100%;
  /* left:45%; */
  top: 45%;
  text-align: center;
  opacity: 0;
  transition: opacity .35s ease;
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