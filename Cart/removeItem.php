<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
    $DBsql = new sql;

    $orderID = $_GET['oi'];
    $productID = $_GET['pi'];
    $optional = $_GET['opt'];
    if ($optional == 'all') {
        $orderID = $_SESSION['cartID'];
        $res = $DBsql->delete('orderitems', array('orderID'=>$orderID));
        echo true;
    } else if ($optional === null && $orderID !== null && $productID !== null) {
        $res = $DBsql->delete('orderitems', array('orderID'=>$orderID, 'itemID'=>$productID));
        if ($res === true) {
            echo true;
            // var_dump($res);
        } else {
            echo false;
            // var_dump($res);
        }
    }