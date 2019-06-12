<?php
    session_start();
    $_SESSION['location'] = 'productlist';
    include_once ('connection.php');
    // main deals search 
    $maindeal_sql = "SELECT `specialId`, `specialName`, `specialType`, `specialPrice`, `specialInfo`, `specialImg`, `startTime`, `finishTime` FROM `specials` WHERE `specialType`=1;";
    $maindeal_res = mysqli_query($connection, $maindeal_sql);
    
    if ($maindeal_res != "") {
        $maindeal_arr = mysqli_fetch_all($maindeal_res);
        $resultcount=count($maindeal_arr);
        $imgpath = 'images/';
    } else {
        alert("result empty");
    }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    include_once ("partials/head.php");
    ?>
    <link rel="stylesheet" href="css/special.css">
    <title>Special Deals</title>
</head>
<body style="height: 110%;">

<section>
        <?php
            include_once ("partials/header.php");
        ?>        
</section>
<br><br>

<section>
<!-- image slides -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="overflow:visible!important;">
  <ol class="carousel-indicators">

     <?php
         for($a = 0; $a <count($maindeal_arr); $a++){
            echo '<li data-target="#carouselExampleIndicators" data-slide-to='.$a.' class=""></li>';
         }
     ?>
  </ol>
  <div class="carousel-inner" style="height: 470px; margin-top: 80px;">;

    <?php
        for($b = 0; $b <count($maindeal_arr); $b++){

            echo '<div class="carousel-item">
                         <img class="d-block w-100" src='.$imgpath.$maindeal_arr[$b][5].' alt="slide" style="max-height:500px; ">;
                         <div class="carousel-caption d-md-block d-lg-block">';
                       echo '<p class="info">'.$maindeal_arr[$b][4].'</p>';  
                       echo '<div>';
                       echo '
                      
                       <a href="delete_special.php?specialId='.$maindeal_arr[$b][0].'">
                       Delete 
                       </a>
                      ';
                       if($maindeal_arr[$b][1]!=0){
                        echo'<span class="specialprice">'.$maindeal_arr[$b][1].'</span>';
                        }
                        else{}
                       
                        if($maindeal_arr[$b][3]!=0){
                            echo'<span class="specialprice" style="font-size: 1.5rem;">Only NZ$<span class="priceinfo"style="font-size: 4rem;">'.$maindeal_arr[$b][3].'</span></span>';
                        }
                        
                        else{}                                                     
                        echo '</div>';
              echo '</div>
                  </div>';
        };
    ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  <div class="adminbuttons" id="adminbtsgroup">
  <!-- <button type="button" class="customebts btn btn-primary">  -->
  <!-- <a href="delete_special.php?specailId='.$maindeal_arr[$b][0].'"> -->
        <!-- Delete -->
        </a>
  </button>
  
  <button type="button" class="customebts btn btn-primary" data-toggle="modal" data-target="#newmainspecialModal">
        New special
  </button>
  </div>
</div>
<!-- image slides end -->
<?php
include ("partials/specialsModal.php");
?>
</section>

<!-- Special product lists -------------------------------------------------------------------------->
<section>
<p class="contactms" style="font-size: 4.4rem;">Grab A Deal</p>
</section>
<section>
  <?php
    include ('specialupload/speciallist.php');
  ?>
<section>
<?php
    include_once ("partials/foot.php");
  ?>  
  <script type="text/javascript" src="js/subcategory.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
  <script>
        $(document).ready(function () {
        $('#carouselExampleIndicators').find('.carousel-item').first().addClass('active');
        });

  </script>
</body>
</html>
