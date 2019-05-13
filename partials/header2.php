<header>
    <nav class="navbar navbar-expand-lg navbar-inverse fixed-top opaque-navbar">
        <div class="container">
            <button type="button" class="btn btn-warning btn-sm header2li trigger-btn" href="#myModal" data-toggle="modal" style="position:absolute; right: 35px; top: 57px;  color:white!important; background-color: rgba(224, 184, 65, 1)!important; border:none;">Login</button>

            <br>
            <div class="navbar-header">
            
          <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navMain">
            <span id="iconarea2"><i class="fas fa-angle-down"></i></span>
          </button>
          
            <a class="navbar-brand header2li" href="index.php" style="font-size: 1.7rem;  font-family: 'Cinzel', serif;" >Liquor Library <br> <span style="font-size: 0.7rem; font-family: 'Open Sans', sans-serif; text-align: center; margin-left: 20px;">THE NEW INDUSTRY STANDARD</span></a>
          </div>
          <div class="collapse navbar-collapse" id="navMain">
            <ul class="nav navbar-nav ml-auto">
              <li class="col" id="firstcol"><a href="#aboutus" class="header2li" style=" font-size: 1rem; font-family: 'Roboto', sans-serif;">About Us</a></li>
              <li class="col"><a href="findlocation/findus.php" class="header2li" style="font-size: 1rem; font-family: 'Roboto', sans-serif;">Find Us</a></li>
              <li class="col"><a href="#" id="ourdrinks" data-toggle="modal" data-target="#subnav" class="header2li" style="font-size: 1rem; font-family: 'Roboto', sans-serif;">Our Drinks</a></li> 
              <li class="col"><a href="#" class="header2li" style="font-size: 1rem; font-family: 'Roboto', sans-serif;">Specials</a></li> 
              <li class="col"><a href="#" class="header2li" style="font-size: 1rem; font-family: 'Roboto', sans-serif;">Cart</a></li>
              <li class="col"><a href="#" class="header2li" style="font-size: 1rem; font-family: 'Roboto', sans-serif;">My orders</a></li>
              <li class="col"><a href="contact.php" class="header2li" style="font-size: 1rem; font-family: 'Roboto', sans-serif;">Contact</a></li> 
              <li class="col"> 
                <!-- modal button -->
                  <button type="button" class="btn btn-primary btn-lg pull-right" style="background-color: transparent; border:none;" data-toggle="modal" data-target="#modal2">
                    <span style="font-size: 20px; margin-top:10px;" id="b2" class="header2li"><i class="fas fa-search"></i></span> 
                  </button>

<!-- login modal -->
 <?php
    include_once ("partials/loginmodal.php");
  ?>
<!-- ------------ -->
<!-- search modal ----------------------------------------------------------------------------------------->
<?php
    include_once ("partials/searchmodal.php");
  ?>
<!--------------------------------------------------------------------------------------------------->
<!-- sub Category modal ----------------------------------------------------------------------------------------->
<?php
    include_once ("partials/subcategory.php");
  ?>
<!-- ------------ -->
</header> 
