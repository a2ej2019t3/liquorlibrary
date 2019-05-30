<!-- 
p.productID, 
p.img, 
p.productName, 
p.discountprice, 
p.price,
p.categoryID, 
b.brandName, 
c.categoryName,
c.categoryID  -->
<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }

    include(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'liquorlibrary' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
    $DBsql = new sql;

    // category search 
    $searchcategoryID = $_GET['searchcategoryID'];
    $searchcategoryName = $_GET['searchcategoryName'];

    $searchcontent = $searchcategoryID;
    // var_dump($searchcontent);
    $category= $searchcategoryName;
    $searchCategory_arr = $DBsql->select($DBsql->getProductInfo(), array('categoryID' => $searchcontent));
    $resultcount = count($searchCategory_arr);

    echo '
<section>
    <div class="container" style="padding-right: 45px;">
        <center><h4 style="margin-top: 100px;"><hr>Bottle Shop</h4></center>
        <div style="text-align:left;"><i class="far fa-compass" style="margin: 10px 10px;"></i><a style="color: black!important; text-decoration: none!important;" href="index.php">Home / </a> <span>Category / '.$category.' / '.$resultcount.'products</span>
        </div>';
         
        if ($searchcontent != "") {
            $imgpath = 'images/';
    
            if (count($searchCategory_arr) != 0) { 
                echo '
                <div class="productcontent">
                    <div class="product-grid product-grid--flexbox">
                        <div class="product-grid__wrapper">';
                for ($b = 0; $b <count($searchCategory_arr); $b++) {
                echo '
                            <div class="product-grid__product col-sm-6 col-md-4 col-lg-3" style="text-align: center; font-family: Montserrat, sans-serif;">
                                <div class="product-grid__img-wrapper" style="height: 185px; text-algin:center; ">			
                                    <img src='.$imgpath.$searchCategory_arr[$b]['img'].' style="width: 120px; max-height: 170px;margin: 0 auto;">
                                </div>
                                <br>
                                <div class="product-grid__title" style="font-size: 1.2rem;font-weight: 600;"><span>'.$searchCategory_arr[$b]['productName'].'</span>
                                </div>
                                <br>';
                    if($searchCategory_arr[$b]['discountprice'] !== null ){
                echo '
                                <div class="product-grid__price"><span style="font-size:1.4rem;">NZ$'.$searchCategory_arr[$b]['discountprice'].'</span> <span style="text-decoration: line-through; color:rgba(48, 43, 41,1); font-size:1rem;"> $'.$searchCategory_arr[$b]['price'].'</span>
                                </div>';
                    } else {
                echo '
                                <div class="product-grid__price"><span style="font-size:1.4rem;">NZ$'.$searchCategory_arr[$b]['price'].'</span>
                                </div>';
                    }
                echo '
                                <div class="product-grid__extend" style="width:100%;">
                                    <div class="row">
                                        <button value="'.$searchCategory_arr[$b]['productID'].'" onclick="addToCart(this.value)"><div class="col-sm-6 col-md-6" style="padding:0!important;"><span class="product-grid__botton product-grid__add-to-cart"><i class="fa fa-cart-arrow-down"></i><br> Add to cart</span></div></button>
                                        <div class="col-sm-6 col-md-6" style="padding:0!important;"><a href="productlist.php?pid='.$searchCategory_arr[$b]['productID'].'"><span class="product-grid__botton product-grid__view"><i class="fa fa-eye"></i><br>View more</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
                echo '
                        </div>
                    </div>';
            } else {
                echo '
                </div>
            </div>
        </div>';
            }
        } else {
            ob_clean();
            echo 0;
        }
        echo '
    </div>
</section>
        ';
?>