<?php
    
    if ($_SESSION['location'] == 'index') {
        $className = '';
    } else {
        $className = 'header2li';
    }
?>
<header id="topsection">
    <nav class="navbar navbar-expand-lg navbar-inverse fixed-top opaque-navbar">
        <div class="container">
    <!-- login button -->
            <?php
                if (!isset($_SESSION['user'])) {
                    echo '
                        <button type="button" class="btn-warning btn-sm trigger-btn '.$className.'" href="#myModal" data-toggle="modal" style="position:absolute; right: 35px; top: 57px; color:white!important; background-color: rgba(224, 184, 65, 1)!important; border:none;">Login</button>
                    ';
                } else {
                    echo '
                        <button type="button" id="logoutButton" class="btn-success btn-sm trigger-btn '.$className.'" style="position:absolute; right: 35px; top: 57px; color:white!important; background-color: rgba(224, 184, 65, 1)!important; border:none;">Logout</button>
                    ';
                }
            ?>
            <br>
            <div class="navbar-header">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navMain" style="border: 1px solid black !important">
    <!-- navbar toggler here -->
                    <?php
                        if ($_SESSION['location'] == 'index') {
                            echo '
                                <span style="color:black" id="iconarea"><i class="fas fa-angle-down"></i></span>
                            ';
                        } else if ($_SESSION['location'] == 'contact') {
                            echo '
                                <span style="color:black" id="icon"><i class="fas fa-angle-down"></i></span>
                            ';
                        }
                    ?>
                </button>
                <a class="navbar-brand <?php echo $className; ?>" href="index.php" style="font-size: 1.7rem; color: white; font-family: 'Cinzel', serif;">Liquor Library <br> <span style="font-size: 0.7rem; font-family: 'Open Sans', sans-serif; text-align: center; margin-left: 20px;">THE NEW INDUSTRY STANDARD</span></a>
            </div>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="nav navbar-nav ml-auto">
                    
                    <?php 
                        if(isset($_SESSION['user'])){
                            if( $_SESSION['user']['typeID']==3 || $_SESSION['user']['typeID']==2){
                    
                                echo ' 
                                <li class="col" id="firstcol"><a class="'.$className.'" href="index.php #aboutus" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">About Us</a></li>
                                <li class="col"><a class="'.$className.'" href="findlocation/findus.php" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">Find Us</a></li>
                                <li class="col"><a class="'.$className.' js-open-modal" id="ourdrinks" data-toggle="modal" data-target="#subnav" href="#" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">Our Drinks</a></li> 
                                <li class="col"><a class="'.$className.'" href="specials.php" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">Specials</a></li> 
                                <li class="col"><a class="'.$className.'" href="paymentprocess.php" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">Cart</a></li>
                                <li class="col2"><a class="'.$className.'" href="orderhistory.php" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">My orders</a></li>
                                <li class="col"><a class="'.$className.'" href="contact.php" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">Contact</a></li> 
                                
            ';
                            }
                            else if ( $_SESSION['user']['typeID']==1) {
                                echo ' 
                                <li class="col"><a class="'.$className.'" href="findlocation/findus.php" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">Find Us</a></li>
                                <li class="col"><a class="'.$className.' js-open-modal" id="ourdrinks" data-toggle="modal" data-target="#subnav" href="#" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">Our Drinks</a></li> 
                                <li class="col"><a class="'.$className.'" href="specials.php" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">Specials</a></li> 
                                <li class="col"><a class="'.$className.'" href="paymentprocess.php" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">Cart</a></li>
                                <li class="col"><a class="'.$className.'" href="contact.php" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">Contact</a></li> 
                                <li class="col2"><a class="'.$className.'" href="branchreport.php" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">Branch Report</a></li> 
            ';
                            }
                            else if ( $_SESSION['user']['typeID']==0) {
                                echo ' 
                                <li class="col" id="firstcol"><a class="'.$className.'" href="findlocation/findus.php" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">Find Us</a></li>
                                <li class="col"><a class="'.$className.' js-open-modal" id="ourdrinks" data-toggle="modal" data-target="#subnav" href="#" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">Our Drinks</a></li> 
                                <li class="col"><a class="'.$className.'" href="specials.php" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">Specials</a></li> 
                                <li class="col2"><a class="'.$className.'" href="adminreport.php" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">Admin Report</a></li> 
            ';
                            }
                            else{
        
                            }
                        }
                        else{
                            echo ' 
                            <li class="col" id="firstcol"><a class="'.$className.'" href="index.php #aboutus" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">About Us</a></li>
                            <li class="col"><a class="'.$className.'" href="findlocation/findus.php" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">Find Us</a></li>
                            <li class="col"><a class="'.$className.' js-open-modal" id="ourdrinks" data-toggle="modal" data-target="#subnav" href="#" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">Our Drinks</a></li> 
                            <li class="col"><a class="'.$className.'" href="specials.php" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">Specials</a></li> 
                            <li class="col"><a class="'.$className.'" onclick="openLoginModal()" href="#" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">Cart</a></li>
                            <li class="col"><a class="'.$className.'" href="contact.php" style="color: white; font-size: 1rem; font-family: "Roboto", sans-serif;">Contact</a></li> 
        ';
                    }
                        
                     ?>
                    <li class="col"> 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
                        <button type="button" class="btn btn-primary btn-lg pull-right" style="background-color: transparent; border:none;" data-toggle="modal" data-target="#searchModal">
                            <span class="<?php echo $className; ?>" style="color: white; font-size: 20px; margin-top:10px;" id="b2"><i class="fas fa-search"></i></span> 
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>     
                   

                      
<!-- Login modal -->
<?php

    include_once ("partials/loginmodal.php");
    // include_once (dirname(__DIR__) . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'searchmodal.php');

  ?>
<!-- ------------ -->

<!-- search modal ----------------------------------------------------------------------------------------->
<?php
    include_once ("partials/searchmodal.php");
    // include_once (dirname(__DIR__) . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'searchmodal.php');

  ?>
<!-- ------------ -->
<!-- sub Category modal ----------------------------------------------------------------------------------------->
<?php
    include_once ("partials/subcategory.php");
    // include_once (dirname(__DIR__) . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'subcategory.php');

  ?>
<!-- ------------ -->
</header> 
