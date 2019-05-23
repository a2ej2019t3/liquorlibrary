<link href="https://fonts.googleapis.com/css?family=Handlee|Kalam|Marck+Script&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script&display=swap&subset=latin-ext" rel="stylesheet">
<?php
    // session_start();
    $_SESSION['location'] = 'productlist';
    // $_SESSION['ref'] = $SERVER['QUERYSTRING'];
    include ('connection.php');
    // Sale product search 

    $searchSale_sql = "SELECT `specialId`, `specialName`, `specialType`, `specialPrice`, `specialInfo`, `specialImg`, `startTime`, `finishTime`, `productID` FROM `specials` WHERE  `specialType`=2";
    $searchSale_res = mysqli_query($connection, $searchSale_sql);
    
    if ($searchSale_res != "") {
        $searchSale_arr = mysqli_fetch_all($searchSale_res);
        $resultcount=count($searchSale_arr);
    } else {
        alert("result empty");
    }
 ?>

 <div class="container" style="padding-right: 45px;">
     <?php
        echo '<div style="text-align:left;"><i class="far fa-compass" style="margin: 10px 10px;"></i><a style="color: black!important; text-decoration: none!important;" href="index.php">Home / </a> <span> Specials / '.$resultcount.' products</span></div>';
         
          if ($resultcount != "") {
            $imgpath = 'images/';
    
            if (count($searchSale_arr) != 0) { 
                echo '<div class="container-fluid">
                <div class="row">';
                   

                for ($b = 0; $b <count($searchSale_arr); $b++) {
                    echo '
                        
                         
                        <div class="productcard col-sm-12 col-md-12 col-lg-6" style="text-align: center; font-family: Montserrat, sans-serif;">
                        <div class="overlay">        
                        <img class="backgroundimg" src="images/productcardbackground.png" style="height: 300px; width:100%; border-radius: 25px;">
                        </div> 
                        <span class="brandlog">Liquor Library</span> <span class="industrylog">THE NEW INDUSTRY STANDARD</span>
                                
                                <div class="specialimgwrapper" style="">			
                                     <img class="specialimg" src='.$imgpath.$searchSale_arr[$b][5].' style="min-width: 165px; height: 234px;margin: 0 auto;">
                                 
                                        <div class="buttongroup">
                                        
                                            <button type="button" class="btn btn-secondary btn-sm" id="checkbutton">
                                            <a href="productlist.php?pid='.$searchSale_arr[$b][8].'">
                                            CHECK NOW
                                            </a>
                                            </button>

                                      </div>';

                          
                    echo   '<div class="cardbox">                           
                                          <span class="dealname">'.$searchSale_arr[$b][1].'</span><br>
                                <span class="specialprice">$<span style="font-size:1.4rem;" class="numberprice">'.$searchSale_arr[$b][3].'</span> <i class="fas fa-star" style="color:rgba(224, 184, 65, 1); margin-left:20px;"></i><i class="fas fa-star" style="color:rgba(224, 184, 65, 1);"></i><i class="fas fa-star" style="color:rgba(224, 184, 65, 1);"></i><i class="fas fa-star" style="color:rgba(224, 184, 65, 1);" ></i><i class="fas fa-star" style="color:rgba(224, 184, 65, 1);"></i></span><br>                                       
                               <br>
                                <span class="dealinformation">'.$searchSale_arr[$b][4].'</span>   
                                 
                             </div><br>
                          </div>
                        </div>';
                

                        
                }

             echo '</div>';
            } else {
              
            }
    
        } else {
            ob_clean();
            echo '<p>No record found.</p>';
        }
     ?>
<style>
    /* 
font-family: 'Kalam', cursive;
font-family: 'Handlee', cursive;
font-family: 'Marck Script', cursive;
font-family: 'Kaushan Script', cursive;
    */
.productcard{
    margin-top: 15px;
    margin-bottom: 75px;
}
.specialimg{
    position: absolute;
    top: 8%;
    left: 20%;
}
@media(max-width:660px){
    .specialimg{
    
    left: 10%;
}
}
.brandlog{
    position: absolute;
    top: 5px;
    left: 30px;
    font-family: 'Cinzel', serif;
    font-size: 1.3rem;
    color: rgba(124, 99, 84, 1);
}
.industrylog{
    position: absolute;
    bottom: 10%;
    right: 30px;
    font-family: 'Cinzel', serif;
    font-size: 0.8rem;
    color: rgb(197, 200, 173);
}
.cardbox{
    position:absolute;
    top: 20%;
    right:10%;
    width:230px;
}
.dealname{
    font-family: 'Kaushan Script', cursive;
    font-size: 2.2rem;
    color: white;
    max-width: 250px;
    text-shadow: 1px 2px 2px gray; 
}
.specialprice{
    color: white;
    font-size: 0.5rem;
}
.numberprice{
    color: white;
    font-size: 18px!important;
}
.dealinformation{
    width:200px;
    color: white;

}
.buttongroup{
    position: absolute;
    top: 40%;
    left: 40%;
    z-index: 100;
    display: none;
}
#checkbutton{
      background-color: #8B0000;
      border: 1px solid #8B0000;
      width: 130px;
      height: 45px;
      font-size: 16px;
  }
#checkbutton:hover{
      background-color: white;
      border: 1px solid #8B0000;
      color: #8B0000;
  }
.productcard:hover{
   
    -webkit-transition: opacity .5s;
    -moz-transition: opacity .5s;
    transition: opacity .5s;
}
#checkbutton a{
    color: white!important;
    text-decoration: none!important;
}
#checkbutton a:hover{
    color: #8B0000!important;
    text-decoration: none!important;
}
.specialimgwrapper:hover > .buttongroup{
    display: block;
    z-index: 1000;
}
</style>