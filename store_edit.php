<?php
session_start();
include_once('connection.php');

if (isset($_POST['storeedit'])) {
    $email = $_POST['storeEmail'];
    $phone = $_POST['storeContact'];
    $userID = $_SESSION['warehouse']['whID'];
    // echo $email;
    // echo $phone;
    // echo $userID;

    try {
        $sql = "UPDATE warehouse SET `email`='$email', `phone`=$phone WHERE `whID`='$userID'";
        $sql_res = mysqli_query($connection, $sql);
        $userID=$_SESSION['user']['userID'];
        $selectQuery2 = "SELECT s.whID, s.userID,w.whID, w.typeID, w.whName, w.address, w.phone,w.email FROM staff AS s, warehouse AS w where '$userID'=s.userID and s.whID=w.whID";
        if ($result2 = mysqli_query($connection, $selectQuery2)){
            $result_arr2 = mysqli_fetch_assoc($result2);
            $_SESSION['warehouse'] = $result_arr2;
        }
        else{
            echo 'query error';
        }
        if ($sql_res) {
            $_SESSION['success'] = 'Account updated successfully';
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Your request is Succesfully sent!');
            
            </script>");
            header('Location: ../liquorlibrary/'. $_SESSION['location'].'.php');
        } else {
            $_SESSION['error'] = $connection->error;
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Your request is denied!');
            
            </script>");
            header('Location: ../liquorlibrary/'. $_SESSION['location'].'.php');
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }
   
} else {
    $_SESSION['error'] = 'Fill up edit form first';
}
