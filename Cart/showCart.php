<?php
include ('../database/DBsql.php');
session_start();
// get cart items with userID and status 0 'OK'
$DBsql = new sql;
// $getItems_arr = $DBsql->getCartItems($cartID);
if (isset($_SESSION['cartItems'])) {
    $getItems_arr = $_SESSION["cartItems"];
    foreach ($getItems_arr as $key => $value){
        $id = array('productID' => $key);
        $idArr = array_merge($idArr, $id);
    }
    $itemInfo_arr = $DBsql->select($DBsql->getProductInfo(), $idArr);
    $tagForCategory = 'Category: ';
    $tagForBrand = 'Brand: ';
    $imgpath = 'images/';
    if ($itemInfo_arr) {
        // print_r($itemInfo_arr);
        for ($a = 0; $a < count($itemInfo_arr); $a++) {
            // ob_clean();
            echo '
            <form method="post" class="row" action="productDetailPage.php">
                <input type="hidden" name="productid" value="'.$itemInfo_arr[$a]['productID'].'">
                <button class="dropdown-item" href="#" type="submit">
                    <div class="row">
                        <div id="posterarea" style="display:inline-block">
                            <img src='.$imgpath.$itemInfo_arr[$a]['img'].' style = "width: 35px; height:auto">
                        </div>
                        <div id="titlearea" style="display:inline-block; padding-left:5px;">
                            <p style="color:black">
                                <b>'.$itemInfo_arr[$a]['productName'].'</b><br>
                                <i>'.$tagForCategory.$itemInfo_arr[$a]['categoryName'].'</i><br>
                                <i>'.$tagForBrand.$itemInfo_arr[$a]['brandName'].'</i>
                            </p>
                        </div>
                    </div>
                </button>
            </form>
            ';
        }
    } else {
        $_SESSION['cartItemNum'] = 0;
        echo 'Your cart is empty!';
    }
} else {
    echo 'Your cart is empty! (No session found)';
}