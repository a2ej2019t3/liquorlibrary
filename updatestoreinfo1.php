<?php 
session_start();
   $_SESSION['location'] = 'updatestoreinfo1';
   include_once('connection.php');
   include_once('database/DBsql.php');
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Branch Admin Dashboard</title>
    <?php
     include_once ("partials/head.php");
    ?>
    <link rel="stylesheet" href="css/branchreport.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   
    
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<!-- <section>
        <?php
            include_once ("partials/header.php");
        ?>        
</section> -->
<div class="well">
    <ul class="nav nav-tabs">
      <li ><a href="#home" data-toggle="tab" class="mytabs">Store Information</a></li>
      <li ><a href="#update" data-toggle="tab" class="mytabs">Manager Info</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab">
        <div class="card1">
		        <div class="card-body">
        <div class="col-sm-3">
	        							<h4>StoreID:</h4>
                        <h4>StoreName:</h4>
	        							
	        							<h4>Contact Info:</h4>
                        <h4>Email:</h4>
	        							<h4>Address:</h4>
	        		</div>
              </div>
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
?>

<?php
									//var_dump(count($orderRow));
									for ($i = 0; $i < count($orderRow); $i++) {
										//var_dump($i);
										echo '
										<tr>
											<h6><td>' . $orderRow[$i]["whID"] . '</td></h6>
											<h6><td>' . $orderRow[$i]["whName"] . '</td></h6>
										
											<h6><td>' . $orderRow[$i]["phone"] . '</td>	</h6>
											<h6><td>' . $orderRow[$i]["email"] . '</td></h6>
                      <h6><td>' . $orderRow[$i]["address"] . '</td> </h6>                     
										</tr>';
									} ?>
          
        </form>
      </div>
      <div class="tab-pane in" id="update">
    	<form id="tab2">
      <div class="col-md-9">
		    <div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <h4>Your Profile</h4>
		                    <hr>
		                </div>
		            </div>
		            <div class="row">
		                <div class="col-md-12">
		                    <form>
                        <div class="box box-solid">
	        			<div class="box-body">
	        				<div class="col-sm-9">
	        					<div class="row">
	        						<div class="col-sm-3">
	        							<h4>Name:</h4>
	        							<h4>Email:</h4>
	        							<h4>Contact Info:</h4>
	        							<h4>Address:</h4>
	        							<!-- <h4>Member Since:</h4> -->
	        						</div>
                      </div>
	        						<div class="col-sm-9">
                      <?php
                      if (isset($_SESSION['user'])) {
      $user = $_SESSION['user'];
      //$orders_list = "SELECT product.productID,product.productName,product.price,orderitems.orderID,orderitems.quantity,orderitems.totalprice FROM product product, orderitems orderitems, orders orders Where orderitems.ItemID = product.productID and orders.orderID = orderitems.orderID '".$user['userID']."'";
                echo $_SESSION['user']['userID'];
               $userID=$_SESSION['user']['userID'];
                $orders_list =  "SELECT * from users u where u.userID = '$userID'";
      $query = mysqli_query($connection, $orders_list);
      if (mysqli_num_rows($query) > 0)
      {
        $orderRow = mysqli_fetch_all($query, MYSQLI_ASSOC);
        ?>
        	        						<!-- <h4><?php echo $user['firstName'].' '.$user['lastName']; ?> -->
	        								<span class="pull-right">
	        									<a href="#edit" class="btn btn-success btn-flat btn-sm" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>
	        								</span>
            							<!-- </h4> -->
                       
                          <?php
									//var_dump(count($orderRow));
									for ($i = 0; $i < count($orderRow); $i++) {
										//var_dump($i);
										echo '
										<tr>
										
											<h6><td>' . $orderRow[$i]["firstName"] . '</td></h6>
											<h6><td>' . $orderRow[$i]["email"] . '</td></h6>
											<h6><td>' . $orderRow[$i]["phone"] . '</td>	</h6>
										
                      <h6><td>' . $orderRow[$i]["address"] . '</td> </h6>                     
										</tr>';
									} ?>
	        						</div>
	        					</div>
	        				</div>
	        			</div>
	        		</div>
                            </form>
		                </div>
		            </div>
		            
		        </div>
		    </div>
		</div>
    	</form>
      </div>
  </div>
  
  <?php
    include_once ("partials/foot.php");
   
   
  ?>  
  <?php
  include_once ("profile_modal1.php");
  ?>
  
  <!-- <script type="text/javascript" src="js/sub.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
  -->
  
  </body>
</html>
<?php
 }
    }
    ?>
    <?php
      }
    }
    ?>

<style>
.nav>li>a:hover, .nav>li>a:focus {
    text-decoration: none;
    background-color: yellow!important;
}
</style>