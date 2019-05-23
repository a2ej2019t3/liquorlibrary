
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
<!-- list sliders -->
<section>
    <div class="top-content">
        <div class="container">
            <div class="carousel slide" data-ride="carousel" id="postsCarousel">
            <span class="bottonbox">
                <a class="btn btn-outline-secondary prev" href="" title="go back"><i class="fa fa-lg fa-chevron-left"></i></a>
                <a class="btn btn-outline-secondary next" href="" title="more"><i class="fa fa-lg fa-chevron-right"></i></a>
            </span>
                <div class="carousel-inner row w-100 mx-auto" role="listbox"> 
                    <?php
                       for($b = 0; $b <count($searchSale_arr); $b++){
                        
                        echo '<div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3" style="border:none; border-bottom: 4px solid rgba(144, 180, 148, 1);">
                        <div class="imgwrap">
                       
                        <div class="hoverm">
                        <div class="dealhead">'.$searchSale_arr[$b][2].'</div>
                        <div class="dealhead">Only <span style="color: red;">$'.$searchSale_arr[$b][3].'<span></div>
                        <button class="Go" onClick="window.location=;">FIND MORE</button>
                  
                    
                      </div> 
                        <img src='.$imgpath.$searchSale_arr[$b][1].' class="img-fluid cardimage mx-auto d-block" alt="img1">
                       </div>
                    </div>'; 
            
                         }                 
                    ?>
                </div>

                <div class="specialcollection"style="margin-top: 80px;"><span>Grab a everyday selection just for you!</span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi voluptatum illum praesentium architecto quas corrupti suscipit quibusdam officiis odio, dolorem numquam dolores quasi sunt a earum! Non voluptates et ipsa?lorem. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perspiciatis eligendi aut tempore praesentium dicta! Vel, pariatur id architecto est expedita porro alias quo amet sed incidunt nulla accusamus odio iste!Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi voluptatum illum praesentium architecto quas corrupti suscipit quibusdam officiis odio, dolorem numquam dolores quasi sunt a earum! Non voluptates et ipsa?lorem. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perspiciatis eligendi aut tempore praesentium dicta! Vel, pariatur id architecto est expedita porro alias quo amet sed incidunt nulla accusamus odio iste!Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi voluptatum illum praesentium architecto quas corrupti suscipit quibusdam officiis odio, dolorem numquam dolores quasi sunt a earum!t consectetur adipisicing elit. Perspiciatis eligendi aut tempore praesentium dicta! Vel, pariatur id architecto est expedita poo iste!</div>
         </div>
    </div>
</section>
<script>


</script>
<?php
    include_once ("partials/foot.php");
  ?>  
  <script type="text/javascript" src="js/subcategory.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
  <script>
    $('.next').click(function(){ $('.carousel').carousel('next');return false; });
    $('.prev').click(function(){ $('.carousel').carousel('prev');return false; });

        $(document).ready(function () {
        $('#postsCarousel').find('.carousel-item').first().addClass('active');
        });

        $(document).ready(function() {
  jQuery.fn.carousel.Constructor.TRANSITION_DURATION = 2000  // 2 seconds
});
  </script>
<style>
.specialcollection{
    font-family: 'Josefin Sans', sans-serif;
    font-size: 1.3rem;
}

.Go {
  width: 150px;
  font-size:1.5rem;
  border: 1px solid white;
  color: white;
  background-color: transparent;
  transition: opacity .35s ease;
  font-family: 'Roboto', sans-serif;
}
.Go:hover{
    background-color: white;
    color: rgba(48, 43, 41,1);
}
.dealhead{
  color: white;
  font-family: 'Roboto', sans-serif;
  text-align:center;
  font-size:2rem;
}
.imgwrap:hover .hoverm {
  opacity: 1;
  background: rgba(0, 0, 0, .6);
}
.hoverm{
  position: absolute;
  width:300px;
  /* left:45%; */
  top: 30%;
  padding-top:10px;
  height: 160px;
  text-align: center;
  opacity: 0;
  transition: opacity .35s ease;
}
/*  */
.carousel-inner .carousel-item {
  transition: -webkit-transform 2s ease;
  transition: transform 2s ease;
  transition: transform 2s ease, -webkit-transform 2s ease;
}
.carousel-item > div[class*='col-'] {
    display: flex;
    flex: 1 0 auto;
}

.carousel-item .card {
   width: 100%;
}

/* ensure equal card height inside carousel */
.carousel-inner>.carousel-item.active, 
.carousel-inner>.carousel-item.next, 
.carousel-inner>.carousel-item.prev {
    display: flex;
}

/* prevent flicker during transition */
.carousel-inner>.carousel-item.active.left, 
.carousel-inner>.carousel-item.active.right {
    opacity: 0.5;
    display: flex;
}


/* control image height */
.cardimage {
    max-height: 250px;
    overflow:hidden;
}
.bottonbox {
    position: absolute;
    left: 40%;
    top: -50px;
    z-index: 100;
}
@media (min-width: 768px) and (max-width: 991px) {
    /* Show 4th slide on md if col-md-4*/
    .carousel-inner .active.col-md-4.carousel-item + .carousel-item + .carousel-item + .carousel-item {
        position: absolute;
        top: 0;
        right: -33.3333%;  /*change this with javascript in the future*/
        z-index: -1;
        display: block;
        visibility: visible;
    }
}
@media (min-width: 576px) and (max-width: 768px) {
    /* Show 3rd slide on sm if col-sm-6*/
    .carousel-inner .active.col-sm-6.carousel-item + .carousel-item + .carousel-item {
        position: absolute;
        top: 0;
        right: -50%;  /*change this with javascript in the future*/
        z-index: -1;
        display: block;
        visibility: visible;
    }
}
@media (min-width: 576px) {
    #postsCarousel .carousel-item {
        margin-right: 0;
    }
    /* show 2 items */
    #postsCarousel .carousel-inner .active + .carousel-item {
        display: block;
    }
    #postsCarousel .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left),
    #postsCarousel .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item {
        transition: none;
    }
    #postsCarousel > .carousel-inner .carousel-item-next {
        position: relative;
        transform: translate3d(0, 0, 0);
    }
    /* left or forward direction */
    #postsCarousel .active.carousel-item-left + .carousel-item-next.carousel-item-left,
    #postsCarousel .carousel-item-next.carousel-item-left + .carousel-item,
    #postsCarousel .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item {
        position: relative;
        transform: translate3d(-100%, 0, 0);
        visibility: visible;
    }
    /* farthest right hidden item must be also positioned for animations */
    #postsCarousel .carousel-inner .carousel-item-prev.carousel-item-right {
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
        display: block;
        visibility: visible;
    }
    /* right or prev direction */
    #postsCarousel .active.carousel-item-right + .carousel-item-prev.carousel-item-right,
    #postsCarousel .carousel-item-prev.carousel-item-right + .carousel-item,
    #postsCarousel .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item {
        position: relative;
        transform: translate3d(100%, 0, 0);
        visibility: visible;
        display: block;
        visibility: visible;
    }
}
/* MD */
@media (min-width: 768px) {
    /* show 3rd of 3 item slide */
    #postsCarousel .carousel-inner .active + .carousel-item + .carousel-item {
        display: block;
    }
    #postsCarousel .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item + .carousel-item {
        transition: none;
    }
    #postsCarousel .carousel-inner .carousel-item-next {
        position: relative;
        transform: translate3d(0, 0, 0);
    }
    /* left or forward direction */
    #postsCarousel .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item + .carousel-item {
        position: relative;
        transform: translate3d(-100%, 0, 0);
        visibility: visible;
    }
    /* right or prev direction */
    #postsCarousel .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item + .carousel-item {
        position: relative;
        transform: translate3d(100%, 0, 0);
        visibility: visible;
        display: block;
        visibility: visible;
    }
}
/* LG */
@media (min-width: 991px) {
    /* show 4th item */
    #postsCarousel .carousel-inner .active + .carousel-item + .carousel-item + .carousel-item {
        display: block;
    }
    #postsCarousel .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item + .carousel-item + .carousel-item {
        transition: none;
    }
    /* Show 5th slide on lg if col-lg-3 */
    #postsCarousel .carousel-inner .active.col-lg-3.carousel-item + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
        position: absolute;
        top: 0;
        right: -25%;  /*change this with javascript in the future*/
        z-index: -1;
        display: block;
        visibility: visible;
    }
    /* left or forward direction */
    #postsCarousel .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
        position: relative;
        transform: translate3d(-100%, 0, 0);
        visibility: visible;
    }
    /* right or prev direction //t - previous slide direction last item animation fix */
    #postsCarousel .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
        position: relative;
        transform: translate3d(100%, 0, 0);
        visibility: visible;
        display: block;
        visibility: visible;
    }
}
</style>
