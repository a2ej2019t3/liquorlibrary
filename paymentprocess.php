  <?php
  session_start();
  $_SESSION['location'] = 'paymentprocess';
  include_once(__DIR__ . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
  include_once(__DIR__ . DIRECTORY_SEPARATOR . 'objectToArray.php');

  $DBsql = new sql();

  // Cart items > in case of order status=0 
  if (isset($_SESSION['user']['userID'])) {
    $userID = $_SESSION['user']['userID'];
    $cartID = $_SESSION['cartID'];
    // $cartitem_sql = "SELECT o.orderID, o.buyerId, o.whID, o.status, oi.itemID, oi.quantity, p.productID, p.productName, p.price, p.discountprice, p.img, b.11brandName, c.categoryName, oi.totalprice FROM orders AS o, orderitems AS oi, product AS p, brand AS b, category AS c WHERE o.orderID=oi.orderID and oi.itemID=p.productID and p.brandID=b.brandID and p.categoryID= c.categoryID and o.status=0 and o.buyerID='$userID';";
    $res = $DBsql->getOrderInfo($cartID, null);
    // var_dump($res);
    // $cartitem_sql = "SELECT o.orderID, o.buyerId, o.whID, o.status, oi.itemID, oi.quantity, p.productID, p.productName, p.price, p.discountprice, p.img, b.brandName, c.categoryName, oi.totalprice FROM orders AS o, orderitems AS oi, product AS p, brand AS b, category AS c WHERE o.orderID=oi.orderID and oi.itemID=p.productID and p.brandID=b.brandID and p.categoryID= c.categoryID and o.status=0 and o.buyerID='$userID';";
    // $cartitem_res = mysqli_query($connection, $cartitem_sql);

    if ($res != "") {
      // var_dump($cartitem_arr);
      $resultcount = count($res);
      if ($resultcount !== 0) {
        $orderID = $res[0]['orderID'];
      }
    } else {
      alert("result empty");
    }
  } else {
    echo '<script type="text/javascript">
          alert("Please log in to proceed");
          window.location = "index.php";
          </script>';
  }





  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php
    include_once("./partials/head.php");
    ?>
    <link rel="stylesheet" href="css/cart.css">
    <title>Shopping Cart</title>
  </head>

  <body>

    <section>
      <?php
      include_once("./partials/header.php");
      ?>
    </section>
    <section>
      <div class="container" style="margin-top: 150px;">
        <center>
          <h4 class="carthead">
            <hr>YOUR PAYMENT</h4>
        </center>
        <!-- step element ends -->
        <div class="step-tab">
          <ul>
            <li id="step1" class="selected">
              <a href="" shape="rect">1</a>

              <p>Cart</p>
            </li>
            <li id="step2">
              <a href="javascript:void(0);" shape="rect">2</a>

              <p>Confirm Detail</p>
            </li>
            <li id="step3">
              <a href="javascript:void(0);" shape="rect">3</a>

              <p>Payment</p>
            </li>
            <li id="step4">
              <a href="javascript:void(0);" shape="rect">4</a>

              <p>Invoice</p>
            </li>

          </ul>

        </div>

        <div id="content">
          <!-- step element ends -->
          <!-- <form action="/cart" method="post"> -->


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
                if (count($res) != 0) {
                  $imgpath = 'images/';
                  $carttotal = 0;
                  $carttotalquantity = 0;
                  foreach ($res as $key => $cartitem_arr) {
                    echo '
          <input type="hidden" value="' . $orderID . '" id="orderidbox" name="orderidbox">
          <input type="hidden" value="' . $cartitem_arr['orderID'] . '" id="order' . $cartitem_arr['productID'] . '">
          <tr class="items" id="items[' . $cartitem_arr['productID'] . ']" data-variant="' . $cartitem_arr['productID'] . '" data-title="' . $cartitem_arr['productName'] . ' / ' . $cartitem_arr['brandName'] . ' - ' . $cartitem_arr['categoryName'] . '" data-url="productlist.php?pid=' . $cartitem_arr['productID'] . '">
          
          <td class="cart-item-product first">
          <div class="cart-image"><img class="img-fluid productimg" src="' . $imgpath . $cartitem_arr['img'] . '" alt="' . $cartitem_arr['productName'] . '"></div>
          <div class="cart-item-product-wrap">
          <span class="cart-title"><a href="productlist.php?pid=' . $cartitem_arr['productID'] . '"><span class="itemname">' . $cartitem_arr['productName'] . '</span> / ' . $cartitem_arr['brandName'] . ' - ' . $cartitem_arr['categoryName'] . '</a></span>                
          
          </div>
          </td>';
                    if ($cartitem_arr['discountprice'] !== null) {
                      echo      '<td class="cart-item-price" name="ticket_price[' . $cartitem_arr['productID'] . ']" id="ticket_price[' . $cartitem_arr['productID'] . ']" data-value="' . $cartitem_arr['discountprice'] . '">$' . $cartitem_arr['discountprice'] . '</td>';
                      echo        '<td class="cart-item-quantity" style="padding-top: 20px;">
            <input type="number" min="1" name="quantity[' . $cartitem_arr['productID'] . ']" id="quantity[' . $cartitem_arr['productID'] . ']"  class="cart-item-quantity-display" data-attribute="' . $cartitem_arr['productID'] . '" value="' . $cartitem_arr['quantity'] . '" onblur="CaclulateCostTotal(' . $cartitem_arr['productID'] . '); quantityUpdate(' . $cartitem_arr['productID'] . ');">
            </td>';
                    } else {
                      echo      '<td class="cart-item-price" name="ticket_price[' . $cartitem_arr['productID'] . ']" id="ticket_price[' . $cartitem_arr['productID'] . ']">$' . $cartitem_arr['price'] . '</td>';
                      echo        '<td class="cart-item-quantity" style="padding-top: 20px;">
            <input type="number" name="quantity[' . $cartitem_arr['productID'] . ']" id="quantity[' . $cartitem_arr['productID'] . ']"  class="cart-item-quantity-display" data-attribute="' . $cartitem_arr['productID'] . '" value="' . $cartitem_arr['quantity'] . '" onblur="CaclulateCostTotal(' . $cartitem_arr['productID'] . '); quantityUpdate(' . $cartitem_arr['productID'] . ');">
            <p class="listprice"></p>
            </td>';
                    }
                    if ($cartitem_arr['discountprice'] !== null) {
                      echo '  
            <td class="cart-item-total last asdfa" id="total[' . $cartitem_arr['productID'] . ']" value="' . $cartitem_arr['totalprice'] . '" data-attribute="' . $cartitem_arr['productID'] . '">NZ$' . $cartitem_arr['totalprice'] . '</td>';
                    } else {
                      echo ' 
            <td class="cart-item-total last asdfa" id="total[' . $cartitem_arr['productID'] . ']" value="' . $cartitem_arr['totalprice'] . '" data-attribute="' . $cartitem_arr['productID'] . '">NZ$' . $cartitem_arr['totalprice'] . '</td>';
                    }
                    $idArr = array(
                      'orderID' => $cartitem_arr['orderID'],
                      'productID' => $cartitem_arr['productID']
                    );
                    $idJson = json_encode($idArr);
                    echo '<td>
          <button class="cart-item-remove" value=' . $idJson . ' type="button" onclick="removeItem(this.value)">Remove</button> 
          </td>';
                    echo '</tr>';
                  }
                } else {
                  echo 'No item found';
                }
                echo '
          </tbody>
          
          </table>';

                if (count($res) == 0) {
                  echo '
                <div class="cart-tools">
                <p class="cart-quantity" name="cartTotalQuantity" id="cartTotalQuantity" style="
                text-align: right;
                margin-right: 30px;
                margin-bottom: 0;
                margin-top: 20px;
                font-size: 20px;
                font-weight: 700;
                ">0 items</p>
                
                <p class="cart-price">TOTAL: NZ$<span class="totalmoney" name="cartTotalPrice" id="cartTotalPrice">0</span></p>';
                } else {
                  echo '
                <div class="cart-tools">
                <p class="cart-quantity" name="cartTotalQuantity" id="cartTotalQuantity" value="' . $carttotalquantity . '" style="
                text-align: right;
                margin-right: 30px;
                margin-bottom: 0;
                margin-top: 20px;
                font-size: 20px;
                font-weight: 700;
                ">' . $carttotalquantity . 'items</p>
                
                <p class="cart-price">TOTAL: NZ$<span class="totalmoney" name="cartTotalPrice" id="cartTotalPrice" value="' . $carttotal . '">' . $carttotal . '</span></p>';
                  $carttotalcost = ($carttotal * 100);
                }
                echo '<div class="cart-instructions">        
          <p class="note"><i class="fas fa-pencil-alt" style="font-size:24px; margin-right: 10px;"></i>Special instructions</p>      
          <textarea rows="6" name="note" id="notetext" placeholder="Add a note"></textarea>
          </div>
          
          
          <div class="cart-totals">

          <p style="float: none; text-align: right; clear: both; margin: 10px 0;">
        	<input style="float:none;vertical-align: -webkit-baseline-middle;width: 20px!important;height: 20px;margin-top: -10px;" type="checkbox" id="agree" required="">
        	<label style="display:inline; float:none" for="agree">
          Are you and the receiving person both at least 18 years old? <a href="">Terms of Service</a>.
          </label>
          </p>
          </div>
          <div class="buttonarea">
          <button type="button" class="btn btn-secondary btn-sm" id="checkbutton" onclick="confirmorderdetail();">
          PROCEED
          </a>
          </button>        
          </div>
          </div>
          
          </div>  

          </div>
          </section>   
          ';
              } else {
                echo '<h4 class="notloggedinmsg">Please log in for the next step</h4>';
              }
              ?>

              <!-- links -->
              <?php
              include_once("partials/foot.php");
              ?>
              <script type="text/javascript" src="js/sub.js"></script>
              <script type="text/javascript" src="js/cart.js"></script>
              <script type="text/javascript" src="js/main.js"></script>
              <script type="text/javascript" src="js/search.js"></script>
              <script type="text/javascript" src="js/pay.js"></script>
              <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
              <script>
                addLoadEvent(getItems);
              </script>

  </body>

  </html>

  <style>
    .StripeElement--focus {
      box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
      border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
      background-color: #fefde5 !important;
    }

    .modalinput,
    .StripeElement {
      height: 40px;
      padding: 10px 12px;
      width: 100% !important;
      color: #32325d;
      background-color: white;
      border: 1px solid transparent;
      border-radius: 4px;

      box-shadow: 0 1px 3px 0 #e6ebf1;
      -webkit-transition: box-shadow 150ms ease;
      transition: box-shadow 150ms ease;
    }

    .modallablebox {
      margin-top: 15px;
      font-weight: 700;
      text-align: left;
      font-size: 17px;
    }
  </style>