<?php
    include ('../connection.php');
    include ('../database/DBsql.php');

    $DBsql = new sql();

    if (isset($_SESSION['user'])) {
        $userID = $_SESSION['user']['userID'];

    // GET STATUS 0 CART OF LOGIN USER 'OK'
        $getCart_arr = $DBsql->select('orders',array('buyerID' => $userID, 'status' => 0));
        
        //if user has status 0 cart
        if ($getCart_arr) {
            // cartID
            $_SESSION['cartID'] = $getCart_arr['orderID'];
            $cartID = $_SESSION['cartID'];
        
        // if user doesn't have status 0 cart
        } else {
            $cartID = $DBsql->insertOrder($userID);
            $_SESSION['cartID'] = $cartID;
        }

    // get cart items with userID and status 0 'OK'
        $getItems_arr = $DBsql->getCartItems($cartID);
        $tagForCategory = 'Category: ';
        $tagForBrand = 'Brand: ';
        $imgpath = 'images/';
        if ($getItems_arr) {
            // print_r($getItems_arr);
            for ($a = 0; $a < count($getItems_arr); $a++) {
                // ob_clean();
                echo '
                <form method="post" class="row" action="productDetailPage.php">
                    <input type="hidden" name="productid" value="'.$getItems_arr[$a]['productID'].'">
                    <button class="dropdown-item" href="#" type="submit">
                        <div class="row">
                            <div id="posterarea" style="display:inline-block">
                                <img src='.$imgpath.$getItems_arr[$a]['img'].' style = "width: 35px; height:auto">
                            </div>
                            <div id="titlearea" style="display:inline-block; padding-left:5px;">
                                <p style="color:black">
                                <b>'.$getItems_arr[$a]['productName'].'</b><br>
                                <i>'.$tagForCategory.$getItems_arr[$a]['categoryName'].'</i><br>
                                <i>'.$tagForBrand.$getItems_arr[$a]['brandName'].'</i>
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
        echo '
            <span>You need to login first</span>
        ';
    }
    ?>