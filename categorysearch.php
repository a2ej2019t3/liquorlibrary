<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['location'] == 'productlist';
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include_once ("partials/head.php");
    ?>
<title>Product_listbyCategory</title>
</head>
<body style="height: 110%;">
    <section>
        <?php
            include_once ("partials/header.php");
        ?>        
    </section>
    <br><br>
    <section id="main">
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
                    <article id="type_content">
                        <?php
                        if (isset($_GET['searchcategoryID']) && isset($_GET['searchcategoryName'])) {
                            $searchcategoryID = $_GET['searchcategoryID'];
                            $searchcategoryName = $_GET['searchcategoryName'];
                            include_once ('typesearch.php');
                        }
                        ?>
                    </article>
                </div>
            </div>
        </div>
    </section>
      <?php
          include_once ("partials/foot.php");
      ?>  
    <script type="text/javascript" src="js/sub.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/search.js"></script>
    <script type="text/javascript" src="js/cart.js"></script>
    <script type="text/javascript" src="js/product.js"></script>
</body>

</html>