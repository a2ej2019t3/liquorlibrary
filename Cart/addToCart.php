<?php
// 0 = not login and added to cookie; 1 = item exist in session; 2 = item added to session; 3 = item added to db
include ('../database/DBsql.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$DBsql = new sql();
if (isset($_SESSION['cartID'])) {
	$cartID = $_SESSION['cartID'];
}
// 'i' comes from cart.js
if (isset($_REQUEST['i']) && $_REQUEST['i']!=""){
	$productID = $_REQUEST['i'];
	// $itemArr = $DBsql->select($DBsql->getProductInfo(),array('productID' => $productID));
	// print_r($itemArr);

	$cartItems = array(
		$productID => array(
			// 'productName'=>$productName,
			'itemID'=>$productID,
			'orderID'=>$cartID,
			// 'price'=>$itemArr['price'],
			// 'discountprice'=>$itemArr['discountprice'],
			// 'categoryID'=>$categoryID,
			// 'categoryName'=>$categoryName,
			// 'brandName'=>$brandName,
			'quantity'=>1,
			'totalprice'=>"",
			// 'img'=>$img,
			// 'whID'=>1,
			// 'date'=>now(),
			// 'status'=>0
			)
	);
	// print_r($cartItems);

	// merge cartItems array into session['cartItems'] to update cart session
	if (empty($_SESSION['cartItems'])) {
		$_SESSION['cartItems'] = $cartItems;
	} else {
		$existedProductID = array_keys($_SESSION['cartItems']);
		// print_r($existedProductID);
		if (in_array($productID,$existedProductID)) {
			echo 1;
		} else {
			$_SESSION['cartItems'] = array_replace($_SESSION['cartItems'],$cartItems);
			// print_r($_SESSION['cartItems']);
			echo 2;
			// check if user login
			// logged in (we need productid cartid & quantity in this case)
			if (isset($_SESSION['user'])) {
				$user = $_SESSION['user'];
						$addCartToDB_res = $DBsql->insert("orderitems","",$cartItems[$productID]);
				echo 3;
		
			// not logged in (we dont need cartID in this case)
			} else {
				setcookie('cart', $_SESSION['cartItems'], time() + (86400 * 30), '/');
				echo 0;
			}
		}
	}
}