<?php
//This script will ADD Branch.
include_once('../connection.php');
session_start();

//Get the values from the form

$Branch_ID = $_POST['Branch_ID'];
$branch_name = $_POST['branch_name'];
// $password = $_POST['password'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$typeID = $_POST['typeID'];
//var_dump($typeID);
$selectQuery = "select * from warehouse where email='" . $email . "'";
//Checks the customer already exists with the user name.

if ($result = mysqli_query($connection, $selectQuery)) {

    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if (isset($user)) {
        $_SESSION['error'] = "Sorry. That Branch name  has already been taken.";
        // header("Location:signup.php");
    } else {
        /* add the warehouse*/
        $insertStatement = "insert into warehouse(whID, whName, email, phone, typeID, address)" .
            " values (?, ?, ?, ?, ?, ?)";

        /* Prepare an insert statement */

        $stmt = mysqli_prepare($connection, $insertStatement);

        mysqli_stmt_bind_param($stmt, "ssssss", $val1, $val2, $val3, $val4, $val5, $val6);
        // var_dump($val5);
        $val1 = $Branch_ID;
        $val2 = $branch_name;
        $val3 = $email;
        $val4 = $phone;
        $val5 = $typeID;
        $val6 = $address;
        // $val6 = $password;
        // $val7 = $contact_number;
        // $username = $first_name . $last_name;

        if (mysqli_stmt_execute($stmt)) {
            unset($_SESSION['error']);

            // login directly
            $selectQuery = "select * from warehouse where email='" . $email . "'";
            $result = mysqli_query($connection, $selectQuery);
            $result_arr = mysqli_fetch_assoc($result);
            $_SESSION['user'] = $result_arr;

            //sending confirm email

            require '../Emailsending/mail_config.php';
            require '../Emailsending/successfulsignup_email.php';


            // go to index pages
            header("Location:../index.php");
        } else {
            $_SESSION['error'] = "An error has occured while Registering  the customer ";
            header("Location:./signInUp/signup.php");
        }
    }
}
