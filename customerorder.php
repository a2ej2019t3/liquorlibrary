<?php
  session_start();
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
													<tr><td>WhareHouseID</td><td><b><?php echo $row["whID"]; ?></b></td></tr>
													<tr><td>Date</td><td><b><?php echo $row["date"]; ?></b></td></tr>
											        <tr><td>Status</td><td><b><?php echo $row["status"]; ?></b></td></tr>
												</table>
											</div>
                                        </div>
                                        <p>
  <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    See More
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
      //$orders_list = "SELECT orders.orderID,orders.buyerID,orders.whID,orders.date,orders.status,product.productID,product.productName,product.price,orderitems.orderID FROM orders orders,product product, orderitems orderitems Where orders.orderID = '".$user['userID']."'";
      $orders_list = "SELECT *   from orderitems oi where oi.orderID = '".$user['userID']."'";
      $query = mysqli_query($connection,$orders_list);
							if (mysqli_num_rows($query) > 0) 
							{
								while ($row=mysqli_fetch_array($query)) {
									?>
										<div class="row">
								
											<div class="col-md-6">
												<table>
													<tr><td>ItemID</td><td><b><?php echo $row["itemID"]; ?></b> </td></tr>
													<tr><td>OrderID</td><td><b><?php echo $row["orderID"]; ?></b></td></tr>
													<tr><td>Quantity</td><td><b><?php echo $row["quantity"]; ?></b></td></tr>
													<tr><td>TotalPrice</td><td><b><?php echo"$" .$row["totalprice"]; ?></b></td></tr>
											        </table>
											</div>
                                        </div>
                                        <?php
                                }
                            }
                        }
                        ?>
  
  </div>
</div>
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Collapsible Group Item #1
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
      <table>
													<tr><td>OrderID</td><td><b><?php echo $row["orderID"]; ?></b> </td></tr>
													<tr><td>BuyerID</td><td><b><?php echo $row["buyerID"]; ?></b></td></tr>
													<tr><td>WhareHouseID</td><td><b><?php echo $row["whID"]; ?></b></td></tr>
													<tr><td>Date</td><td><b><?php echo $row["date"]; ?></b></td></tr>
											        <tr><td>Status</td><td><b><?php echo $row["status"]; ?></b></td></tr>
												</table>
      </div>
    </div>
  </div>
  <div class="card">                                  
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