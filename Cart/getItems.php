<?php
    session_start();
    if (isset($_SESSION['user'])) {
        $userID = $_SESSION['user']['userID'];
        // $userID = 1;
        include ('../connection.php');

    // GET STATUS 0 CART OF LOGIN USER
        $getCart_sql = "SELECT * FROM orders WHERE buyerID = $userID and status = 0";
        $getCart_res = mysqli_query($connection, $getCart_sql);
        $getCart_arr = mysqli_fetch_assoc($getCart_res);
        // cartID
        $_SESSION['cartID'] = $getCart_arr['orderID'];
        $cartID = $_SESSION['cartID'];

    // get cart items with userID and status 0
        $getItems_sql = "SELECT * FROM (SELECT product.productID, product.productName, product.price, product.discountprice, product.img, brand.brandName, category.categoryName FROM product 
                        LEFT JOIN brand ON product.brandID = brand.brandID
                        LEFT JOIN category ON product.categoryID = category.categoryID ) AS allproduct RIGHT JOIN orderitems ON allproduct.productID = orderitems.itemID WHERE orderID = $cartID";
        $getItems_res = mysqli_query($connection, $getItems_sql);
        if ($getItems_res) {
            $getItems_arr = mysqli_fetch_all($getItems_res);
            $_SESSION['cartItemNum'] = count($getItems_arr);
        } else {
            $_SESSION['cartItemNum'] = 0;
        }
    
        $tagForCategory = 'Category: ';
        $tagForBrand = 'Brand: ';
        $imgpath = 'images/';
        for ($a = 0; $a < count($getItems_arr); $a++) {
            // ob_clean();
            echo '
            <form method="post" class="row" action="productDetailPage.php">
                <input type="hidden" name="productid" value="'.$getItems_arr[$a][0].'">
                <button class="dropdown-item" href="#" type="submit">
                    <div class="row">
                        <div id="posterarea" style="display:inline-block">
                            <img src='.$imgpath.$getItems_arr[$a][4].' style = "width: 35px; height:auto">
                        </div>
                        <div id="titlearea" style="display:inline-block; padding-left:5px;">
                            <p style="color:black">
                            <b>'.$getItems_arr[$a][1].'</b><br>
                            <i>'.$tagForCategory.$getItems_arr[$a][6].'</i><br>
                            <i>'.$tagForBrand.$getItems_arr[$a][5].'</i>
                            </p>
                        </div>
                    </div>
                </button>
            </form>
            ';
        }
    } else {
        echo '
            <span>You need to login first</span>
        ';
    }
    ?>