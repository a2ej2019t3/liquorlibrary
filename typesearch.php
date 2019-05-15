<section>
        <div class="container" style="padding-right: 45px;">
     <center><h4 style="margin-top: 100px;"><hr>Bottle Shop</h4></center>
     <?php
        echo '<div style="text-align:left;"><i class="far fa-compass" style="margin: 10px 10px;"></i><a style="color: black!important; text-decoration: none!important;" href="index.php">Home / </a> <span>Category / '.$category.' / '.$resultcount.'products</span></div>';
         
          if ($searchcontent != "") {
            $imgpath = 'images/';
    
            if (count($searchCategory_arr) != 0) { 
                echo '<div class="productcontent">
                <div class="product-grid product-grid--flexbox">
                    <div class="product-grid__wrapper">';

                for ($b = 0; $b <count($searchCategory_arr); $b++) {
                    echo '
                        
                         
                        <div class="product-grid__product col-sm-6 col-md-4 col-lg-3" style="text-align: center; font-family: Montserrat, sans-serif;">
                            <div class="product-grid__img-wrapper" style="min-height: 185px; text-algin:center; ">			
                                     <img src='.$imgpath.$searchCategory_arr[$b][1].' style="width: 120px; max-height: 170px;margin: 0 auto;">
                             </div><br>
                            <div class="product-grid__title" style="font-size: 1.2rem;font-weight: 600;"><span>'.$searchCategory_arr[$b][2].'</span></div><br>';
                            if($searchCategory_arr[$b][3] !==null ){
                                echo      '<div class="product-grid__price"><span style="font-size:1.4rem;">NZ$'.$searchCategory_arr[$b][3].'</span> <span style="text-decoration: line-through; color:rgba(48, 43, 41,1); font-size:1rem;"> $'.$searchCategory_arr[$b][4].'</span></div>';
                            }
                            else {
                                echo      '<div class="product-grid__price"><span style="font-size:1.4rem;">NZ$'.$searchCategory_arr[$b][4].'</span> </div>';

                            }
                            
                       echo         '<div class="product-grid__extend" style="width:100%;">
                                     <div class="row">
                                        <div class="col-sm-6 col-md-6" style="padding:0!important;"><span class="product-grid__botton product-grid__add-to-cart"><i class="fa fa-cart-arrow-down"></i><br> Add to cart</span></div>
                                        <div class="col-sm-6 col-md-6" style="padding:0!important;"><span class="product-grid__botton product-grid__view"><i class="fa fa-eye"></i><br>View more</span></div>

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
            echo 0;
        }
     ?>
        </div>
     </section>