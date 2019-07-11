<?php
include ('database/DBsql.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$DBsql = new sql;
// get cart items with userID and status 0 'OK'
// $cartID = $DBsql->insertOrder(6);
// var_dump($cartID);
$getCart_arr = $DBsql->select('orders',array('buyerID' => 6, 'status' => '0'));

var_dump($getCart_arr);
