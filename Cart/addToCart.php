<!-- 0 = not login; 1 = item exist; 2 = item added -->
<?php
require_once('connection.php'); 
session_start();
if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	echo 0;
}

if (isset($_REQUEST['productID']) && $_REQUEST['productID']!=""){
$productID = $_REQUEST['productID'];
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
		'img'=>$img,
		'whID'=>1,
		'date'=>now(),
		'status'=>0
		)
);

if(empty($_SESSION["shoppingCart"])) {
	$_SESSION["shoppingCart"] = $cartItems;
	// print_r($_SESSION["shoppingCart"]);

} else {
		$existedProductID = array_keys($_SESSION["shoppingCart"]);
		if(in_array($productID,$existedProductID)) {
			$_SESSION['shoppingCart'][$productID]['whID'] += 1;
			echo 1;
		} else {
			$_SESSION["shoppingCart"] = array_merge($_SESSION["shoppingCart"],$cartItems);
			echo 2;
		// print_r($_SESSION["shoppingCart"]);
		}
	}
}