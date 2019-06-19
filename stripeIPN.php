<?php

	require_once "config.php";

	\Stripe\Stripe::setVerifySslCerts(false);

	// Token is created using Checkout or Elements!
	// Get the payment token ID submitted by the form:
	// $userID = $_POST['id'];
    // $totalquantity= $_GET['totalquantity'];
	$fianlprice= $_GET['finalprice'];
	$finalquantity = $_GET['finalquantity'];
	$note= $_GET['notecontext'];
	$email= $_GET['emailcontext'];
	$orderId=$_GET['idcontext'];
	$username=$_GET['usernamecontext'];
	
	$paymentmethod=$_GET['paymentmethod'];
	$deliverymethod=$_GET['deliverymethod'];
	$pickupwarehouseId=$_GET['pickupwarehouseId'];


	// || !isset($userID)
	if (!isset($_GET['stripeToken'])) {
		header("Location: index.php");
		exit();
	}
	else{
	$token = $_GET['stripeToken'];
	// $useremail = $_POST['stripeEmail'];
	$totalfinalcost= $fianlprice*100;
	// Charge the user's card:
// 	  $customer = Stripe_Customer::create(array(
//       'email' => $email,
//       'card'  => $token
//   ));
	$charge = \Stripe\Charge::create(array(

		"amount" => $totalfinalcost,
		"currency" => "nzd",
		"description" =>'order payment:test: : in total',
		"receipt_email" => $email,
		// "email" => $useremail,
		"source" => $token,
		"metadata" => array("email" => $email)
		));
		// var_dump($charge);
		
		
	//send an email
	//store information to the database
	
	include ('connection.php');
	// Cart items > in case of order status=0 
	$date = date('Y-m-d H:i:s');
	$updateorder_sql = "UPDATE `orders` SET `status`=1 , note='$note', `date`= '$date', `transactionID`='$charge->id' , `whID`='$pickupwarehouseId', `paymentmethod`='$paymentmethod', `deliverymethod`='$deliverymethod'  WHERE orderID='$orderId'";
	// var_dump($charge->failure_message);
	if ($charge->failure_message === null) {
		$updateorder_res = mysqli_query($connection, $updateorder_sql);
	}
	
	if ($updateorder_res != "") {
		// $updateorder_arr = mysqli_fetch_all($updateorder_res);
		// $resultcount=count($updateorder_arr);
		
		if(isset($_GET['stripeToken']) || isset($_GET['emailcontext'])){
			
			// require 'Emailsending/mail_config.php';
			require 'Emailsending/mail_config.php';
			$emailStatus = require 'Emailsending/successfulpayment_email.php';
			if ($emailStatus == 1) {
				// $obj = array(
				// 	'status' => 1,
				// 	'id' => $charge->id
				// );
				// $obj = json_encode($obj);
				// var_dump($obj);
				echo 1;
			} else {
				echo 'something wrong with email';
			}
						// echo '<div style="text-align: center;">Success! You have been charged ' . $finalquantity .'items , $' .$fianlprice. 'in total </div>';


				}

				return 2;
	  } else {
		  return 3;
		alert("result empty");
	  }
	}





	// header( "refresh:5;url=paymentprocess.php" );
	// exit();