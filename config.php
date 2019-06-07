<?php
	require_once "stripe-php-master/init.php";
	// require_once "paymentprocess.php";
    // require_once "confirmdetail.php";
	$stripeDetails = array(
		"secretKey" => "sk_test_YqvQmW7WQzNqAQZg2WG7G1Hf00bSBPu6DF",
		"publishableKey" => "pk_test_LzVFBvv6py0EeG7ifdYNnfJv00dEJ5eiyo"
	);

	// Set your secret key: remember to change this to your live secret key in production
	// See your keys here: https://dashboard.stripe.com/account/apikeys
	\Stripe\Stripe::setApiKey($stripeDetails['secretKey']);
?>
