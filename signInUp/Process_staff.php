<?php
//This script will ADD staff.
include_once('../connection.php');
session_start();
// echo 'iidfdfd';

//Get the values from the form
if (isset($_POST['submit'])) {
    $seletedwhId = $_POST['whInfo'];
    $userID = $_POST['userIDbox'];

    // echo $seletedwhId;
    // echo $userID;

    $selectQuery = "select * from staff where userID ='$userID'";
    //Checks the customer already exists with the userID.

    if ($result = mysqli_query($connection, $selectQuery)) {

        $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
        // var_dump($user);
        if (!empty($user)) {
            echo "Sorry. That Branch name  has already been taken.";
            // header("Location:signup.php");
        } else {
            /* add the warehouse*/
            $insertStatement = "insert into staff(whID, userID)" .
                " values (?, ?)";

            /* Prepare an insert statement */

            $stmt = mysqli_prepare($connection, $insertStatement);

            mysqli_stmt_bind_param($stmt, "ss", $val1, $val2);
            // var_dump($val5);
            $val1 = $seletedwhId;
            $val2 = $userID;

            if (mysqli_stmt_execute($stmt)) {
                unset($_SESSION['error']);
                $message = "Successfully updated warehouse staff! ";
                echo "<script type='text/javascript'>alert('$message');</script>";
                header("Location:../updatestoreInfo1.php");
            } else {
                $_SESSION['error'] = "An error has occured while Registering  the customer ";
                header("Location:./signInUp/signup.php");
            }
        }
    }
}
