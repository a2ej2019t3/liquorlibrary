<?php
    session_start();
    $_SESSION['location'] = 'productlist';
    include ('connection.php');

    $searchstart = $_POST['searchstart'];
    $searchend = $_POST['searchend'];
    $searchPrice_sql ="SELECT p.productID, p.img, p.productName, p.discountprice, p.price,p.categoryID, b.brandName, c.categoryName,c.categoryID FROM product AS p, brand AS b, category AS c WHERE p.brandID=b.brandID and p.categoryID=c.categoryID and discountprice BETWEEN $searchstart AND $searchend";
    $searchPrice_res = mysqli_query($connection, $searchPrice_sql);
    
    if ($searchPrice_res != "") {
        $searchPrice_arr = mysqli_fetch_all($searchPrice_res);
        $resultcount=count($searchPrice_arr);
    } else {
        
    }
?>


 <!DOCTYPE html>
 <html lang="en">
 <head>
 <?php
    include_once ("partials/head.php");
  ?>
 
<title>Product_listbyCategory</title>
 </head>
 <body>
     <section>
        <?php
            include_once ("partials/header.php");
        ?>        
     </section>
     <br><br>
    <?php
    include ("Cart/stickycart.php");
    ?>
<div class="container_fluid">
    <div class="row">
<!-- content body starts -->
        <div class="sidenavbar col-md-3 col-xs-12 content-left" style="text-align:center;">
            <!-- sideNave -->
                <?php
                    include_once ("partials/sideNav.php");
                ?>
        </div>

        <div class="productresult col-md-9 col-xs-12 content-right">
            <!-- product list results -->
               <article id="content">
                <?php
                include_once ("priceresult.php");
                ?>
                </article>
        
        </div>

    </div>

</div>

 </body>
 <?php
    include_once ("partials/foot.php");
  ?>
  
  
    <script>
        //
        $( document ).ready(function() {
            $("#pricelist").css({ display: "block" });
            });
           
        // Ajax test
      $(document).ready(function(){
        // Set trigger and container variables
        var trigger = $('.pricetrigger'),
            container = $('#content');
        
        // Fire on click
        trigger.on('click', function(){
          // Set $this for re-use. Set target from data attribute
          var $this = $(this),
            target = $this.find(':submitted').data('target');       
          
          // Load target page into container
          container.load(target + '.php');
          
          // Stop normal link behavior
          return false;
        });
      });
    </script>
  <script type="text/javascript" src="js/subcategory.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
 </html>