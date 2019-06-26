<?php
session_start();
$_SESSION['location'] = 'update';
include_once('connection.php');
include_once('database/DBsql.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>updateInfo</title>
	<?php
	include_once("./partials/head.php");
	?>
	<link rel="stylesheet" href="css/index.css">
	<style type="text/css">
		.status {
			font-size: 30px;
			margin: 2px 2px 0 0;
			display: inline-block;
			vertical-align: middle;
			line-height: 10px;
		}
	</style>
</head>
<body>
	<section>
		<?php
		include_once("./partials/header.php");
		?>
	</section>

	<section>
		<br><br><br>
		<div>
			<p class="contactms">store Information</p>
			<hr style="color: black;">
			<div class="filter-group">
				<div class="container_fluid">
					<!-- <div class="box-header with-border">
						<h4 class="box-title"><i class="fa fa-calendar"></i> <b>StoreDetails</b></h4>
					</div> -->
					<article id="content">

					</article>
				</div>
				<?php

				if (isset($_SESSION['user'])) {
					$user = $_SESSION['user'];
					//$orders_list = "SELECT product.productID,product.productName,product.price,orderitems.orderID,orderitems.quantity,orderitems.totalprice FROM product product, orderitems orderitems, orders orders Where orderitems.ItemID = product.productID and orders.orderID = orderitems.orderID '".$user['userID']."'";
                    echo $_SESSION['warehouse']['whID'];
                    $whID=$_SESSION['warehouse']['whID'];
                    $orders_list =  "SELECT * from warehouse w where w.whID = '$whID'";
					$query = mysqli_query($connection, $orders_list);
					if (mysqli_num_rows($query) > 0)
					{
						$orderRow = mysqli_fetch_all($query, MYSQLI_ASSOC);
						//var_dump($orderRow);
						?>
						<!-- </div> -->

						<div class="box-body">
							<table class="table table-striped table-hover">
								<thead>
									<div><th>StoreID</th></div>
									<th>StoreName</th>
									<th>Address</th>
									<th>Phone</th>
									<div><th>Email</th></div>
								</thead>
								<tbody>
									<?php
									//var_dump(count($orderRow));
									for ($i = 0; $i < count($orderRow); $i++) {
										//var_dump($i);
										echo '
										<tr>
											<td>' . $orderRow[$i]["whID"] . '</td>
											<td>' . $orderRow[$i]["whName"] . '</td>
											<td>' . $orderRow[$i]["address"] . '</td> 
											<td>' . $orderRow[$i]["phone"] . '</td>	
											<td>' . $orderRow[$i]["email"] . '</td>
											                      
										</tr>';
									} ?>
								</tbody>
							</table>
							<?php
						
							for ($i = 0; $i < count($orderRow); $i++) {

								echo '
										<div class="collapse" id="collapseExample'.$orderRow[$i]["whID"].'">
										<div class="card card-body">
											<div class="row">
												<div class="box box-solid">
													<div class="box-header with-border">
														<h4 class="box-title"><i class="fa fa-calendar"></i> <b>Order Details</b></h4>
													</div>
													<div class="box-body">
														<table class="table table-striped table-hover">
															<thead>
															 
																<th>UserID</th>
																<th>FirstName</th>
																<th>LastName</th>
																<th>phone</th>
																<th>Email</th>

																
															</thead>
															<tbody>';

								$DBsql = new sql;
								$rows = $DBsql->getCartItemsInfo($orderRow[$i]["userID"], $user['userID']);
								// var_dump($row);

								for ($j = 0; $j < count($rows); $j++) {

									//var_dump($rows[$j]);
									echo '
																	<tr>
																		
																		
																		<td>' . $rows[$j]["userID"] . '</td>
																		<td>' . $rows[$j]["firstName"] . '</td>
																		<td>' .$rows[$j]["lastName"] .'</td>
																		<td>' . $rows[$j]["phone"] . '</td> 
																		<td>' . $rows[$j]["email"] . '</td>
																		</tr>';

								}

								echo'	</tbody>
								</table>
							</div>
							</div>
						</div>
					</div>
					</div>';
							}
							
							
						}
					}

					?>
				</div>

			</div>

	</section>
	<!-- form end--------------------------------------------------------------------------------------------
		------------------ -->
	<?php
	// include_once ("partials/foot.php");
	?>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/subcategory.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/search.js"></script>
	<script type="text/javascript" src="js/sub.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/search.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
	<script>
		$(document).ready(function() {
			// Set trigger and container variables
			var trigger = $('.sortselecttest');
			// container = $('#contain');

			// Fire on click
			trigger.on('click', function() {
				// Set $this for re-use. Set target from data attribute
				var $this = $(this),
					target = $this.find(':selected').data('target');

				console.log(target);

				// Load target page into container
				$('#contain').load(target + '.php');
				// Stop normal link behavior
				return false;
			});
		});
	</script>
</body>

</html>