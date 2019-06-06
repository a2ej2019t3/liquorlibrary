<?php
	require_once "config.php";

	\Stripe\Stripe::setVerifySslCerts(false);

	// Token is created using Checkout or Elements!
	// Get the payment token ID submitted by the form:
	// $userID = $_POST['id'];
    // $totalquantity= $_GET['totalquantity'];
	$fianlprice= $_POST['finalprice'];
	$finalquantity = $_POST['finalquantity'];
	// || !isset($userID)
	if (!isset($_POST['stripeToken'])) {
		header("Location: index.php");
		exit();
	}

	$token = $_POST['stripeToken'];
	// $email = $_POST["stripeEmail"];
	$totalfinalcost= $fianlprice*100;
	// Charge the user's card:
	$charge = \Stripe\Charge::create(array(

		"amount" => $totalfinalcost,
		"currency" => "NZD",
		"description" =>'order payment:test: : in total',
		"source" => $token,
	));

	//send an email
	//store information to the database
	echo 'Success! You have been charged ' . $finalquantity .'items , $' .$fianlprice. 'in total';
?>