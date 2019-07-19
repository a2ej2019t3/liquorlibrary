<?php
    session_start();
    $_SESSION['location'] = 'productlist';
    include ('connection.php');
    // item search 

    $_SESSION['postId'] = $_GET['pid'];
    $searchcontent = $_SESSION['postId'];

    $searchItem_sql = "SELECT p.productID, p.img, p.productName, p.discountprice, p.price,p.categoryID, b.brandName, c.categoryName,c.categoryID FROM product AS p, brand AS b, category AS c WHERE p.brandID=b.brandID and p.categoryID=c.categoryID and  p.productID = $searchcontent";
    $searchItem_res = mysqli_query($connection, $searchItem_sql);
    
    if ($searchItem_res != "") {
        $searchItem_arr = mysqli_fetch_all($searchItem_res);
        $resultcount=count($searchItem_arr);
        
    } else {
        alert("result empty");
    }
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
<?php
include_once ("partials/head.php");
?>
 
<title>Product_listby search</title>
</head>
<body style="height: 110%;">
    <section>
    <?php
        include_once ("partials/header.php");
    ?>        
    </section>
    <br><br>
<?php
 include ("Cart/stickycart.php");
?>
<div class="container_fluid">
    <div class="row">
<!-- content body starts -->
        <div class="sidenavbar col-md-3 col-xs-12 content-left" style="text-align:center;">
            <!-- sideNave -->
                <?php
                    include_once ("partials/sideNav.php");
                ?>
        </div>

        <div class="productresult col-md-9 col-xs-12 content-right">
            <!-- product list results -->
               <article id="content">
               <section>
        <div class="container" style="padding-right: 45px;">
     <center><h4 style="margin-top: 100px;"><hr>Bottle Shop</h4></center>
     <?php
        echo '<div style="text-align:left;"><i class="far fa-compass" style="margin: 10px 10px;"></i><a style="color: black!important; text-decoration: none!important;" href="index.php">Home / </a> <span>Search result / '.$resultcount.' products</span></div>';
         
          if ($searchcontent != "") {
            $imgpath = 'images/';
            
            if (count($searchItem_arr) != 0) { 
                echo '<div class="productcontent">
                <div class="product-grid product-grid--flexbox">
                    <div class="product-grid__wrapper">';

                    $category= $searchItem_arr[$b][7];
                    $brandname= $searchItem_arr[$b][6];

                    echo '
                    
                         
                        <div class="product-grid__product col-sm-12 col-md-12 col-lg-12" style="text-align: center; font-family: Montserrat, sans-serif;">
                            <div class="product-grid__img-wrapper" style="height: 185px; text-algin:center; ">			
                                     <img src='.$imgpath.$searchItem_arr[$b][1].' style="width: 120px; max-height: 170px;margin: 0 auto;">
                             </div><br>
                            <div class="product-grid__title" style="font-size: 1.2rem;font-weight: 600;"><span>'.$searchItem_arr[$b][2].'</span></div><br>';
                            if($searchItem_arr[$b][3] !==null ){
                                echo      '<div class="product-grid__price"><span style="font-size:1.4rem;">NZ$'.$searchItem_arr[$b][3].'</span> <span style="text-decoration: line-through; color:rgba(48, 43, 41,1); font-size:1rem;"> $'.$searchItem_arr[$b][4].'</span></div>';
                            }
                            else {
                                echo      '<div class="product-grid__price"><span style="font-size:1.4rem;">NZ$'.$searchItem_arr[$b][4].'</span> </div>';

                            }
                            
                       echo         '<div class="product-grid__extend" style="width:100%;">
                                     <div class="row">
                                        <div class="col-sm-3 col-md-3" style="padding:0!important;"></div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="row">
                                                    <div class="col-sm-6 col-md-6" style="padding:0!important;">
                                                        <span class="product-grid__botton product-grid__add-to-cart" data-productID="'.$searchItem_arr[$b][0].'" onclick="addToCart(this)">
                                                            <i class="fa fa-cart-arrow-down"></i><br> Add to cart
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6" style="padding:0!important;">
                                                        <a href="productlist.php?pid='.$searchItem_arr[$b][0].'">
                                                            <span class="product-grid__botton product-grid__view">
                                                                <i class="fa fa-eye"></i><br>View more
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="col-sm-3 col-md-3" style="padding:0!important;"></div>

                                    </div>
                                </div>
                        </div>';
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
                </article>
        
        </div>

    </div>

</div>
<hr>

<!-- recomendation starts -->
<div class="container" style="margin-top: 100px;">
     <div class="suggestioncontainer" style=" margin: 5px auto; text-align: center; border-top: 1.5px solid rgba(244, 232, 117, 1); padding-top: 10px; width: 80%;">
            <span style="font-size:24px; font-weight: 600;"> We also suggest you... <br>
            <span style="font-size:18px; font-weight: 400;"> <?php echo''.$brandname.' has more selections of '.$category.'! '?></span> </span>
     </div>
     <?php

    // Suggestions search 


    $suggestItem_sql = "SELECT p.productID, p.img, p.productName, p.discountprice, p.price,p.categoryID, b.brandName, c.categoryName,c.categoryID FROM product AS p, brand AS b, category AS c WHERE p.brandID=b.brandID and p.categoryID=c.categoryID and  b.brandName = '$brandname' and c.categoryName= '$category'";
    $suggestItem_res = mysqli_query($connection, $suggestItem_sql);
    
    if ($suggestItem_res != "") {
        $suggestItem_arr = mysqli_fetch_all($suggestItem_res);
        $resultcount=count($suggestItem_arr);
        
    } else {
        alert("result empty");
    }
 ?>
    <section>
    <?php

                if (count($suggestItem_arr) != 0) { 
                    $imgpath = 'images/';
                    echo '<div class="productcontent">
                    <div class="product-grid product-grid--flexbox">
                        <div class="product-grid__wrapper">';
    
                    for ($b = 0; $b <count($suggestItem_arr); $b++) {
                        echo '
                            
                             
                            <div class="product-grid__product col-sm-6 col-md-4 col-lg-4" style="text-align: center; font-family: Montserrat, sans-serif;">
                                <div class="product-grid__img-wrapper" style="height: 185px; text-algin:center; ">			
                                         <img src='.$imgpath.$suggestItem_arr[$b][1].' style="width: 120px; max-height: 170px;margin: 0 auto;">
                                 </div><br>
                                <div class="product-grid__title" style="font-size: 1.2rem;font-weight: 600;"><span>'.$suggestItem_arr[$b][2].'</span></div><br>';
                                if($suggestItem_arr[$b][3] !==null ){
                                    echo      '<div class="product-grid__price"><span style="font-size:1.4rem;">NZ$'.$suggestItem_arr[$b][3].'</span> <span style="text-decoration: line-through; color:rgba(48, 43, 41,1); font-size:1rem;"> $'.$suggestItem_arr[$b][4].'</span></div>';
                                }
                                else {
                                    echo      '<div class="product-grid__price"><span style="font-size:1.4rem;">NZ$'.$suggestItem_arr[$b][4].'</span> </div>';
    
                                }
                                
                           echo         '<div class="product-grid__extend" style="width:100%;">
                                            <div class="row">
                                                    <div class="col-sm-6 col-md-6" style="padding:0!important;">
                                                        <span class="product-grid__botton product-grid__add-to-cart" data-productID="'.$searchItem_arr[$b][0].'" onclick="addToCart(this)">
                                                            <i class="fa fa-cart-arrow-down"></i><br> Add to cart
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6" style="padding:0!important;">
                                                        <a href="productlist.php?pid='.$searchItem_arr[$b][0].'">
                                                            <span class="product-grid__botton product-grid__view">
                                                                <i class="fa fa-eye"></i><br>View more
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                        </div>
                                  
                              
                            </div>';
                    
                    }
    
                 echo '</div>
                    </div>';
                } else {
                 echo '<br><center><span> No record : 0 Product <span></center><br><br><br> ';
                }
        

    ?>
    </section>

    
</div>


 <?php
    include_once ("partials/foot.php");
  ?>  
    <script type="text/javascript" src="js/sub.js"></script>
    <script type="text/javascript" src="js/cart.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/search.js"></script>
    <script type="text/javascript" src="js/pay.js"></script>
 </body>


 </html>