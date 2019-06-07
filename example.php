<?php
  //session_start();
$_SESSION['location'] = 'customerorder';
include_once ('connection.php');
?>
<!DOCTYPE html>
 <html lang="en">
 <head>
 <?php
    include_once ("partials/head.php");
  ?>
 
<title>Order_History</title>

 </head>
 <body>
     <section>
        <?php
            include_once ("partials/header.php");
        ?>        
     </section>
     <br><br>

 
   
 </body>


 </html>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Order Details</title>

<?php
    include_once ("./partials/head.php");
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
    include_once ("./partials/header.php");
    ?>
</section>
  
<section>
    <br><br><br>
<div>
    <p class="contactms">My Total Orders</p>
	<hr style="color: black;">
	<div class="filter-group">
  <div class="container_fluid">
    

</div>
							
    
  
  <?php

  if(isset($_SESSION['user'])){
      $user = $_SESSION['user'];
     //$orders_list = "SELECT product.productID,product.productName,product.price,orderitems.orderID,orderitems.quantity,orderitems.totalprice FROM product product, orderitems orderitems, orders orders Where orderitems.ItemID = product.productID and orders.orderID = orderitems.orderID '".$user['userID']."'";
     $orders_list =  "SELECT * from orders o where o.buyerID = '".$user['userID']."'";
      $query = mysqli_query($connection,$orders_list);
							if (mysqli_num_rows($query) > 0) 
							{
                            $row=mysqli_fetch_all($query, MYSQLI_ASSOC);
                            //var_dump($row);
									?>
										
										
	        			<div class="box-header with-border">
                  <h4 class="box-title"><i class="fa fa-calendar"></i> <b>Order History</b></h4>

                  
            </div>
            <article id="content">
                <?php
              //include_once ("customerorder.php");
                  //include_once ("example.php");
                ?>
                </article>
        
        </div>

   			<div class="box-body">
						<table class="table table-striped table-hover">
	        					<thead>
									
									    
	        						<th>orderID</th>
	        						<th>BuyerID</th>
	        						<th>wharehouse</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Full details</th>
	        					</thead>
	        					<tbody>
              <?php
              for ($i = 0; $i < count($row) ;$i++) {
                echo '
                <tr>
                
                            <td>'.$row[$i]["orderID"].'</td>
                            <td>'.$row[$i]["buyerID"].'</td>
                            <td>'.$row[$i]["whID"].'</td> 
              <td>'.$row[$i]["date"].'</td>	
             
             <td>'.$row[$i]["status"].'</td>
              // <td><a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search"></i> View</button></td>                      
                </tr>
                ';
              }
              ?>
	        					</tbody>
	        				</table>
	        			</div>
	        		</div>
                	</div>
                </div>                      
                <?php 
                            }
                        }
			?>			
  </div>
  
</div>
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
                                $row=mysqli_fetch_all($query, MYSQLI_ASSOC); {
                                      ?>
                                          <div class="row">
                                          <div class="box box-solid">
                          <div class="box-header with-border">
                              <h4 class="box-title"><i class="fa fa-calendar"></i> <b>Order Details</b></h4>
                          </div>
                          <div class="box-body">
                          <table class="table table-striped table-hover">
                                  <thead>
                                  <th>ProductName</th>
                                    <th>ItemID</th>
                                     <th>OrderID</th>
                                      <th>Quantity</th>
                                      <th>Net Amount</th>
                                    </thead>
                                  <tbody>
                                  <?php
              for ($i = 0; $i < count($row) ;$i++) {
                echo '
                <tr>
                             <td>'.$row[$i]["itemID"].'</td>
                            <td>'.$row[$i]["orderID"].'</td>
                            <td>'.$row[$i]["quantity"].'</td> 
              <td>"$"'.$row[$i]["totalprice"].'</td>
              ';
              }	
                                  ?>
                                  </tr>
                               <?php   
	
                                  }

                                }
                            }

?>
</form> 
</section>
<!-- form end--------------------------------------------------------------------------------------------
------------------ -->
  <?php
    // include_once ("partials/foot.php");
  ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/subcategory.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/search.js"></script>
    <script type="text/javascript" src="js/sub.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/search.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
      $(document).ready(function(){
        // Set trigger and container variables
        var trigger = $('.sortselecttest');
            // container = $('#contain');
            
        // Fire on click
        trigger.on('click', function(){
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
