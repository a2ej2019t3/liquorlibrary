<?php
  session_start();
  $_SESSION['location'] = 'contact';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Contact US</title>
<?php
    include_once ("./partials/head.php");
  ?>
    <link rel="stylesheet" href="css/index.css">
    
</head>
<body>
<section>
  <?php
    include_once ("./partials/header.php");
    ?>
</section>
  
<section>
    <br><br><br>
<div>
    <p class="contactms">DROP US A LINE</p>
    <hr style="color: black;">
    <p class="contactdes">Whether you have a question, request, or <b class="em">epic beer suggestion</b>, we'd love to hear from you. Fill out the info below and we'll be in touch soon. </p>
    <p class="contactdes">For location-specific questions & requests,<br> please visit the <b class="em">Find us</b> page to contact a specific location.</p>
<hr>
</div>
</section>

<section class="contactform">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-lg-12" style="text-align: center; font-family: 'Roboto', sans-serif;"> Please fill out the form for faster response.</div>
    </div>
  </div>
</section>
<br><br><br><br><br>
<!-- form section--------------------------------------------------------------------------------------------
------------------ -->
<section id="form">
    <form>
  <div class="container" style="max-width: 900px; text-align:center;">
  
        <div class="row">
          <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6" > 
            <label for="lable">*What is your question about?</label><br>
            <select name="select" id="questiontopic">
            <option value="volvo">Please select one</option>
            <option value="volvo">Product</option>
            <option value="saab">delivery</option>
            <option value="opel">Branch</option>
            <option value="audi">Specials</option>
            <option value="audi">Others</option>
            </select>
          </div>
        </div>
    <!-- second row of form -->
        <div class="row">
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label for="lable">*First Name </label><br>
            <input class="input2" type="text">
            </div>
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label for="lable">*Last Name </label><br>
            <input class="input2" type="text">
            </div>
        </div>
        <!-- third row -->
        <div class="row">
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label for="lable">*Your company Name </label><br>
            <input class="input2" type="text">
            </div>
        </div>
        <!-- fourth row-->
        <div class="row">
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label for="lable">*Phone number </label><br>
            <input class="input2" type="text">
            </div>
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label for="lable">*Email address </label><br>
            <input class="input2" type="text">
            </div>
        </div>
        <!-- text area row -->
        <div class="fieldbox col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <label for="lable">*Comment:  </label><br>
            <textarea name="comment" id="comment" cols="30" rows="5"></textarea>
        </div>
        <!-- button row -->
         
        <div class="row">
          <br><br><br>
              <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
              <button id="resetbutton" type="submit" class="btn btn-primary">Reset</button>
              </div>
              <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
              <button id="submitbutton" type="submit" class="btn btn-primary">Submit</button>
              </div>
        </div>
        <br><br><br>
  </div>
 </form> 
</section>

<!-- form end--------------------------------------------------------------------------------------------
------------------ -->
  <?php
    include_once ("partials/foot.php");
  ?>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
</body>
</html>