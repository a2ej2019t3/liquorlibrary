<?php
    include ('connection.php');

    $searchcontent = $_REQUEST['sc'];
    
    //search product
    $searchProduct_sql = "SELECT productID, productName, img, categoryID, brandID FROM product WHERE productName LIKE '%$searchcontent%' LIMIT 5";
    $searchProduct_res = mysqli_query($connection, $searchProduct_sql);
    if ($searchProduct_res != "") {
        $searchProduct_arr = mysqli_fetch_all($searchProduct_res);
    } else {
        
    }

    //search brand
    $searchBrand_sql = "SELECT brandID, brandName, img FROM brand WHERE brandName LIKE '%$searchcontent%' LIMIT 5";
    $searchBrand_res = mysqli_query($connection, $searchBrand_sql);
    $searchBrand_arr = mysqli_fetch_all($searchBrand_res);

    // search category
    // $searchCategory_sql = "SELECT brandID, brandName, img FROM category WHERE categoryName LIKE '%$searchcontent%'";
    // $searchCategory_res = mysqli_query($connection, $searchCategory_sql);
    // $searchCategory_arr = mysqli_fetch_all($searchCategory_res);


    if ($searchcontent != "") {
        $imgpath = 'img/';
        echo '
            
        ';
    }