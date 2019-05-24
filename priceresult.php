<section>
        <div class="container" style="padding-right: 45px;">
            
     <center><h4 style="margin-top: 100px;"><hr>Price : <?php echo '<span style="color:#8B0000; font-size: 1.2rem; font-weight:600; ">NZ$'.$searchstart.'~NZ$'.$searchend.'</span>' ?></h4></center>
     <?php
        echo '<div style="text-align:left;"><i class="far fa-compass" style="margin: 10px 10px;"></i><a style="color: black!important; text-decoration: none!important;" href="index.php">Home / </a> <span> Price / '.$resultcount.'products</span></div>';
         
          if ($searchPrice_arr != "") {
            $imgpath = 'images/';
    
            if (count($searchPrice_arr) != 0) { 
                echo '<div class="productcontent">
                <div class="product-grid product-grid--flexbox">
                    <div class="product-grid__wrapper">';

                for ($b = 0; $b <count($searchPrice_arr); $b++) {
                    echo '
                        
                         
                        <div class="product-grid__product col-sm-6 col-md-4 col-lg-3" style="text-align: center; font-family: Montserrat, sans-serif;">
                            <div class="product-grid__img-wrapper" style="height: 185px; text-algin:center; ">			
                                     <img src='.$imgpath.$searchPrice_arr[$b][1].' style="width: 120px; max-height: 170px;margin: 0 auto;">
                             </div><br>
                            <div class="product-grid__title" style="font-size: 1.2rem;font-weight: 600;"><span>'.$searchPrice_arr[$b][2].'</span></div><br>
                             <div class="product-grid__price"><span style="font-size:1.4rem;">NZ$'.$searchPrice_arr[$b][3].'</span> <span style="text-decoration: line-through; color:rgba(48, 43, 41,1); font-size:1rem;"> $'.$searchPrice_arr[$b][4].'</span></div>
                            
                                    <div class="product-grid__extend" style="width:100%;">
                                     <div class="row">
                                     <div class="col-sm-6 col-md-6" style="padding:0!important;><button value="'.$searchPrice_arr[$b][0].'" onclick="addToCart(this.value)"><span class="product-grid__botton product-grid__add-to-cart"><i class="fa fa-cart-arrow-down"></i><br> Add to cart</span></button></div>
                                     <div class="col-sm-6 col-md-6" style="padding:0!important;"><a href="productlist.php?pid='.$searchPrice_arr[$b][0].'"><span class="product-grid__botton product-grid__view"><i class="fa fa-eye"></i><br>View more</span></a></div>

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
            echo 'empty';
        }
     ?>
        </div>
     </section>