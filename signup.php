<?php
    session_start();
    $_SESSION['location'] = 'signup';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sign Up</title>
    <?php
        include_once ("partials/head.php");
        include ("connection.php");
    ?>
  <link rel="stylesheet" href="css/index.css">
</head>
</head>
<body>
<section>
<?php
    include ("partials/header.php");
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
<form method="post" action="signInUp/process_signup.php">
    <div class="container" style="max-width: 900px; text-align:center;">
        <div class="row">
          <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6" > 
            <label for="lable">*Please select your type</label><br>
            <div id="radios" class="btn-group" data-toggle="buttons">
                <label id="businessOptionLable" class="btn btn-default checked">
                    <input type="radio" name="options" id="businessOption" checked/> Business
                </label>
                <label id="individualOptionLable" class="btn btn-default">
                    <input type="radio" name="options" id="individualOption" value="3"/> Individual
                </label>
            </div>
          </div>
        </div>
    <!-- second row of form -->
        <div class="row">
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label for="lable">*First Name </label><br>
                <input name="first_name" class="input2" type="text" required>
            </div>
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label for="lable">*Last Name </label><br>
                <input name="last_name" class="input2" type="text" required>
            </div>
        </div>
        <!-- third row -->
        <div id="forBusiness" class="row">
            <div id="companyNameField" class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label for="lable">*Your company Name </label><br>
                <input id="company_name" name="company_name" class="input2" type="text">
            </div>
            <div id="businessTypeField" class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label for="lable">*Please select the type of business(Business Client Only)</label><br>
                <input name="typeID" type="hidden" value="">
                <select id="questiontopic" onclick="getBusinessType(this)">
                <?php 
                    $selectQuery = "SELECT * FROM `usertype` WHERE NOT typeID = 3";
                    //Checks the customer already exists with the user name.
                    
                    if ($result = mysqli_query($connection, $selectQuery)) {
                        while ( $type = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    ?>
                    
                    <option class="businessTypeOptions" value="<?php echo $type['typeID'] ?>"><?php echo $type['typeName'] ?></option>
                <?php 
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <!-- fourth row-->
        <div class="row">
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label for="lable">*Contact number </label><br>
            <input name="contact_number" class="input2" type="text" required >
            </div>
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label for="lable">*Email address </label><br>
            <input  name="email"class="input2" type="email" required>
            </div>
        </div>
        <div class="row">
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label for="lable">*Password </label><br>
            <input name="password" class="input2" type="password" required>
            </div>
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label for="lable">*Confirm your password </label><br>
            <input  name="confirm_password" class="input2" type="password" required>
            </div>
        </div>
         <!-- button row -->
         
         <div class="row">
           <br><br><br>
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <button id="resetbutton" type="reset" class="btn btn-primary">Reset</button>
            </div>
            <div class="fieldbox col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <button id="submitbutton" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <br><br><br>
  </div>
 </form> 
</section>
<?php
    include_once ("partials/foot.php");
  ?>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/search.js"></script>
</body>
</html>