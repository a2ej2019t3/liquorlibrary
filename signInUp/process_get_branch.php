<?php
require_once '../connection.php';
session_start();
//This script will get a selected users details.

//Get the values from the form

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];


$selectQuery = "select * from users where email='" . $email . "' and typeID=1";


if ($result = mysqli_query($connection, $selectQuery)) {

    $result_arr = mysqli_fetch_assoc($result);
    // print_r($result_arr);

    // 0 = wrong password; 1 = email not found 3 = OK
    if ($email == $result_arr['email']) {
        if ($password == $result_arr['password']) {
            $_SESSION['user'] = $result_arr;
                $userID=$_SESSION['user']['userID'];
                $selectQuery2 = "SELECT s.whID, s.userID,w.whID, w.typeID, w.whName, w.address, w.phone FROM staff AS s, warehouse AS w where '$userID'=s.userID and s.whID=w.whID";
                if ($result2 = mysqli_query($connection, $selectQuery2)){
                    $result_arr2 = mysqli_fetch_assoc($result2);
                    $_SESSION['warehouse'] = $result_arr2;
                }
                else{
                    echo 'query error';
                }
              
            // print_r($_SESSION['user']);
            echo 3;
        } else {
            echo 0;
        }
    } else {
        echo 1;
    }
}