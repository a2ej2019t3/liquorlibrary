
<?php
    // session_start();
    // $_SESSION['ref'] = $SERVER['QUERYSTRING'];
    include ('connection.php');
    // Sale product search 

    $searchSale_sql = "SELECT p.productID, p.img, p.productName, p.discountprice, p.price,p.categoryID, b.brandName, c.categoryName,c.categoryID FROM product AS p, brand AS b, category AS c WHERE p.brandID=b.brandID and p.categoryID=c.categoryID and p.discountprice is not null";
    $searchSale_res = mysqli_query($connection, $searchSale_sql);
    
    if ($searchSale_res != "") {
        $searchSale_arr = mysqli_fetch_all($searchSale_res);
        $resultcount=count($searchSale_arr);
        $imgpath = 'images/';
    } else {
        alert("result empty");
    }
 ?>
<section class="container p-t-3">
<div class="row" id="slider-text">
    <div class="col-md-6" >
      <h2 style="font-family: 'Josefin Sans', sans-serif;">SALE COLLECTION</h2>
    </div>
  </div>
</section>
<section class="carousel slide" data-ride="carousel" id="postsCarousel">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-md-right lead">
            <a class="carousel-control left" href="#postsCarousel" data-slide="prev">&lsaquo;</a>
            <a class="carousel-control right" href="#postsCarousel" data-slide="next">&rsaquo;</a>
            </div>
        </div>
    </div>
    <div class="container p-t-0 m-t-2 carousel-inner">
        
            <?php
            for($b = 0; $b <count($searchSale_arr); $b++){
        {
          echo'   
                
          <div class="item col-md-4">
                <div class="card">
                    <div class="card-img-top card-img-top-250">
                        <img class="img-fluid" src='.$imgpath.$searchSale_arr[$a][1].' alt="Carousel 1">
                    </div>
                    <div class="card-block p-t-2">
                        <h6 class="small text-wide p-b-2">Insight</h6>
                        <h2>
                            <a href>Why Stuff Happens Every Year.</a>
                        </h2>
                    </div>
                </div>
            </div>;
         
            ';
                
            }
            
// <!-- loop item starts -->

            ?>
                 
    </div>
</section>

<script
$('a[data-slide="prev"]').click(function() {
  $('#postsCarousel').carousel('prev');
});

$('a[data-slide="next"]').click(function() {
  $('#postsCarousel').carousel('next');
});
$(document).ready(function () {
        $('#postsCarousel').find('item').first().addClass('active');
        });
        
</script>

<style>
.carousel-inner .row-equal.active.left { left: -33%; }
.carousel-inner .row-equal.next { left:  33%; }
.carousel-inner .row-equal.prev { left: -33%; }
.carousel-control.left,.carousel-control.right {background-image:none;}
.carousel-item:not(.prev) {visibility: visible;}
.carousel-item.right:not(.prev) {visibility: hidden;}
.rightest{ visibility: visible;}

/* equal card height */
.row-equal > div[class*='col-'] {
    display: flex;
    flex: 1 0 auto;
}

.row-equal .card {
   width: 100%;
}

/* ensure equal card height inside carousel */
.carousel-inner>.row-equal.active, 
.carousel-inner>.row-equal.next, 
.carousel-inner>.row-equal.prev {
    display: flex;
    
}

/* prevent flicker during transition */
.carousel-inner>.row-equal.active.left, 
.carousel-inner>.row-equal.active.right {
    opacity: 0.5;
    display: flex;
}


/* control image height */
.card-img-top-250 {
    max-height: 250px;
    overflow:hidden;
}
</style>