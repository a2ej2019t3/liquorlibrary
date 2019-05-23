<?php
include ('./database/DBsql.php');

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
        // merge cookie cart to DB if exists
        if (isset($_COOKIE['tempCart'])) {
            // get cookieCart as array
            $coockieCart = objectToArray(json_decode($_COOKIE['tempCart']));
            var_dump($coockieCart);
            // get DB cart as array
            $getItems_arr = $DBsql->getCartItems($cartID);
            var_dump($getItems_arr);

            // if cart is empty
            if ($getItems_arr === false) {
                $getItems_arr = array();
                foreach ($coockieCart as $key => $value) {
                    $res = $DBsql->insertItems('orderitems', $value);
                }
            // if cart is not empty
            } else {
                // get DB cart keys
                $DBCartKeys = array_keys($getItems_arr);
                var_dump($DBCartKeys);
                // loop through cookie cart
                foreach ($coockieCart as $key => $cartitem) {
                    // if the item from cookie cart already in db cart
                    if (in_array($key, $DBCartKeys)) {
                        var_dump($key);
                        // calculate new quantity
                        $getItems_arr[$key]['quantity'] = $getItems_arr[$key]['quantity'] + $cartitem['quantity'];
                        var_dump($getItems_arr[$key]['quantity']);
                        // update quantity in db
                        $res = $DBsql->updateCart($coockieCart[$key]['itemID'], $userID, $coockieCart[$key]['quantity']);
                    // if the item from cookie cart not in db cart
                    } else {
                        // add new item to db cart array
                        $getItems_arr[$key] = $cartitem;
                        var_dump($cartitem);
                        $res = $DBsql->insertItems('orderitems', $cartitem);
                    }
                }
                $_SESSION['cartItems'] = $coockieCart;
            }
        }
    
    // if user doesn't have status 0 cart
    } else {
        $cartID = $DBsql->insertOrder($userID);
        $_SESSION['cartID'] = $cartID;
        foreach ($coockieCart as $key => $cartitem) {
            $res = $DBsql->insertItems('orderitems', $cartitem);
        }
        $getItems_arr = $DBsql->getCartItems($cartID);
        $_SESSION['cartItems'] = $getItems_arr;
    }

// if user didn't logged in
} else {
    if (isset($_COOKIE['tempCart'])) {
        $cartArr = objectToArray(json_decode($_COOKIE['tempCart']));
        $_SESSION['cartItems'] = $cartArr;
    } else {
        $_SESSION['cartItems'] = array();
    }
}

// use this to convert object to array
function objectToArray($d) {
    if (is_object($d)) {
        $d = get_object_vars($d);
    }
    if (is_array($d)) {
        return array_map(__FUNCTION__, $d);
    } else {
        // Return array
        return $d;
    }
}