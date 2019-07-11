<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'objectToArray.php');
    include_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
    $DBsql = new sql;

    $orderID = $_GET['oi'];
    $productID = $_GET['pi'];
    $optional = $_GET['opt'];
        if ($optional == 'all' && $orderID == 'loggedIn') {
            $orderID = $_SESSION['cartID'];
            $res = $DBsql->delete('orderitems', array('orderID'=>$orderID));
            echo true;
        } else if ($optional == 'all' && $orderID == 'guest') {
            setcookie('tempCart', "", time() - 3600, "/");
            echo true;
        } else if ($optional == 'spec' && $orderID == 'guest') {
            $coockieCart = objectToArray(json_decode($_COOKIE['tempCart']));
            unset($coockieCart[$productID]);
            setcookie('tempCart', json_encode($coockieCart), time() + (86400 * 30), '/');
            $_SESSION['cartItems'] = $coockieCart;
            echo true;
        } else if ($optional == 'spec' && $orderID != 'guest') {
            $res = $DBsql->delete('orderitems', array('orderID'=>$orderID, 'itemID'=>$productID));
            if ($res === true) {
                echo true;
                // var_dump($res);
            } else {
                echo false;
                // var_dump($res);
            }
        }
    // echo $optional;