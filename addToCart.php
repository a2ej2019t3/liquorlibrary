<?php

session_start();
require_once('connection.php'); 

if (isset($_POST['productID']) && $_POST['productID']!=""){
$productID = $_POST['productID'];
$result = mysqli_query($connection,"SELECT p.productID, p.img, p.productName, p.discountprice, p.price,p.categoryID, b.brandName, c.categoryName,c.categoryID FROM product AS p, brand AS b, category AS c WHERE p.brandID=b.brandID and p.categoryID=c.categoryID and p.productID = ".$productID.";");
$result_arr = mysqli_fetch_assoc($result);

$productID = $result_arr['productID'];
$productName = $result_arr['productName'];

$price = $result_arr['price'];
$discountprice = $result_arr['discountprice'];

$categoryID = $result_arr['categoryID'];
$categoryName = $result_arr['categoryName'];

$brandName = $result_arr['brandName'];

$img = $result_arr['img'];


$cartItems = array(
	$productID => array(
		'productName'=>$productName,
		'productID'=>$productID,
		'price'=>$price,
		'discountprice'=>$discountprice,
		'categoryID'=>$categoryID,
		'categoryName'=>$categoryName,
		'brandName'=>$brandName,
		'quantity'=>1,
		'img'=>$img
		)
);

if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartItems;
	// print_r($_SESSION["shopping_cart"]);
	
} else {
		$existedProductID = array_keys($_SESSION["shopping_cart"]);
		if(in_array($productID,$existedProductID)) {
		} else {
			$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartItems);
			$status = "<div class='box'>Product is added to your cart!</div>";
		// print_r($_SESSION["shopping_cart"]);
		}	
	}
}