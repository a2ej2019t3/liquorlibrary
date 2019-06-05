
    <?php
      session_start();
      require_once "config.php";
      include ('connection.php');
      include_once ("partials/head.php");
    $_SESSION['costbox']= $_POST['costbox'];
    $ordertotalcost= $_SESSION['costbox'];
    $_SESSION['costquantitybox']= $_POST['costquantitybox'];
    $ordertotalquantity= $_SESSION['costquantitybox'];
    $note= $_POST['notecontext'];
    $address= $_POST['addresschangearea'];
    echo $ordertotalcost;
    echo $ordertotalquantity;
    echo $note;

 	?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://checkout.stripe.com/checkout.js"></script>

    <?php
    include_once ("./partials/head.php");
 	?>
	 <link rel="stylesheet" href="css/cart.css">
    <title>Shopping Cart_payment</title>
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
    <section id="third">
<h1>Pay confirm</h1>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="contacthead">Your Order</div>
            <div class="detailwrapper">
                    <input type="hidden" value="<?php $note ?>" id="notecontext">
                    <div class="iconwrapper"><img src="images/deliverytruck.png" alt="truckicon" style="width: 55px;"></div>
                    <div class="labelindex">Total cost: <span class="costquantity"> $<?php  echo $ordertotalcost ?> </span></div>
                    <div class="labelindex">Total amount: <span class="costquantity"> <?php echo $ordertotalquantity?> items</span></div>
                    <div class="labelindex">Delivery Address: <br><span class="costquantity"> <?php echo $address?> </span></div>
                    <div class="labelindex">Special note: <br><span class="notearea"> <?php echo $note?> </span></div>

                    <div>
                    <button type="button" class="btn btn-secondary btn-sm" id="checkbutton">
                        BACK TO CART
                        </a>
                    </button> 
                    </div>
                </div>
        </div>
    </div>
</div>
</section>
    
    </div>
</body>
</html>




