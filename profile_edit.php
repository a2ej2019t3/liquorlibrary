<?php
session_start();
$_SESSION['location'] = 'updatestoreinfo1';
include_once('connection.php');
include_once('database/DBsql.php');

if (isset($_POST['edit'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$phone = $_POST['contact'];
	$address = $_POST['address'];
	$userID = $_SESSION['user']['userID'];
	if ($password == $_SESSION['user']['password']) {
		$password = $_SESSION['user']['password'];
	} else {
		$password = password_hash($password, PASSWORD_DEFAULT);
	}

	try {
		$sql = "UPDATE users SET `email`='$email', `password`='$password', `firstName`='$firstName', `lastName`='$lastName', `phone`='$phone', `address`='$address' WHERE `userID`='$userID'";
		$sql_res = mysqli_query($connection, $sql);
		if ($sql_res) {
			$_SESSION['success'] = 'Account updated successfully';
		} else {
			$_SESSION['error'] = $connection->error;
		}
	} catch (PDOException $e) {
		$_SESSION['error'] = $e->getMessage();
	}
	$_SESSION['error'] = 'Incorrect password';
} else {
	$_SESSION['error'] = 'Fill up edit form first';
}