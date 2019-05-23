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
        // // merge cookie cart to DB if exists
        // if (isset($_COOKIE['tempCart'])) {
        //     $coockieCart = objectToArray(json_decode($_COOKIE['tempCart']));
        //     print_r($coockieCart);
        //     foreach ($coockieCart as $key => $value) {
        //         $result = $DBsql->insertItems('orderitems',$value);
        //     }
        // }

        $getItems_arr = $DBsql->getCartItems($cartID);
        if ($getItems_arr !== false) {
            unset($_SESSION['cartItems']);
            $_SESSION['cartItems'] = $getItems_arr;
            // print_r($_SESSION['cartItems']); #check the format of data got from DBsql.php
        }
    
    // if user doesn't have status 0 cart
    } else {
        $cartID = $DBsql->insertOrder($userID);
        $_SESSION['cartID'] = $cartID;
        // // insert cookie cart to DB if exists
        // if (isset($_COOKIE['tempCart'])) {
        //     $coockieCart = objectToArray(json_decode($_COOKIE['tempCart']));
        //     foreach ($coockieCart as $key => $value) {
        //         $result = $DBsql->insertItems('orderitems',$value);
        //     }
        // }
        $getItems_arr = $DBsql->getCartItems($cartID);
        $_SESSION['cartItems'] = $getItems_arr;
    }

// if user didn't logged in
} else {
    if (isset($_COOKIE['tempCart'])) {
        $cartArr = objectToArray(json_decode($_COOKIE['tempCart']));
        $_SESSION['cartItems'] = $cartArr;
    } else {
        $_SESSION['cartItems'] = "";
        echo '<script>alert("not logged in and no cookie set.");</script>';
    }
}

function objectToArray($d) {
    if (is_object($d)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $d = get_object_vars($d);
    }
    
    if (is_array($d)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return array_map(__FUNCTION__, $d);
    }
    else {
        // Return array
        return $d;
    }
}