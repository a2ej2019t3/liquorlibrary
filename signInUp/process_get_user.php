<?php
require_once '../connection.php';
session_start();
//This script will get a selected users details.

//Get the values from the form

$email = $_POST['email'];
$password = $_POST['password'];
$selectQuery = "select * from users where email='" . $email . "' and password='" . $password ."'";


if ($result = mysqli_query($connection, $selectQuery)) {

    // $users = mysqli_fetch_as($result, MYSQLI_ASSOC);
    $users = mysqli_fetch_assoc($result);

    if ($email == $_SESSION['users']['email']) {
        header("Location:../index.php");
    } else {
        header("Location:../index.php");
    }

}
