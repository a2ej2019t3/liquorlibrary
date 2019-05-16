<?php
    // session_start();
    $_SESSION['location'] = 'productlist';
    include_once ('connection.php');
    // Sale product search 

    $searchDiscount_sql = "SELECT p.productID, p.img, p.productName, p.discountprice, p.price,p.categoryID, b.brandName, c.categoryName,c.categoryID,  COALESCE((100-p.discountprice) * p.price / 100, 0) AS salepercentage FROM product AS p, brand AS b, category AS c WHERE p.brandID=b.brandID and p.categoryID=c.categoryID and p.discountprice is not null ORDER BY salepercentage DESC;";
    $searchDiscount_res = mysqli_query($connection, $searchDiscount_sql);
    
    if ($searchDiscount_res != "") {
        $searchDiscount_arr = mysqli_fetch_all($searchDiscount_res);
        $resultcount=count($searchDiscount_arr);
    } else {
        alert("result empty");
    }
 ?>
<section>
        <div class="container" style="padding-right: 45px;">
     <?php
        echo '<div style="text-align:left;"><i class="far fa-compass" style="margin: 10px 10px;"></i><a style="color: black!important; text-decoration: none!important;" href="index.php">Home / </a> <span> Sale Products / Discount Rate / '.$resultcount.' products</span></div>';
         
          if ($resultcount != "") {
            $imgpath = 'images/';
    
            if (count($searchDiscount_arr) != 0) { 
                echo '<div class="productcontent">
                <div class="product-grid product-grid--flexbox">
                    <div class="product-grid__wrapper">';

                for ($b = 0; $b <count($searchDiscount_arr); $b++) {
                    echo '
                        
                         
                        <div class="product-grid__product col-sm-6 col-md-4 col-lg-3" style="text-align: center; font-family: Montserrat, sans-serif;">
                            <div class="product-grid__img-wrapper" style="height: 185px; text-algin:center; ">';		
                                     if($searchDiscount_arr[$b][9]>20){
                                        echo '<img src="images/specials.png" class="ribbon" style="width:75px; height: 60px; position:absolute; top: 0; left:0;">';
                                     }
                                     else{

                                     }
                            echo '<img src='.$imgpath.$searchDiscount_arr[$b][1].' style="width: 120px; max-height: 170px;margin: 0 auto;">
                                     <div class="offer-form">                             
                                        <button type="button" data-hover="'.round($searchDiscount_arr[$b][9]).'%" class="discountbutton" data-active="ACTIVE"><span style="margin-left: -2px;">OFFER</span></button>
                                        </div>
                             </div><br>
                            <div class="product-grid__title" style="font-size: 1.2rem;font-weight: 600;"><span>'.$searchDiscount_arr[$b][2].'</span></div><br>';
            
                    if($searchDiscount_arr[$b][3] !==null ){
                        echo      '<div class="product-grid__price"><span style="font-size:1.4rem;">NZ$'.$searchDiscount_arr[$b][3].'</span> <span style="text-decoration: line-through; color:rgba(48, 43, 41,1); font-size:1rem;"> $'.$searchDiscount_arr[$b][4].'</span></div>';
                    }
                    else {
                        echo      '<div class="product-grid__price"><span style="font-size:1.4rem;">NZ$'.$searchDiscount_arr[$b][4].'</span> </div>';

                    }
                            
                            
                       echo         '<div class="product-grid__extend" style="width:100%;">
                                     <div class="row">
                                        <div class="col-sm-6 col-md-6" style="padding:0!important;"><span class="product-grid__botton product-grid__add-to-cart"><i class="fa fa-cart-arrow-down"></i><br> Add to cart</span></div>
                                        <div class="col-sm-6 col-md-6" style="padding:0!important;"><span class="product-grid__botton product-grid__view"><i class="fa fa-eye"></i><br>View more</span></div>

                                    </div>
                                    </div>
                              
                          
                        </div>';
                
                }

             echo '</div>
                </div>';
            } else {
              
            }
    
        } else {
            ob_clean();
            echo 0;
        }
     ?>
        </div>
     </section>
     <style>


/* ------------------------------------------------------------------------------------------------- */
/* .button */
.offer-form{
    width: 70px;
    height: 70px;
}
.discountbutton {
    position: absolute;
    top: 5px;
    right: 0px;
    z-index: 10;
    text-decoration: none;
    font-size: 1em;
    outline: none;
    color:  #8B0000;
    border:none;
    background: transparent;
    font-family: 'Playfair Display', serif;
    font-weight: 600;
    border-radius: 200px;
    border:1px solid #8B0000;
    height: 58px;
    width: 58px;
    margin-right:5px;
}

.discountbutton span {
    -webkit-transition: 0.6s;
    -moz-transition: 0.6s;
    -o-transition: 0.6s;
    transition: 0.6s;
    -webkit-transition-delay: 0.2s;
    -moz-transition-delay: 0.2s;
    -o-transition-delay: 0.2s;
    transition-delay: 0.2s;
}

.discountbutton:before,
.discountbutton:after {
    position: absolute;
    top: 5px;
    right: 4px;
    z-index: 10;
    opacity: 0;
    color:  #8B0000;
    border:none;
    text-decoration: none;
    font-size: 1.8em;
    -webkit-transition: .4s,opacity .6s;
    -moz-transition: .4s,opacity .6s;
    -o-transition: .4s,opacity .6s;
    transition: .4s,opacity .6s;
}

/* :before */

.discountbutton:before {
    content: attr(data-hover);
    -webkit-transform: translate(-150%,0);
    -moz-transform: translate(-150%,0);
    -ms-transform: translate(-150%,0);
    -o-transform: translate(-150%,0);
    transform: translate(-150%,0);
}

/* :after */

.discountbutton:after {
    content: attr(data-active);
    -webkit-transform: translate(150%,0);
    -moz-transform: translate(150%,0);
    -ms-transform: translate(150%,0);
    -o-transform: translate(150%,0);
    transform: translate(150%,0);
}

/* Span on :hover and :active */

.discountbutton:hover span,
.discountbutton:active span {
    
    opacity: 0;
    -webkit-transform: scale(0.3);
    -moz-transform: scale(0.3);
    -ms-transform: scale(0.3);
    -o-transform: scale(0.3);
    transform: scale(0.3);
}

/*  
    We show :before pseudo-element on :hover 
    and :after pseudo-element on :active 
*/

.discountbutton:hover:before,
.discountbutton:active:after {
    opacity: 1;
    -webkit-transform: translate(0,0);
    -moz-transform: translate(0,0);
    -ms-transform: translate(0,0);
    -o-transform: translate(0,0);
    transform: translate(0,0);
    -webkit-transition-delay: .4s;
    -moz-transition-delay: .4s;
    -o-transition-delay: .4s;
    transition-delay: .4s;
}

/* 
  We hide :before pseudo-element on :active
*/

.discountbutton:active:before {
    -webkit-transform: translate(-150%,0);
    -moz-transform: translate(-150%,0);
    -ms-transform: translate(-150%,0);
    -o-transform: translate(-150%,0);
    transform: translate(-150%,0);
    -webkit-transition-delay: 0s;
    -moz-transition-delay: 0s;
    -o-transition-delay: 0s;
    transition-delay: 0s;
}
     </style>