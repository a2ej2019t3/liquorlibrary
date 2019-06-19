<?php
  include(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
  include(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'objectToArray.php');

$DBsql = new sql();

if (isset($_SESSION['user'])) {
    $userID = $_SESSION['user']['userID'];

// GET STATUS 0 CART OF LOGIN USER 'OK'
    $getCart_arr = $DBsql->select('orders',array('buyerID' => $userID, 'status' => 0));
    // var_dump($getCart_arr);
    
    //if user has status 0 cart
    if ($getCart_arr) {
        // cartID
        $_SESSION['cartID'] = $getCart_arr[0]['orderID'];
        $cartID = $_SESSION['cartID'];
        // var_dump($cartID);
        
        // get DB cart as array
        $getItems_arr = $DBsql->getOrderInfo($cartID);
        // var_dump($getItems_arr);
        
        // merge cookie cart to DB if exists
        if (isset($_COOKIE['tempCart'])) {
            // convert cookieCart to array
            $coockieCart = objectToArray(json_decode($_COOKIE['tempCart']));
            
            // give DB cart id to cookie cart items
            foreach ($coockieCart as $key => $value) {
                $coockieCart[$key]['orderID'] = $cartID;
            }
            #var_dump($coockieCart);
            
            // if DBcart is empty, insert cookiecart into dbcart
            if ($getItems_arr === null) {
                $getItems_arr = array();
                foreach ($coockieCart as $key => $value) {
                    $res = $DBsql->insertItems('orderitems', $value);
                    #var_dump($res);
                    setcookie('tempCart', "", time() - 3600, "/");
                }
                $getItems_arr = $DBsql->getOrderInfo($cartID);
                $_SESSION['cartID'] = $getItems_arr;
                // echo 'DBcart is empty, insert cookiecart into dbcart';
            // if DBcart is not empty
            } else {
                // get DB cart keys
                $DBCartKeys = array_keys($getItems_arr);
                #var_dump($DBCartKeys);
                // loop through cookie cart
                foreach ($coockieCart as $key => $value) {
                    // if the item from cookie cart already in db cart
                    if (in_array($key, $DBCartKeys)) {
                        #var_dump($key);
                        // calculate new quantity and give it to DBcart var
                        // $getItems_arr[$key]['quantity'] = $getItems_arr[$key]['quantity'] + $value['quantity'];
                        #var_dump($getItems_arr[$key]['quantity']);
                        // update quantity in db using dbcart var
                        // $res = $DBsql->updateCart($getItems_arr[$key]['itemID'], $getItems_arr[$key]['orderID'], $getItems_arr[$key]['quantity']);
                    // if the item from cookie cart not in db cart
                    } else {
                        // add new item to db cart array
                        $getItems_arr[$key] = $value;
                        #var_dump($value);
                        $res = $DBsql->insertItems('orderitems', $value);
                    }
                }
                $getItems_arr = $DBsql->getOrderInfo($cartID);
                setcookie('tempCart', "", time() - 3600, "/");
                $_SESSION['cartItems'] = $getItems_arr;
                // echo 'DBcart is not empty, insert cookiecart into dbcart';
            }
        // cookie cart not exist
        } else {
            if ($getItems_arr === null) {
                $_SESSION['cartItems'] = array();
            } else {
                $_SESSION['cartItems'] = $getItems_arr;
            }
            // echo 'cookie cart is not exist';
        }
    
    // if user doesn't have status 0 cart, give user a dbcart and insert cookiecart into it 
    // !!! dont forget to give new dbcart id to items in cookie cart
    } else {
        $cartID = $DBsql->insertOrder($userID);
        // var_dump($cartID);
        $_SESSION['cartID'] = $cartID;
        if (isset($_COOKIE['tempCart'])) {
            foreach ($coockieCart as $key => $value) {
                $value['orderID'] = $cartID;
                $res = $DBsql->insertItems('orderitems', $value);
            }
            $getItems_arr = $DBsql->getOrderInfo($cartID);
            $_SESSION['cartItems'] = $getItems_arr;
        } else {
            $_SESSION['cartItems'] = array();
        }
        // echo 'user does not have status 0 cart';
    }

// if user didn't logged in
} else {
    unset($_SESSION['cartID']);
    if (isset($_COOKIE['tempCart'])) {
        $cartArr = objectToArray(json_decode($_COOKIE['tempCart']));
        $_SESSION['cartItems'] = $cartArr;
    } else {
        $_SESSION['cartItems'] = array();
    }
    // echo 'user did not logged in';
}

// echo var_dump($_SESSION);
// echo var_dump($_COOKIE);
