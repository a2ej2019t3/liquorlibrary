<?php
session_start();
if(!isset($_SESSION['user'])){
	//header("location:index.php");
}
?>

	<div class="container-fluid">
	
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading"></div>
					<div class="panel-body">
						<?php
						include_once("./partials/header.php");
						include_once("./partials/head.php");
						?>
						<h1>Customer Order details</h1>
						<hr/>
						<?php
						
						 include_once("connection.php");
							$user = $_SESSION['user'];
							$orders_list = "SELECT orders.orderID,orders.buyerID,orders.whID,orders.date,orders.status,product.productID,product.productName,product.price,orderitems.orderID FROM orders orders,product product, orderitems orderitems Where orders.orderID = '".$user['userID']."'";
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
									<?php
								}
							}
						?>
						<?php echo  "please login" ?>
						
											</div>
					<div class="panel-footer"></div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</body>
</html>
















































