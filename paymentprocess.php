
<?php
  session_start();
  $_SESSION['location'] = 'paymentprocess';
  include ('connection.php');
  // Cart items > in case of order status=0 
  if(isset($_SESSION['user']['userID'])){
  $userID=$_SESSION['user']['userID'];
  $cartitem_sql = "SELECT o.orderID, o.buyerId, o.whID, o.status, oi.itemID, oi.quantity, p.productID, p.productName, p.price, p.discountprice, p.img, b.brandName, c.categoryName FROM orders AS o, orderitems AS oi, product AS p, brand AS b, category AS c WHERE o.orderID=oi.orderID and oi.itemID=p.productID and p.brandID=b.brandID and p.categoryID= c.categoryID and o.status=0 and o.buyerID='$userID';";
  
  $cartitem_res = mysqli_query($connection, $cartitem_sql);
  
  if ($cartitem_res != "") {
      $cartitem_arr = mysqli_fetch_all($cartitem_res);
      $resultcount=count($cartitem_arr);
    } else {
      alert("result empty");
    }
  }
  else{
    echo '<script type="text/javascript">';                
    echo 'alert("Please log in to proceed")';
    echo '</script>';

    // echo "<script type='text/javascript'>
    // $(document).ready(function(){
    // $('#myModal').modal('show');
    // });
    // </script>";
    // include ('partials/loginmodal.php');
  }

  

 

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
          <th>Edit</th>
        </tr>
      </thead>

      <tbody>
      <?php
    if (isset($_SESSION['user']['userID'])) {
      if (count($cartitem_arr) != 0) {
        $imgpath = 'images/'; 
        for($b = 0; $b <count($cartitem_arr); $b++){
          echo '
          <tr class="items" id="items['.$cartitem_arr[$b][6].']" data-variant="'.$cartitem_arr[$b][6].'" data-title="'.$cartitem_arr[$b][7].' / '.$cartitem_arr[$b][11].' - '.$cartitem_arr[$b][12].'" data-url="productlist.php?pid='.$cartitem_arr[$b][6].'">
			
		 	 <td class="cart-item-product first">
              <div class="cart-image"><img class="img-fluid productimg" src="'.$imgpath.$cartitem_arr[$b][10].'" alt="'.$cartitem_arr[$b][7].'"></div>
              <div class="cart-item-product-wrap">
                  <span class="cart-title"><a href="productlist.php?pid='.$cartitem_arr[$b][6].'"><span class="itemname">'.$cartitem_arr[$b][7].'</span> / '.$cartitem_arr[$b][11].' - '.$cartitem_arr[$b][12].'</a></span>                
                                
              </div>
			</td>';
      if($cartitem_arr[$b][9] !==null ){
        echo      '<td class="cart-item-price" name="ticket_price['.$cartitem_arr[$b][6].']" id="ticket_price['.$cartitem_arr[$b][6].']" data-value="'.$cartitem_arr[$b][9].'">$'.$cartitem_arr[$b][9].'</td>';
    }
    else {
      echo      '<td class="cart-item-price" name="ticket_price['.$cartitem_arr[$b][6].']" id="ticket_price['.$cartitem_arr[$b][6].']">$'.$cartitem_arr[$b][8].'</td>';

    }

      
  echo        '<td class="cart-item-quantity" style="padding-top: 20px;">
              <input type="number" name="quantity['.$cartitem_arr[$b][6].']" id="quantity['.$cartitem_arr[$b][6].']"  class="cart-item-quantity-display" data-attribute="'.$cartitem_arr[$b][6].'" value="1" onblur="CaclulateCostTotal(this);">
              <p class="listprice"></p>
              </td>';
            if($cartitem_arr[$b][9] !==null ){
              echo ' <td class="cart-item-total last" id="total['.$cartitem_arr[$b][6].']">NZ$'.$cartitem_arr[$b][9].'</td>';
              
            }
          else {
            echo ' <td class="cart-item-total last" id="total['.$cartitem_arr[$b][6].']" >NZ$'.$cartitem_arr[$b][8].'</td>';          
          }
          echo '<td>
                  <button class="cart-item-remove" type="button">Remove</button> 
                </td>';
            echo '</tr>';
          if($cartitem_arr[$b][9] !==null ){
            $totalprice=$cartitem_arr[$b][9];
        }
          else {
            $totalprice=$cartitem_arr[$b][8];
      
          }
          $resultprice=0;
          $resultprice=$resultprice+$totalprice;
          
          // echo $totalprice
        }
echo $resultprice;
      }
      else{
        echo 'No item found';
      }
    }
    else{
      echo '<h4 class="notloggedinmsg">Please log in for the next step</h4>';
    }
      ?>

      </tbody>

    </table>

  
    
    <div class="cart-tools">

      
      <div class="cart-instructions">        
        <p class="note"><i class='fas fa-pencil-alt' style='font-size:24px; margin-right: 10px;'></i>Special instructions</p>      
        <textarea rows="6" name="note" placeholder="Add a note"></textarea>
      </div>
      

      <div class="cart-totals">
        <p class="cart-price"><span class="money"><?php $resultprice ?></span></p>
        
        
        

       
        <p style="float: none; text-align: right; clear: both; margin: 10px 0;">
        	<input style="float:none; vertical-align: middle;" type="checkbox" id="agree" required="">
        	<label style="display:inline; float:none" for="agree">
          		Are you and the receiving person both at least 18 years old? <a href="">Terms of Service</a>.
			</label>
		</p>
        



 
        
        <div class="buttonarea">
          <button type="submit" class="btn btn-secondary btn-sm" id="checkbutton">
              PROCEED
              </a>
          </button>        
        </div>

        
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
  <script type="text/javascript" src="./js/pay.js"></script>

<!-- ----- -->
</body>
</html>

