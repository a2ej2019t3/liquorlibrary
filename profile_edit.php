<?php
session_start();
include_once('connection.php');

if (isset($_POST['editbb'])) {
	$email = $_POST['email'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$phone = $_POST['contact'];
	$address = $_POST['address'];
	$userID = $_SESSION['user']['userID'];


	try {
		$sql = "UPDATE users SET `email`='$email', `password`='$password', `firstName`='$firstName', `lastName`='$lastName', `phone`=$phone, `address`='$address' WHERE `userID`='$userID'";
		$sql_res = mysqli_query($connection, $sql);
		if ($sql_res) {
			$_SESSION['success'] = 'Account updated successfully';
			echo ("<script LANGUAGE='JavaScript'>
            window.alert('Your request is Succesfully sent!');
            
            </script>");
			header('Location: ../liquorlibrary/' . $_SESSION['location'] . '.php');


			$selectQuery = "select * from users where userID='$userID'";


			if ($result = mysqli_query($connection, $selectQuery)) {

				$result_arr = mysqli_fetch_assoc($result);
				$_SESSION['user'] = $result_arr;}

				
			} else {
				$$_SESSION['error'] = $connection->error;
				echo ("<script LANGUAGE='JavaScript'>
            window.alert('Your request is denied!');
            
            </script>");
				header('Location: ../liquorlibrary/' . $_SESSION['location'] . '.php');
			}
		} catch (PDOException $e){
		$_SESSION['error'] = $e->getMessage();
		}
		} else {
			$_SESSION['error'] = 'Fill up edit form first';
		}
