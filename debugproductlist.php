<?php
include(__DIR__ . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
$DBsql = new sql;

$product_arr = $DBsql->select($DBsql->getProductInfo(), array('productID' => 10019));
var_dump($product_arr);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <?php
    include_once("./partials/head.php");
    ?>
    <link rel="stylesheet" href="css/displayproduct.css">
</head>

<body>
    <div class="row">
        <div class="col-3">
            <?php
            $imgpath = 'images/';

            if (count($product_arr) != 0) {
                echo '
            <div class="productcontent">';
                // loop through all products
                for ($b = 0; $b < count($product_arr); $b++) {
                    echo '
                        <div style="border: 1px solid black">
                            <div style="border: 1px solid black">';

                    echo '
                                <img src=' . $imgpath . $product_arr[$b]['img'] . ' style="width: auto; max-height: 400px;">';

                    echo '
                            </div>';
                    // format discount price if there is discount price
                    if ($product_arr[$b]['discountprice'] !== null) {
                        echo '
                            <div class="product-grid__price">
                                <span style="font-size:1.4rem;">NZ$' . $product_arr[$b]['discountprice'] . '</span> <span style="text-decoration: line-through; color:rgba(48, 43, 41,1); font-size:1rem;"> $' . $product_arr[$b]['price'] . '</span>
                            </div>';
                        // just show original price if there isn't a discount price
                    } else {
                        echo '
                            <div class="product-grid__price">
                                <span style="font-size:1.4rem;">NZ$' . $product_arr[$b]['price'] . '</span> 
                            </div>';
                    }
                    echo '
                            <div class="product-grid__extend" style="width:100%; padding-bottom: 2px;">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6" style="padding:0!important;">
                                        <span class="product-grid__botton product-grid__add-to-cart" data-productID="' . $product_arr[$b]['productID'] . '" onclick="addToCart(this)">
                                            <i class="fa fa-cart-arrow-down"></i><br> Add to cart
                                        </span>
                                    </div>
                                    <div class="col-sm-6 col-md-6" style="padding:0!important;">
                                        <a href="productlist.php?pid=' . $product_arr[$b]['productID'] . '">
                                            <span class="product-grid__botton product-grid__view">
                                                <i class="fa fa-eye"></i><br>View more
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
                echo '
            </div>
                ';
            }
            ?>
        </div>
        <div class="col-9">
            <div class="row">
                <?php
                    echo ' 
                    <h3 font-family: Montserrat, sans-serif;>'.$product_arr[0]['productName'].'</h3>'
                ?>
            </div>
            <?php
            // add discount number effect if discount rate greater than 20
            if ($product_arr[0]['discountRate'] > 20) {
                echo '
                    <div class="offer-form">                             
                        <img src="images/specials.png" class="ribbon" style="width:75px; height: 60px; position:absolute; top: 0; left:0;">
                        <button type="button" data-hover="' . round($product_arr[0]['discountRate']) . '%" class="discountbutton" data-active="ACTIVE"><span style="margin-left: -2px;">OFFER</span></button>
                    </div>';
                echo '
                    <div class="adminbuttons" id="adminbtsgroup">
                        <button type="button" value=' . $product_arr[0]['productID'] . ' class="customebts btn btn-secondary btn-sm" onclick="openSpecialModal(this.value)" style="color: rgba(48, 43, 41,1); background-color: transparent; border:none;">
                            <i class="fas fa-thumbtack"></i>
                                Specials
                        </button>
                    </div>';
            }
            ?>
        </div>
    </div>
    <?php
    include_once("partials/foot.php");
    ?>
</body>

</html>