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
        $getItems_arr = $DBsql->getCartItems($cartID);
        $_SESSION['cartItems'] = $getItems_arr;
    
    // if user doesn't have status 0 cart
    } else {
        $cartID = $DBsql->insertOrder($userID);
        $_SESSION['cartID'] = $cartID;
        $getItems_arr = $DBsql->getCartItems($cartID);
        $_SESSION['cartItems'] = $getItems_arr;
    }

// if user didn't logged in
} else {
    if (isset($_COOKIE[$cookieName])) {
        $cartArr = $_COOKIE[$cookieName];
        $_SESSION['cartItems'] = $cartArr;
    } else {
        echo '<script>alert("not logged in and no cookie set.");</script>';
    }
}