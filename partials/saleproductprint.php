<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include( dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
    $DBsql = new sql;
    //  Brand list 
    
        // $_SESSION['brandnamesearch'] = $_GET['brandname'];
        $searchcontent = "'".$_GET['brandname']."'";
        // echo $_GET['brandname'];

    // $searchcontent = $_SESSION['brandnamesearch'];

    $searchSale_arr = $DBsql->select($DBsql->getProductInfo(), array('brandName' => $searchcontent));
    $resultcount = count($searchSale_arr);
        echo '
        <div class="container_fluid">
        <div class="row">
<!-- content body starts -->
        <div class="productresult col-md-9 col-xs-12 content-right">
<!-- product list results -->
        <div style="margin-top: 100px; "><hr><span style="font-size:24px;">Shop By Brand </span>
        <hr>
        <section>
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
                                     <img src='.$imgpath.$searchSale_arr[$b][4].' style="width: 120px; max-height: 170px;margin: 0 auto;">
                             </div><br>
                            <div class="product-grid__title" style="font-size: 1.2rem;font-weight: 600;"><span>'.$searchSale_arr[$b][1].'</span></div><br>';
                    echo   '<div class="product-grid__price"><span style="font-size:1.4rem;">NZ$'.$searchSale_arr[$b][2].'</span> <span style="text-decoration: line-through; color:rgba(48, 43, 41,1); font-size:1rem;"> $'.$searchSale_arr[$b][3].'</span></div>';
                            
                            
                            
                       echo         '<div class="product-grid__extend" style="width:100%;">
                                     <div class="row">
                                        <div class="col-sm-6 col-md-6" style="padding:0!important;"><span class="product-grid__botton product-grid__add-to-cart"><i class="fa fa-cart-arrow-down"></i><br> Add to cart</span></div>
                                        <div class="col-sm-6 col-md-6" style="padding:0!important;"><a href="productlist.php?pid='.$searchSale_arr[$b][0].'"><span class="product-grid__botton product-grid__view"><i class="fa fa-eye"></i><br>View more</span></a></div>

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
        echo "</div>
        </div>
        </section>
        </div>
        </div>
        </div>
        </div>
        <style>
        .body{
            height: 100%;
            width: 100%;
            scroll-behavior: smooth;
            margin:0;
            padding:0;
            font-family: 'Montserrat', sans-serif;
        }
        .aphabetcontainer{
            border-top: 1.5px solid rgba(244, 232, 117, 1);
            padding-top:10px;
        }
        .alphabetbox{
            text-align:left;
            margin-bottom:0;
        }
        .alphatitle{
            text-align: left;
            font-family: 'Cinzel', serif;
            font-weight: 600;
            font-size: 2.9rem;
            margin-left: 75px;
        }
        
        .alphabetbutton{
            background-color: transparent;
            border: none;
            color: rgba(48, 43, 41,1);
            margin: 10px auto;
         }
         .alphabetbutton:hover{
             color: rgba(224, 184, 65, 1);
         }
        
        </style>";
