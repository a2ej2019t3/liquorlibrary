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
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navMain">
    <!-- navbar toggler here -->
                    <?php
                        if ($_SESSION['location'] == 'index') {
                            echo '
                                <span style="color:white" id="iconarea"><i class="fas fa-angle-down"></i></span>
                            ';
                        } else if ($_SESSION['location'] == 'contact') {
                            echo '
                                <span id="icon"><i class="fas fa-angle-down"></i></span>
                            ';
                        }
                    ?>
                </button>
                <a class="navbar-brand <?php echo $className; ?>" href="index.php" style="font-size: 1.7rem; color: white; font-family: 'Cinzel', serif;">Liquor Library <br> <span style="font-size: 0.7rem; font-family: 'Open Sans', sans-serif; text-align: center; margin-left: 20px;">THE NEW INDUSTRY STANDARD</span></a>
            </div>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="nav navbar-nav ml-auto">
                    <li class="col" id="firstcol"><a class="<?php echo $className; ?>" href="#aboutus" style="color: white; font-size: 1rem; font-family: 'Roboto', sans-serif;">About Us</a></li>
                    <li class="col"><a class="<?php echo $className; ?>" href="findlocation/findus.php" style="color: white; font-size: 1rem; font-family: 'Roboto', sans-serif;">Find Us</a></li>
                    <li class="col"><a class="<?php echo $className; ?> js-open-modal" id="ourdrinks" data-toggle="modal" data-target="#subnav" href="#" style="color: white; font-size: 1rem; font-family: 'Roboto', sans-serif;">Our Drinks</a></li> 
                    <li class="col"><a class="<?php echo $className; ?>" href="specials.php" style="color: white; font-size: 1rem; font-family: 'Roboto', sans-serif;">Specials</a></li> 
                    <li class="col"><a class="<?php echo $className; ?>" href="paymentprocess.php" style="color: white; font-size: 1rem; font-family: 'Roboto', sans-serif;">Cart</a></li>
                    <li class="col"><a class="<?php echo $className; ?>" href="#" style="color: white; font-size: 1rem; font-family: 'Roboto', sans-serif;">My orders</a></li>
                    <li class="col"><a class="<?php echo $className; ?>" href="contact.php" style="color: white; font-size: 1rem; font-family: 'Roboto', sans-serif;">Contact</a></li> 
                    <li class="col"> 
                        <!-- modal button -->
                        <button type="button" class="btn btn-primary btn-lg pull-right" style="background-color: transparent; border:none;" data-toggle="modal" data-target="#modal2">
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
  ?>
<!-- ------------ -->

<!-- search modal ----------------------------------------------------------------------------------------->
<?php
    include_once ("partials/searchmodal.php");
  ?>
<!-- ------------ -->
<!-- sub Category modal ----------------------------------------------------------------------------------------->
<?php
    include_once ("partials/subcategory.php");
  ?>
<!-- ------------ -->
</header> 
