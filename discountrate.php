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
                            <div class="product-grid__img-wrapper" style="min-height: 185px; text-algin:center; ">			
                                     <img src='.$imgpath.$searchDiscount_arr[$b][1].' style="width: 120px; max-height: 170px;margin: 0 auto;">
                                     <div class="offer-form">
                                    <div class="offer">offer</div>
                                    <ul class="promo-offers hidden-xs">
                                        <li>
                                            <a href="#" shape="rect" style-"font-size: 23px;">'.round($searchDiscount_arr[$b][9]).'%*</a>  </li>
                                    </ul>
                                </div>
                             </div><br>
                            <div class="product-grid__title" style="font-size: 1.2rem;font-weight: 600;"><span>'.$searchDiscount_arr[$b][2].'</span></div><br>';
                    echo   '<div class="product-grid__price"><span style="font-size:1.4rem;">NZ$'.$searchDiscount_arr[$b][3].'</span> <span style="text-decoration: line-through; color:rgba(48, 43, 41,1); font-size:1rem;"> $'.$searchDiscount_arr[$b][4].'</span></div>';
                            
                            
                            
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
.offer-form {
    position: absolute;
    top: 35px;
    right: 10px;
    z-index=1000;
}
.offer-form .offer {
    width: 52px;
    height: 52px;
    border-radius: 26px;
    -webkit-border-radius: 26px;
    border: 1.5px solid #E12726;
    color: #E12726;
    text-transform: uppercase;
    /* padding: 17px 0 0; */
    text-align: center;
    font-size: 14px;
    font-weight: 600;
    font-family: 'Playfair Display', serif;
    background: white;
    padding-top: 15px;
}

@media only screen and (min-width: 768px){
.offer-form .promo-offers {
    display: none;
}
}
.promo-offers {
    list-style-type: none;
    padding: 0;
    /* margin: 35px 0 31px 0; */
    color: #E12726;
    font-family: 'Playfair Display', serif;
    font-weight: 600;
    /* font-size: 18px; */
    text-transform: uppercase;
    border-top: solid 1px #E12726;
}

.promo-offers li {
    border-bottom: solid 1px #E12726;
    line-height: 1.15;
    padding: 21px 0 17px 0;
}
.promo-offers li:hover a {
    display: none;
}

.promo-offers li a {
    font-family: dinbold;
    font-size: 14px;
}
a {
    color: #E12726;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease;
    outline: 0 !important;
}


.promo-offers li {
	border-bottom: solid 1px #E12726;
	line-height: 1.15;
	padding: 21px 0 17px 0;
}

.promo-offers li:hover {
	padding-left: 25px;
	padding-right: 25px;
	background: #E12726;
}

.promo-offers li:hover a  {
	color: white;
	text-decoration: none;
	display: block!important;
	padding-right: 12px;
    
}


.hidden-xs {
  display: none;
}
.offer-form:hover .hidden-xs {
  display: block;
 
}
.offer-form:hover .offer {
  display: none;
}


     </style>