
    <?php
      session_start();
      require_once "config.php";
      include ('connection.php');
    include_once ("partials/head.php");
    $_SESSION['ordertotalcost']= $_GET['ordertotalcost'];
    $ordertotalcost= $_SESSION['ordertotalcost'];
    $_SESSION['ordertotalquantity']= $_GET['ordertotalquantity'];
    $ordertotalquantity= $_SESSION['ordertotalquantity'];
    $note= $_GET['note'];
    $address= $_GET['address'];
    // echo $ordertotalcost;
    // echo $ordertotalquantity;
    // echo $note;

 	?>
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