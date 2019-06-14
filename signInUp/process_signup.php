<?php
//This script will sign up a customer.
include_once ('../connection.php'); 
session_start();

//Get the values from the form

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$password = $_POST['password'];
$email = $_POST['email'];
$company_name = $_POST['company_name'];
$contact_number = $_POST['contact_number'];
$typeID = $_POST['typeID'];
//var_dump($typeID);

// $first_name = 'j';
// $last_name = 'z';
// $password = '123';
// $email = 'dfg';
// $company_name = 'sdf';
// $contact_number = 123123123;
// $typeID = 1;

// echo $first_name.",".$last_name.",".$password.",".$email.",".$company_name.",".$contact_number.",".$typeID;

$selectQuery = "select * from users where email='" . $email . "'";
//Checks the customer already exists with the user name.

if ($result = mysqli_query($connection, $selectQuery))
 {

    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if (isset($user)) 
    {
        $_SESSION['error'] = "Sorry. That user name  has already been taken.";
        // header("Location:signup.php");
    } else {
        /* add the user*/
        $insertStatement = "insert into users(firstName, lastName, companyName, email, typeID, password, phone)" .
            " values (?, ?, ?, ?, ?, ?, ?)";

/* Prepare an insert statement */

        $stmt = mysqli_prepare($connection, $insertStatement);

        mysqli_stmt_bind_param($stmt, "ssssiss", $val1, $val2, $val3, $val4, $val5, $val6, $val7);
        var_dump($val5);
        $val1 = $first_name;
        $val2 = $last_name;
        $val3 = $company_name;
        $val4 = $email;
        $val5 = $typeID;
        $val6 = $password;
        $val7 = $contact_number;
        $username= $first_name. $last_name;

        if (mysqli_stmt_execute($stmt)) 
        {
            unset($_SESSION['error']);

            // login directly
            $selectQuery = "select * from users where email='" . $email . "'";
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