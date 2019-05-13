<?php
require_once '../connection.php';
session_start();
//This script will get a selected users details.

//Get the values from the form

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];

// print_r($email);
// print_r($password);

// $email = 'junboz598@gmail.com';
// $password = 123;

$selectQuery = "select * from users where email='" . $email . "'";


if ($result = mysqli_query($connection, $selectQuery)) {

    $result_arr = mysqli_fetch_assoc($result);
    // print_r($result_arr);

    // 0 = wrong password; 1 = email not found 3 = OK
    if ($email == $result_arr['email']) {
        if ($password == $result_arr['password']) {
            $_SESSION['user'] = $result_arr;
            // print_r($_SESSION['user']);
            echo 3;
        } else {
            echo 0;
        }
    } else {
        echo 1;
    }
}
