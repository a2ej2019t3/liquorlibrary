<?php
    include ('connection.php');

    $searchcontent = $_REQUEST['sc'];
    
    $searchProduct_sql = "SELECT productID, productName, img, categoryID, brandID FROM product WHERE title LIKE '%$searchcontent%' LIMIT 5";
    $searchProduct_res = mysqli_query($conn, $searchProduct_sql);
    $searchProduct_arr = mysqli_fetch_all($searchProduct_res);

    $searchBrand_sql = "SELECT newsID, newstitle, newsUrl FROM news WHERE newstitle LIKE '%$searchcontent%'";
    $searchBrand_res = mysqli_query($conn, $searchBrand_sql);
    $searchBrand_arr = mysqli_fetch_all($searchBrand_res);

    if ($searchcontent != "") {
            $imgpath = 'img/';

    // product result below
        if (count($searchProduct_arr != 0)) { 
            
            echo '<h6 class="dropdown-header">Product</h6>';

            for ($a = 0; $a < count($searchProduct_arr); $a++) {
                // change form action to desired php file 
                echo '
                    <form method="post" action="product_detail.php">
                    <input type="hidden" name="productid" value="'.$searchProduct_arr[$a][0].'">
                    <button class="dropdown-item" href="#" type="submit">
                        <div class="row">
                            <div id="posterarea" style="display:inline-block">
                                <img src='.$imgpath.$searchProduct_arr[$a][2].' style = "width: 35px; height:auto">
                            </div>
                            <div id="titlearea" style="display:inline-block; padding-left:5px;">
                                <p style="color:black"><b>'.$searchProduct_arr[$a][1].'</b><br><i>'.$searchProduct_arr[$a][4].'</i></p>
                            </div>
                        </div>
                    </button>
                    </form>
                ';
            }

        } else {
            echo "";
        }

    // brand result below
        if (count($searchBrand_arr != 0)) { 
                echo '<div class="dropdown-divider"></div>
                    <h6 class="dropdown-header">Brand</h6>
                    <ul class="list-group list-group-flush">
                    ';

            for ($b = 0; $b <count($searchBrand_arr); $b++) {
                echo '
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a class="dropdown-item" style="color:black" href="'.$searchBrand_arr[$b][2].'"><b>
                        '.$searchBrand_arr[$b][1].'
                        </b></a>
                        <span class="badge badge-primary badge-pill">new</span>
                    </li>
                ';
            }
                echo '
                    </ul>
                ';

        } else {
            echo "";
        }

        
    } else {
        echo "";
    }

    