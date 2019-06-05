<?php
	require_once "config.php";

	\Stripe\Stripe::setVerifySslCerts(false);

	// Token is created using Checkout or Elements!
	// Get the payment token ID submitted by the form:
	$userID = $_GET['id'];
    $totalcost= $_GET['totalcost'];
    $totalquantity= $_GET['totalquantity'];


	if (!isset($_POST['stripeToken']) || !isset($userID)) {
		// header("Location: index.php");
		exit();
	}

	$token = $_POST['stripeToken'];
	$email = $_POST["stripeEmail"];
	$totalfinalcost= $totalcost*100;
	// Charge the user's card:
	$charge = \Stripe\Charge::create(array(

		"amount" => $totalfinalcost,
		"currency" => "NZD",
		"description" =>'order payment:'.$totalquantity.': : in total',
		"source" => $token,
	));

	//send an email
	//store information to the database
	echo 'Success! You have been charged ' . $totalquantity .'items , $' .$totalcost. 'in total';
?>