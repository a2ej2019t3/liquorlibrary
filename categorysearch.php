<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['location'] = 'productlist';
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include_once ("partials/head.php");
        // include ("database/DBsql.php");
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
                    <div id="pricesortDropdown" style="margin-top: 100px; "><hr><span style="font-size:24px;">Sale products</span>
                        <select onchange="checkChange(this)" class="sortselect" name="sortselect" id="selectsort" style="width: 300px;margin-left: 15px;">                             
                            <option data-target="onsalelist" selected="true" >ALL ITEMS</option>
                            <option data-target="discountrate" >BY DISCOUNT RATE</option>
                            <option data-target="saleproductprint" value="ASC">BY LOW PRICE</option>
                            <option data-target="saleproductprint" value="DESC" onclick="pricesorthigh()">BY HIGH PRICE</option>
                            <button type="submit"></button>
                        </select>
                    </div>
                <!-- product list results -->
                    <article id="productArea">
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
    <script type="text/javascript" src="js/product.js"></script>
    <script type="text/javascript" src="js/cart.js"></script>
</body>

</html>
