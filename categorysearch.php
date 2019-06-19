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
    <br>
    <section id="main">
        <?php
            include ("Cart/stickycart.php");
            ?>
        <div class="container_fluid">
            <div class="row" style="margin-left:-30px;">
                <!-- content body starts -->
                <div class="sidenavbar col-md-3 col-xs-12 content-left" style="text-align:center;">
                    <!-- sideNave -->
                    <?php
                        include_once ("partials/sideNav.php");
                        ?>
                </div>
                <div class="productresult col" style="margin-top:100px">
                    <hr style="margin:0;">
                    <div id="pricesortDropdown" style="padding:10px 0 10px;">
                        <span style="font-size:24px;">Sale products</span>
                        <select onchange="checkIfSelected()" class="sortselect" name="sortselect" id="selectsort" style="width: 300px;margin-left: 15px;">                                
                            <option id="Op0" data-target="onsalelist" selected="true" >ALL ITEMS</option>
                            <option id="Op1" data-target="discountrate" >BY DISCOUNT RATE</option>
                            <option id="Op2" data-target="saleproductprint" value="ASC">BY LOW PRICE</option>
                            <option id="Op3" data-target="saleproductprint" value="DESC">BY HIGH PRICE</option>
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
    <script type="text/javascript" src="js/pay.js"></script>
</body>

</html>
