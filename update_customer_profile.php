<?php 
include('connection.php');
$userIDd = $_POST['userID'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
// $sex = $_POST['sex'];
// $dob = $_POST['dob'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];

if($userID && $firstName && lastName && $address && $phone && $email){
	$stmt = $conn->prepare("update users set firstName=?, lastName=?, address=?, phone=?,
	email=? where userID=?");
    $stmt->bindParam(1, $firstName);
    $stmt->bindParam(2, $lastName);
	// $stmt->bindParam(2, $sex);
	// $stmt->bindParam(3, $dob);
	$stmt->bindParam(3, $address);
	$stmt->bindParam(4, $phone);
	$stmt->bindParam(5, $email);
	$stmt->bindParam(6, $userID);
	if($stmt->execute()){
		echo "valid";
	}
}else 
	echo "invalid";
?>