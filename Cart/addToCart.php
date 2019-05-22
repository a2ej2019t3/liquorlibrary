<!-- 0 = not login and added to cookie; 1 = item exist in session; 2 = item added to session; 3 = item added to db -->
<?php
require_once('connection.php'); 
include ('../database/DBsql.php');
session_start();

$DBsql = new sql();
// if (isset($_SESSION['cartID'])) {
// 	$cartID = $_SESSION['cartID'];
// }
// 'i' comes from cart.js
if (isset($_REQUEST['i']) && $_REQUEST['i']!=""){
	$productID = $_REQUEST['i'];
	// $itemArr = $DBsql->select($DBsql->getProductInfo(),array('productID' => $productID));
	// print_r($itemArr);

	$cartItems = array(
		$productID => array(
			// 'productName'=>$productName,
			// 'orderID'=>$cartID,
			// 'productID'=>$productID,
			// 'price'=>$itemArr['price'],
			// 'discountprice'=>$itemArr['discountprice'],
			// 'categoryID'=>$categoryID,
			// 'categoryName'=>$categoryName,
			// 'brandName'=>$brandName,
			'quantity'=>1,
			// 'img'=>$img,
			// 'whID'=>1,
			// 'date'=>now(),
			// 'status'=>0
			)
	);

	// merge cartItems array into session['cartItems'] to update cart session
	if (empty($_SESSION['cartItems'])) {
		$_SESSION['cartItems'] = $cartItems;
	} else {
		$existedProductID = array_keys($_SESSION['cartItems']);
		if (in_array($productID,$existedProductID)) {
			echo 1;
		} else {
			$_SESSION['cartItems'] = array_merge($_SESSION['cartItems'],$cartItems);
			echo 2;
		}
	}

	// transform cartitem array into a 1D array
	
	// check if user login
	// logged in (we need productid cartid & quantity in this case)
	if (isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
		// get user's cart and chosen product id
		$cartID = $_SESSION['cartID'];
			foreach ($_SESSION['cartItems'] as $key => $value) {
				$itemArr = array('productID' => $key, 
								 'orderID' => $cartID,
								 'quantity' => 1);
				$addCartToDB_res = $DBsql->insert("orderitems","",$itemArr);
			}
		echo 3;

	// not logged in (we dont need cartID in this case)
	} else {
		setcookie('cart', $_SESSION['cartItems'], time() + (86400 * 30), '/');
		echo 0;
	}
}