<?php
  //session_start();
$_SESSION['location'] = 'customerorder';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Order Details</title>
<?php
    include_once ("./partials/head.php");
  ?>
    <link rel="stylesheet" href="css/index.css">
    
</head>
<body>
<section>
  <?php
    include_once ("./partials/header.php");
    ?>
</section>
  
<section>
    <br><br><br>
<div>
    <p class="contactms">Customer Order Details</p>
    <hr style="color: black;">
    <?php
     include_once("connection.php");
     if(isset($_SESSION['user'])){
        	$user = $_SESSION['user'];
			$orders_list = "SELECT * from orders o where o.orderID = '".$user['userID']."'";
			$query = mysqli_query($connection,$orders_list);
			if (mysqli_num_rows($query) > 0) 
			{
								while ($row=mysqli_fetch_array($query)) {
									?>
										<div class="row">
								
											<div class="col-md-6">
												<table>
													<tr><td>OrderID</td><td><b><?php echo $row["orderID"]; ?></b> </td></tr>
													<tr><td>BuyerID</td><td><b><?php echo $row["buyerID"]; ?></b></td></tr>
													<tr><td>WareHouseID</td><td><b><?php echo $row["whID"]; ?></b></td></tr>
													<tr><td>Date</td><td><b><?php echo $row["date"]; ?></b></td></tr>
											        <tr><td>Status</td><td><b><?php echo $row["status"]; ?></b></td></tr>
												</table>
											</div>
                                        </div>
                                        <p>
  <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    show
  </a>
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    See Less
  </button>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
  <?php
  include_once("connection.php");
  if(isset($_SESSION['user'])){
      $user = $_SESSION['user'];
     //$orders_list = "SELECT product.productID,product.productName,product.price,orderitems.orderID,orderitems.quantity,orderitems.totalprice FROM product product, orderitems orderitems, orders orders Where orderitems.ItemID = product.productID and orders.orderID = orderitems.orderID '".$user['userID']."'";
     $orders_list = "SELECT *   from orderitems oi where oi.orderID = '".$user['userID']."'";
      $query = mysqli_query($connection,$orders_list);
							if (mysqli_num_rows($query) > 0) 
							{
								while ($row=mysqli_fetch_array($query)) {
									?>
										<div class="row">
								
											<div class="col-md-6">
                      <div class="table-filter">
				<div class="row">
												
                              <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        
                        <th>CustomerID</th>
                      	<th>OrderId</th>
						            <th>Quantity</th>						
                      	<th>Net Amount</th>
					   </tr>
                </thead>
                <tbody>
                          <tr>
                            <td><?php echo $row["itemID"]; ?></td>
                            <td><?php echo $row["orderID"]; ?></td>
                        <td><?php echo $row["quantity"]; ?></td> 
                        <td><?php echo"$" .$row["totalprice"]; ?></td>                       
                        
                         
                          </tr>
                        </tbody>
                
											</div>
                                        </div>
                                        <?php
                                }
                            }
                        }
                        ?>
  
  </div>
</div>
                                 
									<?php 
								}
                            }
                        }
						?>
</div>
 </form> 
</section>

<!-- form end--------------------------------------------------------------------------------------------
------------------ -->
  <?php
    include_once ("partials/foot.php");
  ?>
  <script type="text/javascript" src="js/subcategory.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
</body>
</html>
