<?php
    // session_start();
    $_SESSION['location'] = 'productlist';
    include ('connection.php');
    // Sale product search 

    $searchSale_sql = "SELECT p.productID, p.img, p.productName, p.discountprice, p.price,p.categoryID, b.brandName, c.categoryName,c.categoryID FROM product AS p, brand AS b, category AS c WHERE p.brandID=b.brandID and p.categoryID=c.categoryID and p.discountprice is not null ORDER BY p.discountprice ASC";
    $searchSale_res = mysqli_query($connection, $searchSale_sql);
    
    if ($searchSale_res != "") {
        $searchSale_arr = mysqli_fetch_all($searchSale_res);
        $resultcount=count($searchSale_arr);
    } else {
        // echo '<p>No record found.</p>';
    }
 ?>
<section>
    
    <?php
    
    include ('partials/saleproductprint.php');
    ?>
     </section>