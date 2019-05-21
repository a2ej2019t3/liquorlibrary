<!-- 0 = not login; 1 = item exist; 2 = item added -->
<?php
require_once('connection.php'); 
include ('../database/DBsql.php');
session_start();

$DBsql = new sql();

// 'i' comes from cart.js
if (isset($_REQUEST['i']) && $_REQUEST['i']!=""){
	$productID = $_REQUEST['i'];
	$result = mysqli_query($connection,"SELECT p.productID, p.img, p.productName, p.discountprice, p.price,p.categoryID, b.brandName, c.categoryName,c.categoryID FROM product AS p, brand AS b, category AS c WHERE p.brandID=b.brandID and p.categoryID=c.categoryID and p.productID = ".$productID.";");
	$result_arr = mysqli_fetch_assoc($result);

	$cartItems = array(
		$productID => array(
			// 'productName'=>$productName,
			'orderID'=>$cartID,
			'productID'=>$productID,
			'price'=>$price,
			'discountprice'=>$discountprice,
			// 'categoryID'=>$categoryID,
			// 'categoryName'=>$categoryName,
			// 'brandName'=>$brandName,
			'quantity'=>1,
			// 'img'=>$img,
			'whID'=>1,
			'date'=>now(),
			'status'=>0
			)
	);

	// check if user login
	if (isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
		// get user's cart and chose product id
		$cartID = $_SESSION['cartID'];
		$addCartToDB_res = $DBsql->insert("orderitems","","");
		
		$addcartToDB_sql = "INSERT INTO `orderitems`(`itemID`, `orderID`, `quantity`, `totalprice`) 
							VALUES (?,?,?,?)";
	
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
	
} else {
			echo 0;
			setcookie('cart', $cartItems, time() + 604800, '/');
	}
}