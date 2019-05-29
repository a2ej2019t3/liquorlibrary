
<?php
  session_start();
  $_SESSION['location'] = 'contact';
  include ('connection.php');
  // Cart items > in case of order status=0 
//   $userID = $_SESSION['userID'];
  $userID=$_SESSION['user']['ID'];
  echo $userID;
//   $cartitem_sql = "SELECT o.orderID, o.buyerId, o.whID, o.status, oi.itemID, oi.quantity, p.productID, p.productName, p.price, p.discountprice, p.img, b.brandName, c.categoryName FROM orders AS o, orderitems AS oi, product AS p, brand AS b, category AS c WHERE o.orderID=oi.orderID and oi.itemID=p.productID and p.brandID=b.brandID and p.categoryID= c.categoryID and o.status=0 and o.buyerID='$userID';";
  
//   $cartitem_res = mysqli_query($connection, $cartitem_sql);
  
//   if ($cartitem_res != "") {
// 	  $cartitem_arr = mysqli_fetch_all($cartitem_res);
// 	  $resultcount=count($cartitem_arr);
//   } else {
// 	  alert("result empty");
//   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    include_once ("./partials/head.php");
 	?>
	 <link rel="stylesheet" href="css/cart.css">
    <title>Shopping Cart</title>
</head>
<body>
<section>
        <?php
          include_once ("./partials/header.php");
        ?>        
</section>
<section>
    <div class="container" style="margin-top: 150px;" >
    <center><h4 class="carthead"><hr>YOUR PAYMENT</h4></center>
    <!-- step element ends -->
    <div class="step-tab">
        <ul>
            <li class="selected">
                <a href="" shape="rect">1</a>

                <p>Cart</p>
            </li>
            <li>
                <a href="javascript:void(0);" shape="rect">2</a>

                <p>Confirm Detail</p>
            </li>
            <li>
                <a href="javascript:void(0);" shape="rect">3</a>

                <p>Payment</p>
            </li>
            <li>
                <a href="javascript:void(0);" shape="rect">4</a>

                <p>Invoice</p>
            </li>

        </ul>
    </div> 
	<!-- step element ends -->
	<form action="/cart" method="post">
    

    <table class="cart-items clean">
      <thead>
        <tr>
          <th class="first" colspan="2">Price</th>
          <th>Quantity</th>
          <th class="last">Total</th>
        </tr>
      </thead>

      <tbody>
        <!-- loop starts -->
          <tr class="cart-item variant-28179105448029 first " data-variant="28179105448029" data-title="Urbanaut / Williamsburg IPA - 7.2% 330ml Can" data-url="/products/urbanaut-williamsburg-ipa-7-2-330ml-can?variant=28179105448029">
			
		 	 <td class="cart-item-product first">
              <a class="cart-image" href="/products/urbanaut-williamsburg-ipa-7-2-330ml-can?variant=28179105448029"><img src="//cdn.shopify.com/s/files/1/0523/1485/products/VNydu4vSAe3iXQH7ETGw_20190508_093323_small.jpg?v=1557873291" alt="Urbanaut / Williamsburg IPA - 7.2% 330ml Can"></a>
              <div class="cart-item-product-wrap">
                <span class="cart-title"><a href="/products/urbanaut-williamsburg-ipa-7-2-330ml-can?variant=28179105448029">Urbanaut / Williamsburg IPA - 7.2% 330ml Can</a></span>
                <span class="cart-vendor vendor">Urbanaut</span>
                
                  <span class="cart-variant">Default</span>
                
                
                  <span class="cart-item-remove">Remove</span>
                
              </div>
			</td>
			<!--  -->
            <td class="cart-item-price"><span class="money">$5.00 NZD</span></td>
            <td class="cart-item-quantity" data-max="11">
              <input type="text" name="updates[]" class="cart-item-quantity-display" value="1" size="1">
              <span class="cart-item-decrease icon"></span>
              <span class="cart-item-increase icon"></span>
            </td>
            <td class="cart-item-total last"><span class="money">$5.00 NZD</span></td>
          </tr>
        <!-- product 1 finished -->
      </tbody>

    </table>

  
    
    <div class="cart-tools">

      
      <div class="cart-instructions">        
        <p>Special instructions</p>      
        <textarea rows="6" name="note" placeholder="Add a note"></textarea>
      </div>
      

      <div class="cart-totals">
        <p class="cart-price"><span class="money">$39.80 NZD</span></p>
        
        
        
        
          <p class="cart-message meta">FREE shipping on Subscriptions</p>
          <p class="cart-message meta">$5 shipping on everything else</p>
       
        <p style="float: none; text-align: right; clear: both; margin: 10px 0;">
        	<input style="float:none; vertical-align: middle;" type="checkbox" id="agree" required="">
        	<label style="display:inline; float:none" for="agree">
          		Are you and the receiving person both at least 18 years old? <a href="/pages/terms-of-service">Terms of Service</a>.
			</label>
		</p>
        



 
        
        
          <input type="submit" name="checkout" value="Checkout">
        
      </div>

    </div>

  </form>
    </div>
    </section>   

<!-- links -->
<?php
    include_once ("partials/foot.php");
  ?>  
  <script type="text/javascript" src="js/sub.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
  <script type="text/javascript" src="js/cart.js"></script>
  <script type="text/javascript" src="js/pay.js"></script>
<!-- ----- -->
</body>
</html>

