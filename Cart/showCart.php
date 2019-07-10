<?php
include ('../database/DBsql.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// get cart items with userID and status 0 'OK'
$DBsql = new sql;
if (isset($_SESSION['cartItems'])) {
    $res = $_SESSION['cartItems'];
    // var_dump($res);
    $tagForCategory = 'Category: ';
    $tagForBrand = 'Brand: ';
    $tagForPrice = 'Price: ';
    $imgpath = 'images/';
    if ($res != array()) {
    // var_dump($getItems_arr);
        foreach ($res as $productID => $getItems_arr) {
            if (isset($_SESSION['user'])) {
                $idArr = array(
                    'orderID' => $getItems_arr['orderID'],
                    'productID' => $getItems_arr['productID']
                    );
                $idJson = json_encode($idArr);
            } else {
                $idArr = array(
                    'orderID' => 'guest',
                    'productID' => $getItems_arr['productID']
                    );
                $idJson = json_encode($idArr);
            }
            echo '
            <div class="row" style="width: 100%; margin:0;">
                <div class="container" style="left:0;">
                    <div class="row">
                        <div class="col">
                            <div class="row" style="min-height:80px;">

                                <div id="posterarea" class="col" 
                                style="max-width: 50px;
                                min-width: 25px;
                                padding: 0 0 0 10px !important;
                                margin: auto;
                                text-align: center;">
                                    <img class="img-fluid" src='.$imgpath.$getItems_arr['img'].' style = "max-height:70px;">
                                </div>

                                <div id="titlearea" class="col" style="padding:0 0 0 5px; margin:auto;">
                                    <p style="color:black; text-align:left; margin:0;">
                                        <b>'.$getItems_arr['productName'].'</b><br>
                                        <a href="../categorysearch.php?searchcategoryID='.$getItems_arr['categoryID'].'&searchcategoryName='.$getItems_arr['categoryName'].'&location=category"><i style="font-size">'.$tagForCategory.$getItems_arr['categoryName'].'</i></a><br>
                                        <a href="../categorysearch.php?brandname='.$getItems_arr['brandName'].'&location=brandproduct"><i>'.$tagForBrand.$getItems_arr['brandName'].'</i></a>
                                    </p>
                                </div>

                            </div>
                        </div>
                        <div class="col" style="padding:0;">
                            <div class="row my-auto" style="min-height:100%;">

                                <div id="quantityCol" class="col-7 my-auto" style="margin-top:15px;">
                                    <table>
                                        <thead>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <span id="total['.$getItems_arr['productID'].']" value="'.$getItems_arr['totalprice'].'" class="asdfa" style="font-size:1rem; margin-top:15px;">NZ$'.$getItems_arr['totalprice'].'</span>
                                            </tr>
                                            <tr>
                                                <div id="quantityField" class="input-group mx-auto" style="max-width:100px;">';
                                                // var_dump($getItems_arr['discountprice']);
                                                if ($getItems_arr['discountprice'] !== null) {
                                                    echo'
                                                    <input type="hidden" id="ticket_price['.$getItems_arr['productID'].']" data-value="'.$getItems_arr['discountprice'].'">';
                                                } else {
                                                    echo'
                                                    <input type="hidden" id="ticket_price['.$getItems_arr['productID'].']" data-value="'.$getItems_arr['price'].'">';
                                                }
            echo '
                                                    <input id="quantity['.$getItems_arr['productID'].']" type="number" value="'.$getItems_arr['quantity'].'" onchange="quantityCtrl('.$getItems_arr['productID'].', this)" class="form-control cart-item-quantity-display" 
                                                    style="padding: 0;
                                                    text-align: center;
                                                    height: 20px;
                                                    font-size: 0.7rem;">
                                                    <div class="input-group-append" id="quantityCtrl">';
            if (isset($_SESSION['user'])) {
                echo '
                                                            <button class="operation btn btn-sm btn-outline-secondary" data-operation="d" data-orderid='.$getItems_arr['orderID'].' type="button" onclick="quantityCtrl('.$getItems_arr['productID'].', this)">-</button>
                                                            <button class="operation btn btn-sm btn-outline-secondary" data-operation="i" data-orderid='.$getItems_arr['orderID'].' type="button" onclick="quantityCtrl('.$getItems_arr['productID'].', this)">+</button>';
            } else {
                echo '
                                                            <button class="operation btn btn-sm btn-outline-secondary" data-operation="d" data-orderid="Na" type="button" onclick="quantityCtrl('.$getItems_arr['productID'].', this)">-</button>
                                                            <button class="operation btn btn-sm btn-outline-secondary" data-operation="i" data-orderid="Na" type="button" onclick="quantityCtrl('.$getItems_arr['productID'].', this)">+</button>';
            }
            echo '
                                                    </div>
                                                </div>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div id="removeCol" class="col-5">
                                    <button id="cart-item-remove" class="btn btn-sm btn-outline-danger" value='.$idJson.' type="button" onclick="removeItem(this.value)">remove</button> 
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="margin:0;">';
        }
        // </form>
    } else {
        $_SESSION['cartItemNum'] = 0;
        echo '<div style="margin: 40px auto;">Your cart is empty! </div>';
    }
} else {
    $_SESSION['cartItemNum'] = 0;
    echo 'Your cart is empty! (No session found)';
}

echo'
    <style>
        a {
            font-size: 0.8rem;
            text-decoration: none;
            color: grey;
        }
        a:hover {
            text-decoration: none;
            color: black;
        }
        b {
            font-size:0.9rem;
        }
        th {
            font-size:0.8rem;
        }

        .items:hover {
            background:grey;
        }

        ::-webkit-scrollbar {
            width:5px;
        }
        ::-webkit-scrollbar-track {
            background:white;
        }
        ::-webkit-scrollbar-thumb {
            background:grey;
            border-radius:1px;
        }
        #cart-item-remove {
            width: 55px;
            /* height: 30px; */
            padding: 6px 0px;
            border-radius: 15px;
            text-align: center;
            font-size: 12px;
            line-height: 1.42857;
            margin-top: 20px;
        }

        #quantityField button {
            height: 20px !important;
            width: 20px !important;
            line-height: 0;
            padding: 0;
        }

        input[type="number"] {
            -webkit-appearance: textfield;
            -moz-appearance: textfield;
            appearance: textfield;
        }
          
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }

        .dropdown-item:active {
            background:none;
        }
          

    </style>
';