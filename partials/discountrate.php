<?php
    // session_start();
    $_SESSION['location'] = 'productlist';
    include_once ('../connection.php');
    include(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
    $DBsql = new sql;
    // Sale product search 

    // onsalelist
    if (isset($_GET['location']) && $_GET['location'] == 'salelist') {
        if (isset($_GET['opt']) && $_GET['opt'] == 'all') {
            $product_arr = $DBsql->select($DBsql->getProductInfo(), array('spec' => 'discountprice is not null'));
        } else if (isset($_GET['opt']) && $_GET['opt'] == 'dr') {
            $product_arr = $DBsql->select($DBsql->getProductInfo(), array('spec' => 'discountprice is not null ORDER BY discountRate DESC'));
        } else if ($_GET['condition'] == 'ASC' || $_GET['condition'] == 'DESC') {
            $product_arr = $DBsql->select($DBsql->getProductInfo(), array('spec' => 'discountprice is not null ORDER BY discountprice '.$_GET['condition']));
        }
    }
    // typesearch
    else if (isset($_GET['searchcategoryID']) && isset($_GET['searchcategoryName'])) {
        $searchcategoryID = $_GET['searchcategoryID'];
        $searchcategoryName = $_GET['searchcategoryName'];
    
        $searchcontent = $searchcategoryID;
        // var_dump($searchcontent);
        $category= $searchcategoryName;
        $product_arr = $DBsql->select($DBsql->getProductInfo(), array('categoryID' => $searchcontent));
    }
    // saleproductprint
    else if (isset($_GET['location']) && $_GET['location'] == 'brandproduct') {
        //  Brand list 
        if (isset($_GET['brandname'])) {
            $searchcontent = "'".$_GET['brandname']."'";
            $product_arr = $DBsql->select($DBsql->getProductInfo(), array('brandName' => $searchcontent));
        } 
    }
    else if (isset($_GET['location']) && $_GET['location'] == 'priceRange') {
        $searchstart = $_GET['searchstart'];
        if (isset($_GET['searchend'])) {
            $searchend = $_GET['searchend'];
            $product_arr = $DBsql->select($DBsql->getProductInfo(), array('spec' => 'discountprice >= '.$searchstart.' AND discountprice <= '.$searchend));
            // var_dump($product_arr);
        } else {
            $searchend = '';
            $product_arr = $DBsql->select($DBsql->getProductInfo(), array('spec' => 'discountprice >='.$searchstart));
            // var_dump($product_arr);
        }
    }

    if ($product_arr != "") {
        $resultcount=count($product_arr);
    } else {
        // echo 'No result';
    }
    echo '
    <hr style="margin:0;">
    <div class="container_fluid">
        <div class="row">
    <!-- content body starts -->
        <div class="productresult col content-right">
    <!-- product list results -->';
    if (isset($_GET['brandname'])) {
    echo '
        <div>
            <span style="font-size:24px;">Shop By Brand </span>
            <hr>
        ';
    }
    echo '
    <section>
        <div class="container" style="padding-right: 45px;">
            <div style="text-align:left;"><i class="far fa-compass" style="margin: 10px 10px;"></i><a style="color: black!important; text-decoration: none!important;" href="index.php">Home / </a> <span> Sale Products / Discount Rate / '.$resultcount.' products</span>
            </div>';
          if ($resultcount != 0) {
            $imgpath = 'images/';
            if (count($product_arr) != 0) {
    echo '
            <div class="productcontent">
                <div class="product-grid product-grid--flexbox">
                    <div class="product-grid__wrapper">';
                for ($b = 0; $b <count($product_arr); $b++) {
                echo '
                        <div class="product-grid__product col-sm-6 col-md-4 col-lg-3" style="text-align: center; font-family: Montserrat, sans-serif;">
                            <div class="product-grid__img-wrapper" style="height: 185px; text-algin:center; ">';		
                                if ($product_arr[$b]['discountRate']>20) {
                echo '
                                    <div class="offer-form">                             
                                        <img src="images/specials.png" class="ribbon" style="width:75px; height: 60px; position:absolute; top: 0; left:0;">
                                        <button type="button" data-hover="'.round($product_arr[$b]['discountRate']).'%" class="discountbutton" data-active="ACTIVE"><span style="margin-left: -2px;">OFFER</span></button>
                                    </div>';
                echo '
                                    <div class="adminbuttons" id="adminbtsgroup">
                                        <button type="button" data-id='.$product_arr[$b]['productID'].' class="customebts btn btn-secondary btn-sm" data-toggle="modal" data-target="#specialproductadd" style="color: rgba(48, 43, 41,1); background-color: transparent; border:none;">
                                            <i class="fas fa-thumbtack"></i>
                                                Specials
                                        </button>
                                    </div>';
                                }
                echo '
                                    <img src='.$imgpath.$product_arr[$b]['img'].' style="width: auto; max-height: 170px;">';
                 
                echo '
                            </div>
                            <br>
                            <div class="product-grid__title" style="font-size: 1.2rem;font-weight: 600;"><span>'.$product_arr[$b]['productName'].'</span>
                            </div>
                            <br>';
                    if($product_arr[$b]['discountprice'] !==null ){
                echo '
                            <div class="product-grid__price">
                                <span style="font-size:1.4rem;">NZ$'.$product_arr[$b]['discountprice'].'</span> <span style="text-decoration: line-through; color:rgba(48, 43, 41,1); font-size:1rem;"> $'.$product_arr[$b]['price'].'</span>
                            </div>';
                    } else {
                echo '
                            <div class="product-grid__price">
                                <span style="font-size:1.4rem;">NZ$'.$product_arr[$b]['price'].'</span> 
                            </div>';
                    }
                echo '
                            <div class="product-grid__extend" style="width:100%; padding-bottom: 2px;">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6" style="padding:0!important;">
                                        <span class="product-grid__botton product-grid__add-to-cart" data-productID="'.$product_arr[$b]['productID'].'" onclick="addToCart(this)">
                                            <i class="fa fa-cart-arrow-down"></i><br> Add to cart
                                        </span>
                                    </div>
                                    <div class="col-sm-6 col-md-6" style="padding:0!important;">
                                        <a href="productlist.php?pid='.$product_arr[$b]['productID'].'">
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
        } else {
            ob_clean();
            echo '
            <hr style="margin-top:100px; margin-left:15px;">
            No result';
        }
    echo "
        </div>
    </section>";
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
//  modal for admin button
 echo '
 <section>
 <div class="modal fade" id="specialproductadd" tabindex="-1" role="dialog" >
     <div class="modal-dialog modal-sm" role="document">
     <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="specialproductadd">Add Special Product</h5>
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
                 <input type="submit" class="btn btn-secondary" value="UPLOAD" name="submit" style="text-align:center!important; margin:0 auto; background-color: rgba(48, 43, 41,1);"/>
                 <!-- <button type="submit" form="uploadimg" class="btn btn-primary"  name="submit">Submit</button> -->
             </div>
         </form>
     </div>
     </div>
 </div>
</section>';

echo '
<script>
$("#specialproductadd").on("show.bs.modal", function (e) {
    var mypostNumber = $(e.relatedTarget).attr("data-id");
    $(this).find("#postNumber").text(mypostNumber);
    // $(this).find("#postinput").val(mypostNumber);
    $("#postinput").val(mypostNumber);
});
</script>';

echo "
<style>
/* ------------------------------------------------------------------------------------------------- */
.adminbuttons{
    position:absolute;
    right: 90px;
    top: 3px;
    display:none;
}
.product-grid__img-wrapper:hover > .adminbuttons {
    display: block;   
}
/* .button */
.offer-form{
    width: 100%;
}

.product-grid__botton {
    margin:0;
}

.discountbutton {
    position: absolute;
    top: 5px;
    right: 0px;
    z-index: 10;
    text-decoration: none;
    font-size: 1em;
    outline: none;
    color:  #8B0000;
    border:none;
    background: transparent;
    font-family: 'Playfair Display', serif;
    font-weight: 600;
    border-radius: 200px;
    border:1px solid #8B0000;
    height: 58px;
    width: 58px;
    margin-right:5px;
}

.discountbutton span {
    -webkit-transition: 0.6s;
    -moz-transition: 0.6s;
    -o-transition: 0.6s;
    transition: 0.6s;
    -webkit-transition-delay: 0.2s;
    -moz-transition-delay: 0.2s;
    -o-transition-delay: 0.2s;
    transition-delay: 0.2s;
}

.discountbutton:before,
.discountbutton:after {
    position: absolute;
    top: 5px;
    right: 4px;
    z-index: 10;
    opacity: 0;
    color:  #8B0000;
    border:none;
    text-decoration: none;
    font-size: 1.8em;
    -webkit-transition: .4s,opacity .6s;
    -moz-transition: .4s,opacity .6s;
    -o-transition: .4s,opacity .6s;
    transition: .4s,opacity .6s;
}

/* :before */

.discountbutton:before {
    content: attr(data-hover);
    -webkit-transform: translate(-150%,0);
    -moz-transform: translate(-150%,0);
    -ms-transform: translate(-150%,0);
    -o-transform: translate(-150%,0);
    transform: translate(-150%,0);
}

/* :after */

.discountbutton:after {
    content: attr(data-active);
    -webkit-transform: translate(150%,0);
    -moz-transform: translate(150%,0);
    -ms-transform: translate(150%,0);
    -o-transform: translate(150%,0);
    transform: translate(150%,0);
}

/* Span on :hover and :active */

.discountbutton:hover span,
.discountbutton:active span {
    
    opacity: 0;
    -webkit-transform: scale(0.3);
    -moz-transform: scale(0.3);
    -ms-transform: scale(0.3);
    -o-transform: scale(0.3);
    transform: scale(0.3);
}

/*  
    We show :before pseudo-element on :hover 
    and :after pseudo-element on :active 
*/

.discountbutton:hover:before,
.discountbutton:active:after {
    opacity: 1;
    -webkit-transform: translate(0,0);
    -moz-transform: translate(0,0);
    -ms-transform: translate(0,0);
    -o-transform: translate(0,0);
    transform: translate(0,0);
    -webkit-transition-delay: .4s;
    -moz-transition-delay: .4s;
    -o-transition-delay: .4s;
    transition-delay: .4s;
}

/* 
  We hide :before pseudo-element on :active
*/

.discountbutton:active:before {
    -webkit-transform: translate(-150%,0);
    -moz-transform: translate(-150%,0);
    -ms-transform: translate(-150%,0);
    -o-transform: translate(-150%,0);
    transform: translate(-150%,0);
    -webkit-transition-delay: 0s;
    -moz-transition-delay: 0s;
    -o-transition-delay: 0s;
    transition-delay: 0s;
}
    </style>
    ";