<?php
include ('../database/DBsql.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// get cart items with userID and status 0 'OK'
$DBsql = new sql;
// $getItems_arr = $DBsql->getCartItems($cartID);
if (isset($_SESSION['cartItems'])) {
    $getItems_arr = $_SESSION['cartItems'];
    // print_r($getItems_arr);
    $tagForCategory = 'Category: ';
    $tagForBrand = 'Brand: ';
    $imgpath = 'images/';
    if ($getItems_arr != array()) {
        foreach ($getItems_arr as $key => $value) {
            $idArr = array('productID' => $key);
            $itemInfo_arr = $DBsql->select($DBsql->getProductInfo(), $idArr);
            if ($itemInfo_arr !== false) {
                // print_r($itemInfo_arr);
                // ob_clean();
                // <form method="post" class="row" action="productDetailPage.php">
                echo '
                <a href="" class="dropdown-item" style="width: 100%; margin: 0;">
                    <div class="row">
                        <div id="posterarea" style="display:inline-block">
                            <img src='.$imgpath.$itemInfo_arr['img'].' style = "width: 35px; height:auto">
                        </div>
                        <div id="titlearea" style="display:inline-block; padding-left:5px;">
                            <p style="color:black">
                                <b>'.$itemInfo_arr['productName'].'</b><br>
                                <i>'.$tagForCategory.$itemInfo_arr['categoryName'].'</i><br>
                                <i>'.$tagForBrand.$itemInfo_arr['brandName'].'</i>
                            </p>
                        </div>
                    </div>
                </a>
                    ';
                // </form>
            }
        }
    } else {
        $_SESSION['cartItemNum'] = 0;
        echo 'Your cart is empty!';
    }
} else {
    $_SESSION['cartItemNum'] = 0;
    echo 'Your cart is empty! (No session found)';
}