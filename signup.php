<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="css/version.css">
     <!-- bootstrap -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
     <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"> -->
     <!-- font embeded -->
      <link href="https://fonts.googleapis.com/css?family=Cinzel:700|Lato|Montserrat|Open+Sans|Roboto|Shadows+Into+Light" rel="stylesheet">


</head>
<body>
<section>
<?php
    include ("partials/header2.php");
 ?>
</section>
<section>
    <br><br><br><br>
    <!-- <img src="images/liquor4.jpg" alt=""> -->
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="mySlides"> <img src="images/liquor5.jpg" style="width:100%; max-height:520px;"/> 
                <div class="content">Join us NOW</div>
            </div>
                <div class="mySlides"> <img src="images/liquor15.jpg" style="width:100%; max-height:520px;"/> 
                <div class="content2">And enjoy <br> the benefits! </div>
            </div>
            </div>
        </div>
    </div> 
    
</section>
<br><br>
<section class="contactform">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-lg-12" style="text-align: center; font-family: 'Roboto', sans-serif;"><h1 style="font-family: 'Lato', sans-serif;"> SIGN UP</h1></div>
    </div>
  </div>
</section>
<br><hr>
<section id="form">
    <form>
  <div class="container" style="max-width: 900px; text-align:center;">
  
        <div class="row">
          <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6" > 
            <label for="lable">*Please select your type</label><br>
            <div id="radios" class="btn-group" data-toggle="buttons">
            <label class="btn btn-default checked">
                <input type="radio" name="options" id="option1" value="1"   /> Business
            </label>
            <label class="btn btn-default">
                <input type="radio" name="options" id="option2" value="0" checked /> Individuals
            </label>
             </div>
          </div>
        </div>
    <!-- second row of form -->
        <div class="row">
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label for="lable">*First Name </label><br>
            <input class="input2" type="text" required>
            </div>
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label for="lable">*Last Name </label><br>
            <input class="input2" type="text" required>
            </div>
        </div>
        <!-- third row -->
        <div class="row">
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label for="lable">*Your company Name </label><br>
            <input class="input2" type="text" required>
            </div>
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label for="lable">*Please select the type of business(Business Client Only)</label><br>
            <select name="select" id="questiontopic">
            <option value="volvo">Please select one</option>
            <option value="volvo">Restaurant</option>
            <option value="saab">Bar</option>
            <option value="opel">Others</option>
            </select>
            </div>
        </div>
        <!-- fourth row-->
        <div class="row">
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label for="lable">*Contact number </label><br>
            <input class="input2" type="text" required >
            </div>
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label for="lable">*Email address </label><br>
            <input class="input2" type="email" required>
            </div>
        </div>
        <div class="row">
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label for="lable">*Password </label><br>
            <input class="input2" type="password" required>
            </div>
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label for="lable">*Confirm your password </label><br>
            <input class="input2" type="password" required>
            </div>
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
  <!-- bootstrap /js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="main.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>