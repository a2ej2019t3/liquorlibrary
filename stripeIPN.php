<?php
	require_once "config.php";

	\Stripe\Stripe::setVerifySslCerts(false);

	// Token is created using Checkout or Elements!
	// Get the payment token ID submitted by the form:
	// $userID = $_POST['id'];
    // $totalquantity= $_GET['totalquantity'];
	$fianlprice= $_POST['finalprice'];
	$finalquantity = $_POST['finalquantity'];
	$note= $_POST['notecontext'];
	$email= $_POST['emailcontext'];
	$orderId=$_POST['idcontext'];
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
		"currency" => "nzd",
		"description" =>'order payment:test: : in total',
		"receipt_email" => $email,
		"source" => $token,
		'metadata' => ['order_id' => $orderId],
	));

	//send an email
	//store information to the database
	echo 'Success! You have been charged ' . $finalquantity .'items , $' .$fianlprice. 'in total';
	echo $finalquantity;
	echo '<br>';
	echo $note;
	echo '<br>';
	echo $orderId;
?>