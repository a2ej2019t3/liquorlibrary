<?php
// 0 = logged in and cart created and item added to cart;
// 1 = logged in and item already in cart; 
// 2 = logged in and item added to cart; 
// 3 = not login and item already in cookie cart; 
// 4 = not login and item added to cookie cart;
// 5 = not login and cookie created and item added to cookie cart;
include ('../database/DBsql.php');
include ('../objectToArray.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// check if the user has a temp cart or DB cart.
$DBsql = new sql();
// 'i' comes from cart.js
if (isset($_REQUEST['i']) && $_REQUEST['i']!=""){
	$productID = $_REQUEST['i'];
	$chosenProductArr = $DBsql->select($DBsql->getProductInfo(), array('productID' => $productID));
	// var_dump($chosenProductArr);
	if ($chosenProductArr[0]['discountprice']) {
		$pricePerUnit = $chosenProductArr[0]['discountprice'];
	} else {
		$pricePerUnit = $chosenProductArr[0]['price'];
	}
	if (isset($_SESSION['user'])) {
		$cartID = $_SESSION['cartID'];
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
				'totalprice'=> $pricePerUnit,
				// 'img'=>$img,
				// 'whID'=>1,
				// 'date'=>now(),
				// 'status'=>0
				)
			);
		if (empty($_SESSION['cartItems'])) {
			$addCartToDB_res = $DBsql->insertItems("orderitems",$cartItems[$productID]);
			$_SESSION['cartItems'] = $cartItems;
			echo 0;
		} else {
			$existedProductID = array_keys($_SESSION['cartItems']);
			if (in_array($productID,$existedProductID)) {
				echo 1;
			} else {
				$_SESSION['cartItems'] = array_replace($_SESSION['cartItems'],$cartItems);
				$addCartToDB_res = $DBsql->insertItems("orderitems",$cartItems[$productID]);
				echo 2;
			}
		}
	} else {
		$cartID = "";
		if (isset($_GET['q']) && isset($_GET['t'])) {
			$quantity = $_GET['q'];
			$totalprice = $quantity * $pricePerUnit;
		} else {
			$quantity = 1;
			$totalprice = $pricePerUnit;
		}
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
				'quantity'=>$quantity,
				'totalprice'=>$totalprice,
				// 'img'=>$img,
				// 'whID'=>1,
				// 'date'=>now(),
				// 'status'=>0
				)
			);
		if (isset($_COOKIE['tempCart'])) {
			$cookieCart = objectToArray(json_decode($_COOKIE['tempCart']));
			$_SESSION['cartItems'] = $cookieCart;
			$existedProductID = array_keys($cookieCart);
			if (in_array($productID,$existedProductID)) {
				$_SESSION['cartItems'] = array_replace($_SESSION['cartItems'],$cartItems);
				setcookie('tempCart', json_encode($_SESSION['cartItems']), time() + (86400 * 30), '/');
				echo 3;
			} else {
				$_SESSION['cartItems'] = array_replace($_SESSION['cartItems'],$cartItems);
				setcookie('tempCart', json_encode($_SESSION['cartItems']), time() + (86400 * 30), '/');
				// echo 4;
				echo var_dump($_SESSION['cartItems']).var_dump($cartItems);
			}
		} else {
			$_SESSION['cartItems'] = $cartItems;
			setcookie('tempCart', json_encode($_SESSION['cartItems']), time() + (86400 * 30), '/');
			echo 5;
		}
	}
}