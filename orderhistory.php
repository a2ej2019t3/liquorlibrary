<?php
  session_start();
$_SESSION['location'] = 'customerorder';
include_once ('connection.php');
?>
<!DOCTYPE html>
 <html lang="en">
 <head>
<title>Order_History</title>
 </head>
 </html>
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
    include_once("./partials/header.php");
    
    ?>
</section>
<section>
<div>
    <p class="contactms">Customer Order Details</p>
	<hr style="color: black;">
	<!-- <div class="filter-group"> -->
  <!-- <div class="container_fluid">    -->
         <!-- <div class="productresult col-md-9 col-xs-12 content-right"> --> 
            <!-- product list results -->
            <div style="font-size:20px;">Status
            <select class="sortselecttest" name="sortselecttest" id="selectsort" style="width: 100px;margin-left: 15px;"> 
                                                <option data-target="order_customer_all" >All</option> -->
                                                <!-- <option data-target="" ></option>                             -->
                                                <option data-target="order_customer_pending">PENDING</option>
                                                <option data-target="order_customer_delivered" >DELIVERED</option>
                                                <option  data-target="order_customer_processing">PROCESSING</option>
                                                <option  data-target="order_customer_cancel">CANCELLED</option>
                                                <button type="submit"></button>
            </select>
            </div>
            <article id="contain">
            <?php
          //  include_once("example.php");
            ?>
                </article>  
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
