<?php
    session_start();
    $_SESSION['location'] = 'productlist';
    if (isset($_SESSION['user'])) {
      $user = $_SESSION['user'];
    }
    include ('connection.php');
    // category search 

    $_SESSION['searchcategoryID'] = $_GET['searchcategoryID'];
    $_SESSION['searchcategoryName'] = $_GET['searchcategoryName'];

    $searchcontent = $_SESSION['searchcategoryID'];
    $category= $_SESSION['searchcategoryName'];
    $searchCategory_sql = "SELECT p.productID, p.img, p.productName, p.discountprice, p.price,p.categoryID, b.brandName, c.categoryName,c.categoryID FROM product AS p, brand AS b, category AS c WHERE p.brandID=b.brandID and p.categoryID=c.categoryID and c.categoryID = $searchcontent";
    $searchCategory_res = mysqli_query($connection, $searchCategory_sql);
    
    if ($searchCategory_res != "") {
        $searchCategory_arr = mysqli_fetch_all($searchCategory_res);
        $resultcount = count($searchCategory_arr);
    } else {
        alert("result empty");
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
                include_once ("typesearch.php");
                ?>
                </article>
        </div>

    </div>

</div>

</body>
<script>
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

<?php
    include_once ("partials/foot.php");
  ?>  
  <script type="text/javascript" src="js/sub.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
  <script type="text/javascript" src="js/cart.js"></script>

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->
</html>