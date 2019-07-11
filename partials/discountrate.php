<?php
// session_start();
$_SESSION['location'] = 'productlist';
include_once('../connection.php');
include(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
$DBsql = new sql;
// product detail
if (isset($_GET['pd'])) {
    echo('here');
    $searchcontent = $_GET['pd'];

    $searchItem_sql = "SELECT p.productID, p.img, p.productName, p.discountprice, p.price,p.categoryID, b.brandName, c.categoryName,c.categoryID FROM product AS p, brand AS b, category AS c WHERE p.brandID=b.brandID and p.categoryID=c.categoryID and  p.productID = $searchcontent";
    $searchItem_res = mysqli_query($connection, $searchItem_sql);
    if ($searchItem_res != "") {
        $searchItem_arr = mysqli_fetch_all($searchItem_res);
        var_dump($searchItem_arr);
        $resultcount = count($searchItem_arr);
        $category = $searchItem_arr[0][7];
        $brandname = $searchItem_arr[0][6];
        $product_arr = $searchItem_arr;
    } else {
        alert("result empty");
    }
}

// onsalelist
if (isset($_GET['location']) && $_GET['location'] == 'salelist') {
    if (isset($_GET['opt']) && $_GET['opt'] == 'all') {
        $product_arr = $DBsql->select($DBsql->getProductInfo(), array('spec' => 'discountprice is not null'));
    } else if (isset($_GET['opt']) && $_GET['opt'] == 'dr') {
        $product_arr = $DBsql->select($DBsql->getProductInfo(), array('spec' => 'discountprice is not null ORDER BY discountRate DESC'));
    } else if ($_GET['condition'] == 'ASC' || $_GET['condition'] == 'DESC') {
        $product_arr = $DBsql->select($DBsql->getProductInfo(), array('spec' => 'discountprice is not null ORDER BY discountprice ' . $_GET['condition']));
    }
}
// typesearch
else if (isset($_GET['searchcategoryID']) && isset($_GET['searchcategoryName'])) {
    $searchcategoryID = $_GET['searchcategoryID'];
    $searchcategoryName = $_GET['searchcategoryName'];

    $searchcontent = $searchcategoryID;
    // var_dump($searchcontent);
    $category = $searchcategoryName;
    $product_arr = $DBsql->select($DBsql->getProductInfo(), array('categoryID' => $searchcontent));
}
// saleproductprint
else if (isset($_GET['location']) && $_GET['location'] == 'brandproduct') {
    //  Brand list 
    if (isset($_GET['brandname'])) {
        $searchcontent = "'" . $_GET['brandname'] . "'";
        $product_arr = $DBsql->select($DBsql->getProductInfo(), array('brandName' => $searchcontent));
    }
} else if (isset($_GET['location']) && $_GET['location'] == 'priceRange') {
    $searchstart = $_GET['searchstart'];
    if (isset($_GET['searchend'])) {
        $searchend = $_GET['searchend'];
        $product_arr = $DBsql->select($DBsql->getProductInfo(), array('spec' => 'discountprice >= ' . $searchstart . ' AND discountprice <= ' . $searchend));
        // var_dump($product_arr);
    } else {
        $searchend = '';
        $product_arr = $DBsql->select($DBsql->getProductInfo(), array('spec' => 'discountprice >=' . $searchstart));
        // var_dump($product_arr);
    }
}

if ($product_arr != "") {
    $resultcount = count($product_arr);
} else {
    // echo 'No result';
}

// product display area start
echo '
    <hr style="margin:0;">
    <div class="container_fluid">
        <div class="row">
        <div class="productresult col content-right">';
// show shop by brand title if view by brand
if (isset($_GET['brandname'])) {
    echo '
        <div>
            <span style="font-size:24px;">Shop By Brand </span>
            <hr>
        ';
}

// display all product
echo '
    <section>
        <div class="container">
            <div style="text-align:left;"><i class="far fa-compass" style="margin: 10px 10px;"></i><a style="color: black!important; text-decoration: none!important;" href="index.php">Home / </a> <span> Sale Products / Discount Rate / ' . $resultcount . ' products</span>
            </div>';
if ($resultcount != 0) {
    // define images path for localhost
    $imgpath = 'images/';
    // check if result is 0
    if (count($product_arr) != 0) {
        echo '
            <div class="productcontent">
                <div class="product-grid product-grid--flexbox">
                    <div class="product-grid__wrapper">';
        // loop through all products
        for ($b = 0; $b < count($product_arr); $b++) {
            echo '
                        <div class="product-grid__product col-sm-6 col-md-4 col-lg-3" style="text-align: center; font-family: Montserrat, sans-serif;">
                            <div class="product-grid__img-wrapper" style="height: 185px; text-algin:center; ">';
            // add discount number effect if discount rate greater than 20
            if ($product_arr[$b]['discountRate'] > 20) {
                echo '
                                    <div class="offer-form">                             
                                        <img src="images/specials.png" class="ribbon" style="width:75px; height: 60px; position:absolute; top: 0; left:0;">
                                        <button type="button" data-hover="' . round($product_arr[$b]['discountRate']) . '%" class="discountbutton" data-active="ACTIVE"><span style="margin-left: -2px;">OFFER</span></button>
                                    </div>';
                echo '
                                    <div class="adminbuttons" id="adminbtsgroup">
                                        <button type="button" value=' . $product_arr[$b]['productID'] . ' class="customebts btn btn-secondary btn-sm" onclick="openSpecialModal(this.value)" style="color: rgba(48, 43, 41,1); background-color: transparent; border:none;">
                                            <i class="fas fa-thumbtack"></i>
                                                Specials
                                        </button>
                                    </div>';
            }
            echo '
                                    <img src=' . $imgpath . $product_arr[$b]['img'] . ' style="width: auto; max-height: 170px;">';

            echo '
                            </div>
                            <br>
                            <div class="product-grid__title" style="font-size: 1.2rem;font-weight: 600;"><span>' . $product_arr[$b]['productName'] . '</span>
                            </div>
                            <br>';
            // format discount price if there is discount price
            if ($product_arr[$b]['discountprice'] !== null) {
                echo '
                            <div class="product-grid__price">
                                <span style="font-size:1.4rem;">NZ$' . $product_arr[$b]['discountprice'] . '</span> <span style="text-decoration: line-through; color:rgba(48, 43, 41,1); font-size:1rem;"> $' . $product_arr[$b]['price'] . '</span>
                            </div>';
                // just show original price if there isn't a discount price
            } else {
                echo '
                            <div class="product-grid__price">
                                <span style="font-size:1.4rem;">NZ$' . $product_arr[$b]['price'] . '</span> 
                            </div>';
            }
            echo '
                            <div class="product-grid__extend" style="width:100%; padding-bottom: 2px;">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6" style="padding:0!important;">
                                        <span class="product-grid__botton product-grid__add-to-cart" data-productID="' . $product_arr[$b]['productID'] . '" onclick="addToCart(this)">
                                            <i class="fa fa-cart-arrow-down"></i><br> Add to cart
                                        </span>
                                    </div>
                                    <div class="col-sm-6 col-md-6" style="padding:0!important;">
                                        <a href="./partials/discountrate.php?pd=' . $product_arr[$b]['productID'] . '">
                                            <span class="product-grid__botton product-grid__view">
                                                <i class="fa fa-eye"></i><br>View more
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>';
        }
        echo '
                    </div>
                </div>
            </div>
                ';
    }
    // show information of no result if data from db is null
} else {
    ob_clean();
    echo '
            <hr style="margin-top:100px; margin-left:15px;">
            No result';
}
echo "
        </div>";
if (isset($_GET['pd'])) {
    echo '
        <div class="container" style="margin-top: 100px;">
            <div class="suggestioncontainer" style=" margin: 5px auto; text-align: center; border-top: 1.5px solid rgba(244, 232, 117, 1); padding-top: 10px; width: 80%;">
                <span style="font-size:24px; font-weight: 600;"> We also suggest you... <br>
                <span style="font-size:18px; font-weight: 400;"> ' . $brandname . ' has more selections of ' . $category . '</span> </span>
            </div>';

    // Suggestions search
    $suggestItem_sql = "SELECT p.productID, p.img, p.productName, p.discountprice, p.price,p.categoryID, b.brandName, c.categoryName,c.categoryID FROM product AS p, brand AS b, category AS c WHERE p.brandID=b.brandID and p.categoryID=c.categoryID and  b.brandName = '$brandname' and c.categoryName= '$category'";
    $suggestItem_res = mysqli_query($connection, $suggestItem_sql);

    if ($suggestItem_res != "") {
        $suggestItem_arr = mysqli_fetch_all($suggestItem_res);
        $resultcount = count($suggestItem_arr);
    } else {
        alert("result empty");
    }
    echo '
    <section>
    ';
        if (count($suggestItem_arr) != 0) {
            $imgpath = 'images/';
            echo '<div class="productcontent">
                    <div class="product-grid product-grid--flexbox">
                        <div class="product-grid__wrapper">';

            for ($b = 0; $b < count($suggestItem_arr); $b++) {
                echo '
                            <div class="product-grid__product col-sm-6 col-md-4 col-lg-4" style="text-align: center; font-family: Montserrat, sans-serif;">
                                <div class="product-grid__img-wrapper" style="height: 185px; text-algin:center; ">			
                                         <img src=' . $imgpath . $suggestItem_arr[$b][1] . ' style="width: 120px; max-height: 170px;margin: 0 auto;">
                                 </div><br>
                                <div class="product-grid__title" style="font-size: 1.2rem;font-weight: 600;"> <span>' . $suggestItem_arr[$b][2] . '</span></div><br>';
                if ($suggestItem_arr[$b][3] !== null) {
                    echo '
                    <div class="product-grid__price"><span style="font-size:1.4rem;" > NZ$' . $suggestItem_arr[$b][3] . '</span> <span style="text-decoration: line-through; color:rgba(48, 43, 41,1); font-size:1 rem; " > $' . $suggestItem_arr[$b][4] . '</span></div>';
                } else {
                    echo '
                    <div class="product-grid__price"><span style="font-size:1.4rem;" > NZ$' . $suggestItem_arr[$b][4] . '</span> </div>';
                }

                echo '
                <div class="product-grid__extend" style="width:100%;">
                                            <div class="row">
                                                    <div class="col-sm-6 col-md-6" style="padding:0!important;">
                                                        <span class="product-grid__botton product-grid__add-to-cart" data-product ID="' . $searchItem_arr[$b][0] . '" onclick="addToCart(this)">
                                                            <i class="fa fa-cart-arrow-down"></i><br> Add to cart
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6" style="padding:0!important;">
                                                        <a href="productlist.php?pid=' . $searchItem_arr[$b][0] . '">
                                                            <span class="product-grid__botton product-grid__view">
                                                                <i class="fa fa-eye"></i><br>View more
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                        </div>
                                  
                              
                            </div>';
            }

            echo '</div>
                    </div>';
        } else {
            echo '<br><center><span> No record : 0 Product <span></center><br><br><br> ';
        }
        echo '
    </section>
    </div>';
    }

    echo "
    </section>";
    // display all product end
    if (isset($_GET['brandname'])) {
        echo '
    </div>
    ';
    }
    echo '
    </div>
    </div>
    </div>
    ';
    // modal for admin button
    echo '
    <section>
        <div class="modal fade" id="specialproductadd" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Special Product</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <form action="specialupload/uploadproduct.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row modalrow" style="text-align:left!important;">
                                <div class="formlable col-xm-12 col-sm-12 col-md-12 col-lg-12">
                                    <p><input type="hidden" id="postinput" name="postid">POST ID: <span id="postNumber"></span></p>
                                </div>
                            </div>

                            <div class="row modalrow" style="text-align:left!important;">
                                <div class="formlable col-xm-12 col-sm-12 col-md-12 col-lg-12">
                                    Special Deal information:
                                </div>
                                <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12">
                                    <textarea class="specialinput form-control" id="exampleFormControlTextarea1" rows="3" name="dealinfo"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="text-align:center!important;">
                            <input type="submit" class="btn btn-secondary" value="UPLOAD" name="submit" style="text-align:center!important; margin:0 auto; background-color: rgba(48, 43, 41,1);" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>';
    // modal end
