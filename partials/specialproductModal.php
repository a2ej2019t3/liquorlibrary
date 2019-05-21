      <!-- modal2> for type2 special product -->
       <!-- Modal -->
      <?php
        $_SESSION['location'] = 'productlist';
        include ('../connection.php');
        // Sale product search 
        
    $_SESSION['postId'] = $_GET['pid'];
    $searchcontent = $_SESSION['postId'];
       
        $searchSale_sql = "SELECT p.productID, p.img, p.productName, p.discountprice, p.price,p.categoryID, b.brandName, c.categoryName,c.categoryID FROM product AS p, brand AS b, category AS c WHERE p.brandID=b.brandID and p.categoryID=c.categoryID and p.productID=$searchcontent";
        $searchSale_res = mysqli_query($connection, $searchSale_sql);
        
        if ($searchSale_res != "") {
            $searchSale_arr = mysqli_fetch_all($searchSale_res);
            $resultcount=count($searchSale_arr);
        } else {
            alert("result empty");
        }

      ?>
        
      <?php
echo
        '<div class="modal fade" id="specialproductadd" tabindex="-1" role="dialog" >
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="specialproductadd">Add Special Product</h5>
                      <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                      </button>
                    </div>
                    <form action="specialupload/upload.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                          
                    <div class="row modalrow"  style="text-align:left!important;">
                            <div class="formlable col-xm-12 col-sm-12 col-md-12 col-lg-12">
                            Post ID:'.$searchSale_arr[0].'
                            </div>
                        </div>

                        <div class="row modalrow"  style="text-align:left!important;">
                            <div class="formlable col-xm-12 col-sm-12 col-md-12 col-lg-12">
                            Special Product:
                            </div>
                            <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12">
                                <input class="specialinput" placeholder="'.$searchSale_arr[1].'" value="'.$searchSale_arr[1].'" type="text" name="productName"/>
                            </div>
                        </div>
                        
                      
                        <div class="row modalrow" style="text-align:left!important;">
                            <div class="formlable col-xm-12 col-sm-12 col-md-12 col-lg-12">
                                Price:
                            </div>
                            <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12">
                                <input class="specialinput" type="number" placeholder="'.$searchSale_arr[3].'" value="'.$searchSale_arr[3].'" name="price"/>
                            </div>
                        </div>

                        <!-- upload img here -->
                        <div class="row modalrow" style="text-align:left!important;">
                            <div class="formlable col-xm-12 col-sm-12 col-md-12 col-lg-12">
                                Select image to upload:
                            </div>
                            <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12">
                                <input type="file" name="file[]" multiple placeholder="'.$searchSale_arr[1].'" value="'.$searchSale_arr[1].'"/>
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
              </div>';
?>