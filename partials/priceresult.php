<?php
    session_start();
    $_SESSION['location'] = 'productlist';
    include_once ('../database/DBsql.php');
    $DBsql = new sql;

    $searchstart = $_GET['searchstart'];
    if ($searchend = $_GET['searchend']) {
        $searchPrice_arr = $DBsql->select($DBsql->getProductInfo(), array('spec' => 'discountprice >'.$searchstart, 'spec' => 'discountprice <'.$searchend));
    } else {
        $searchend = '';
        $searchPrice_arr = $DBsql->select($DBsql->getProductInfo(), array('spec' => 'discountprice >'.$searchstart));
    }
        // var_dump($searchPrice_arr);
        $resultcount = count($searchPrice_arr);
?>
<?php
        echo '
<section>
        <div class="container" style="padding-right: 45px;">
            
     <center><h4 style="margin-top: 100px;"><hr>Price :';echo '<span style="color:#8B0000; font-size: 1.2rem; font-weight:600; ">NZ$'.$searchstart.'~NZ$'.$searchend.'</span></h4></center>
     <div style="text-align:left;"><i class="far fa-compass" style="margin: 10px 10px;"></i><a style="color: black!important; text-decoration: none!important;" href="index.php">Home / </a> <span> Price / '.$resultcount.'products</span></div>';
         
          if ($searchPrice_arr != "") {
            $imgpath = 'images/';
    
            if (count($searchPrice_arr) != 0) { 
                echo '<div class="productcontent">
                <div class="product-grid product-grid--flexbox">
                    <div class="product-grid__wrapper">';

                for ($b = 0; $b <count($searchPrice_arr); $b++) {
                    echo '
                        
                         
                        <div class="product-grid__product col-sm-6 col-md-4 col-lg-3" style="text-align: center; font-family: Montserrat, sans-serif;">
                            <div class="product-grid__img-wrapper" style="height: 185px; text-algin:center; ">			
                                     <img src='.$imgpath.$searchPrice_arr[$b]['img'].' style="width: 120px; max-height: 170px;margin: 0 auto;">
                             </div><br>
                            <div class="product-grid__title" style="font-size: 1.2rem;font-weight: 600;"><span>'.$searchPrice_arr[$b]['productName'].'</span></div><br>
                             <div class="product-grid__price"><span style="font-size:1.4rem;">NZ$'.$searchPrice_arr[$b]['price'].'</span> <span style="text-decoration: line-through; color:rgba(48, 43, 41,1); font-size:1rem;"> $'.$searchPrice_arr[$b]['discountprice'].'</span></div>
                            
                                    <div class="product-grid__extend" style="width:100%;">
                                     <div class="row">
                                     <div class="col-sm-6 col-md-6" style="padding:0!important;><button value="'.$searchPrice_arr[$b]['productID'].'" onclick="addToCart(this.value)"><span class="product-grid__botton product-grid__add-to-cart"><i class="fa fa-cart-arrow-down"></i><br> Add to cart</span></button></div>
                                     <div class="col-sm-6 col-md-6" style="padding:0!important;"><a href="productlist.php?pid='.$searchPrice_arr[$b]['productID'].'"><span class="product-grid__botton product-grid__view"><i class="fa fa-eye"></i><br>View more</span></a></div>

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
            echo 'empty';
        }
echo '
</div>
</section>
';