<?php
    include ('../connection.php');

    $searchcontent = $_REQUEST['sc'];
    
    //search product
    $searchProduct_sql = 
        "SELECT searchProduct.productName, searchProduct.productID, searchProduct.price, searchProduct.discountprice, searchProduct.img, searchProduct.categoryName, searchProduct.brandName 
        FROM (SELECT product.productName, product.productID, product.price, product.discountprice, product.img, brand.brandName, category.categoryName 
                FROM product LEFT JOIN brand ON product.brandID = brand.brandID
                LEFT JOIN category ON product.categoryID = category.categoryID
            ) AS searchProduct 
            WHERE searchProduct.productName LIKE '%$searchcontent%' LIMIT 5";

    $searchProduct_res = mysqli_query($connection, $searchProduct_sql);
    if ($searchProduct_res) {
        $searchProduct_arr = mysqli_fetch_all($searchProduct_res);
    }
    //search brand
    $searchBrand_sql = "SELECT brandID, brandName, img FROM brand WHERE brandName LIKE '%$searchcontent%' LIMIT 6";
    $searchBrand_res = mysqli_query($connection, $searchBrand_sql);
    if ($searchProduct_res) {
        $searchBrand_arr = mysqli_fetch_all($searchBrand_res);
    }

    // search category
    // $searchCategory_sql = "SELECT brandID, brandName, img FROM category WHERE categoryName LIKE '%$searchcontent%'";
    // $searchCategory_res = mysqli_query($connection, $searchCategory_sql);
    // $searchCategory_arr = mysqli_fetch_all($searchCategory_res);


    if ($searchcontent != "") {
            $imgpath = 'images/';
            $tagForCategory = 'Category: ';
            $tagForBrand = 'Brand: ';
    // product result below
    
    echo '<div>
        <h6 class="dropdown-header">Product</h6>';
    
        if (count($searchProduct_arr) > 0) { 
            for ($a = 0; $a < count($searchProduct_arr); $a++) {
                // change form action to desired php file 
                // class="container-fluid" method="POST" action="productlist.php"
                echo '<a class="dropdown-item" href="productlist.php?pid='.$searchProduct_arr[$a][1].'">
                        <div class="row">
                            <div id="posterarea" style="display:inline-block">
                                <img src='.$imgpath.$searchProduct_arr[$a][4].' style = "width: 35px; height:auto">
                            </div>
                            <div id="titlearea" style="display:inline-block; padding-left:5px;">
                                <p style="color:black">
                                <b>'.$searchProduct_arr[$a][0].'</b><br>
                                <i>'.$tagForCategory.$searchProduct_arr[$a][5].'</i><br>
                                <i>'.$tagForBrand.$searchProduct_arr[$a][6].'</i>
                                </p>
                            </div>
                        </div>
                    </a>';
            }

        } else {
            echo '
                <a class="dropdown-item disabled" href="#" tabindex="-1">No result</a>
            ';
        }

    // brand result below
    echo '<div class="dropdown-divider"></div>
    <h6 class="dropdown-header">Brand</h6>
    ';
    
        if (count($searchBrand_arr) > 0) {
            $resCount = count($searchBrand_arr);
            for ($b = 0; $b < count($searchBrand_arr); $b++) {
                echo '
                    <form method="post" action="productListPage.php">
                    <input type="hidden" name="brandID" value="'.$searchBrand_arr[$b][0].'">
                    <a class="dropdown-item" href="brandsearch.php?brandname='.$searchBrand_arr[$b][1].'" type="submit">
                        <div class="row">
                            <div id="posterarea" style="display:inline-block">
                               
                            </div>
                            <div id="titlearea" style="display:inline-block; padding-left:5px;">
                                <p style="color:black"><b>'.$searchBrand_arr[$b][1].'</b></p>
                            </div>
                        </div>
                    </a>
                    </form>
                ';
            }

        } else {
            echo '<a class="dropdown-item disabled" href="#" tabindex="-1">No result</a>';
        }
    echo '</div>';
    } else {
        // ob_clean();
        echo 0;
    }

    