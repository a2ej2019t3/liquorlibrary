
<?php
    // session_start();
    // $_SESSION['location'] = 'productlist';
    // $_SESSION['ref'] = $SERVER['QUERYSTRING'];
    include ('../connection.php');
    include(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
    $DBsql = new sql;
    // Sale product search 

    $searchSale_arr = $DBsql->select($DBsql->getProductInfo(), array('spec' => 'discountprice is not null'));
    // $searchSale_sql = "SELECT p.productID, p.img, p.productName, p.discountprice, p.price,p.categoryID, b.brandName, c.categoryName,c.categoryID FROM product AS p, brand AS b, category AS c WHERE p.brandID=b.brandID and p.categoryID=c.categoryID and p.discountprice is not null";
    // $searchSale_res = mysqli_query($connection, $searchSale_sql);
    // var_dump($searchSale_arr);
    if ($searchSale_arr != "") {
        $resultcount=count($searchSale_arr);
    } else {
        alert("result empty");
    }
 ?>

<?php
echo '
 <div class="container" style="padding-right: 45px;">
        <div style="text-align:left;"><i class="far fa-compass" style="margin: 10px 10px;"></i><a style="color: black!important; text-decoration: none!important;" href="index.php">Home / </a> <span> Sale products / '.$resultcount.' products</span></div>';
         
          if ($resultcount != "") {
            $imgpath = 'images/';
    
            if (count($searchSale_arr) != 0) { 
                echo '<div class="productcontent">
                <div class="product-grid product-grid--flexbox">
                    <div class="product-grid__wrapper">';

                for ($b = 0; $b <count($searchSale_arr); $b++) {
                    echo '
                        <div class="product-grid__product col-sm-6 col-md-4 col-lg-3" style="text-align: center; font-family: Montserrat, sans-serif;">
                            <div class="product-grid__img-wrapper" style="height: 185px; text-algin:center; ">			
                                     <img src='.$imgpath.$searchSale_arr[$b]['img'].' style="width: 120px; max-height: 170px;margin: 0 auto;">
                                 
                                        <div class="adminbuttons" id="adminbtsgroup">
                                            <button type="button" data-id='.$searchSale_arr[$b]['productID'].' class="customebts btn btn-secondary btn-sm" data-toggle="modal" data-target="#specialproductadd" style="color: rgba(48, 43, 41,1); background-color: transparent; border:none;">
                                            <i class="fas fa-thumbtack"></i>
                                            Specials
                                            </button>
                                        </div>
                                   
                                   
                             </div><br>
                            <div class="product-grid__title" style="font-size: 1.2rem;font-weight: 600;"><span>'.$searchSale_arr[$b]['productName'].'</span></div><br>';
                    echo   '<div class="product-grid__price"><span style="font-size:1.4rem;">NZ$'.$searchSale_arr[$b]['discountprice'].'</span> <span style="text-decoration: line-through; color:rgba(48, 43, 41,1); font-size:1rem;"> $'.$searchSale_arr[$b]['price'].'</span></div>';
                            
                            
                            
                       echo         '<div class="product-grid__extend" style="width:100%;">
                                     <div class="row">
                                     <div class="col-sm-6 col-md-6" style="padding:0!important;><button value='.$searchSale_arr[$b]['productID'].' onclick="addToCart(this.value)"><span class="product-grid__botton product-grid__add-to-cart"><i class="fa fa-cart-arrow-down"></i><br> Add to cart</span></button></div>
                                     <div class="col-sm-6 col-md-6" style="padding:0!important;"><a href="productlist.php?pid='.$searchSale_arr[$b]['productID'].'"><span class="product-grid__botton product-grid__view"><i class="fa fa-eye"></i><br>View more</span></a></div>

                                    </div>
                                    </div>
                              
                          
                        </div>';
                

                        
                }

             echo '</div>
                </div>';
            } else {
              
            }
    
        } else {
            ob_clean();
            echo '<p>No record found.</p>';
        }
        echo '
        </div>
        <section>
        <!-- -------------------------------------------------------------------------------------------------------- -->
        <!-- modal2> for type2 special product -->
        <!-- Modal -->
        ';
echo '<div class="modal fade" id="specialproductadd" tabindex="-1" role="dialog" >
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
                            <p><input type="hidden" id="postinput" name="postid">POST ID: <span id="postNumber" >  </span></p>
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
            </section>
            
            <style>
                    .adminbuttons{
                        position:absolute;
                        right: 5px;
                        top: 3px;
                        display:none;
                    }
                    
                    
                    .product-grid__img-wrapper:hover > .adminbuttons {
                        display: block;   
                    }
                    
                </style>
                <script>
                        $("#specialproductadd").on("show.bs.modal", function (e) {
                            var mypostNumber = $(e.relatedTarget).attr("data-id");
                            $(this).find("#postNumber").text(mypostNumber);
                            // $(this).find("#postinput").val(mypostNumber);
                            $("#postinput").val(mypostNumber);
                        });
                        </script>
                        ';