<?php
      session_start();
      require_once "config.php";
      include ('connection.php');
      if(isset($_SESSION['user']['userID'])){
        $userID=$_SESSION['user']['userID'];
        $user_sql = "SELECT u.userID, u.typeID, u.firstName, u.lastName, u.companyName, u.email, u.phone, u.address, ut.typeID, ut.typeName FROM `users` AS u, usertype AS ut WHERE u.typeID=ut.typeID and u.userID='$userID'";
        
        $user_res = mysqli_query($connection, $user_sql);
        $ultimatePrice = $_GET['ordertotalcost'];
        $ultimateQuantity = $_GET['ordertotalquantity'];
        $note= $_GET['note'];
        $orderID=$_GET['orderId'];

        if ($user_res != "") {
            $user_arr = mysqli_fetch_all($user_res);
            $usertype= $user_arr[0][1];
            $username= $user_arr[0][2]. $user_arr[0][3];
            $companyname=$user_arr[0][4];
            $emailaddress=$user_arr[0][5];
            $phone=$user_arr[0][6];
            $address=$user_arr[0][7];

          } else {
            alert("result empty");
          }
        }
        else{
          echo '<script type="text/javascript">';                
          echo 'alert("Please log in to proceed")';
          echo '</script>';
        }
    include_once ("partials/head.php");
    // $_SESSION['ordertotalcost']= $_POST['ordertotalcost'];
    // $ordertotalcost= $_SESSION['ordertotalcost'];
    // $_SESSION['ordertotalquantity']= $_POST['ordertotalquantity'];
    // $ordertotalquantity= $_SESSION['ordertotalquantity'];
    // $note= $_POST['note'];
    // echo $ordertotalcost;
    // echo $ordertotalquantity;
    echo $note;
echo '
     <link rel="stylesheet" href="css/cart.css">
 
<article id="second">
<div class="container">
    <div class="row">
        <!-- info confirmation -->
        <div class="col-sm-12 col-lg-8">
           
                <div class="contactinformation">
                    <div class="contacthead">Contact Information</div>
                        <div class="row">
                            <div class="col-6 usernamebox contactinformationbox">
                            <label for="lable">Your Name </label><br>
                            <input name="username" class="username" type="text" placeholder="'.$username.'" value="'.$username.'" id="usernamebox" onchange="detailname();" required>   
                            </div>
                            <div class="col-6 companynamebox contactinformationbox">
                            <label for="lable">Company Name </label><br>
                            <input name="companyname" class="companyname" placeholder="'.$companyname.'" type="text" value="'.$companyname.'" id="comname" onchange="detailcompany();" >   
                            </div>                            
                        </div>

                        <div class="row">
                             <div class="col-12 emailaddressbox contactinformationbox">
                                <label for="lable">Contact Email </label><br>
                                <input name="emailaddress" class="emailaddress" placeholder="'.$emailaddress.'" type="email" value="'.$emailaddress.'" id="emailadd" onchange="detailemailupdate();"required>   
                            </div>                        
                        
                            <div class="col-12 contactnumberbox contactinformationbox">
                                <label for="lable">Contact Number</label><br>
                                <input name="contactnumber" class="contactnumber" placeholder="'.$phone.'" value="'.$phone.'" type="text" id="numberadd" onchange="detailnumberupdate();" required>   
                            </div>                        
                    <div class="contacthead">Shipping Information</div>    
                          <div class="col-12 addressbox contactinformationbox">
                                <label for="lable">Delivery Address</label><br>
                                <input name="address" class="address" placeholder="'.$address.'" type="text" value="'.$address.'" id="addressadd" onchange="detailaddressupdate();" required>   
                            </div>                        
                        </div>
                </div> 
            
        </div>
        <!-- item confirmation -->
        <div class="col-sm-12 col-lg-4">
            <div class="sidecart">
            
                <div class="detailwrapper">
                    
                  <div class="contacthead" style="text-align:center; margin-bottom: 20px;">Order Details</div>
                    <div class="iconwrapper"><img src="images/deliverytruck.png" alt="truckicon" style="width: 55px;"></div>
                    <div class="labelindex">Total cost: <span class="costquantity" value="'.$ultimatePrice.'"> $'.$ultimatePrice.' </span></div>
                    <div class="labelindex">Total amount: <span class="costquantity" name="costquantitybox" value="'.$ultimateQuantity.'"> '.$ultimateQuantity.' items</span></div>
                    <div class="labelindex">Name: <span class="costquantity" id="namebox">'.$username.' </span> <span class="costquantity" id="companybox">  </span></div>
                    <div class="labelindex">Contact Number: <br><span class="costquantity" id="numberbox"> '.$phone.' </span></div>
                    <div class="labelindex">Contact Email: <br><span class="costquantity" id="emailbox"> '.$emailaddress.' </span></div>
                    <div class="labelindex">Delivery Address: <br><span class="costquantity" id="addresschangearea" value="'.$address.'" > '.$address.' </span></div>

                </div>
            </div>
        </div>
        <hr>
        <div class="buttonarea">
            <button type="submit" class="btn btn-secondary btn-sm" id="checkbutton">
                <a href="paymentprocess.php"> BACK TO CART
                </a>
            </button>
            <button type="button" class="btn btn-secondary btn-sm" onclick="paymentModal()" id="ckbtn" data-toggle="modal" data-target="#payModal">
            CEHCK OUT
            </button>
</div>
            <!-- Modal -->
            <div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="width: 700px; height: 400px;">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">LIQUOR LIBRARY</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="payment-form">
                    <input type="hidden" name="finalprice" id="finalprice" value="'.$ultimatePrice.'"></input>
                    <input type="hidden" id="finalquantity" name="finalquantity" value="'.$ultimateQuantity.'"></input>
                    <input type="hidden" value="'.$note.'" id="notecontext" name="notecontext">
                    <input type="hidden" value="'.$emailaddress.'" id="emailcontext" name="emailcontext">
                    <input type="hidden" value="'.$orderID.'" id="idcontext" name="idcontext">
                    <input type="hidden" value="'.$username.'" id="usernamecontext" name="usernamecontext">

                    <div class="form-row">
                        <div class="col-sm-12 col-md-4">
                                <div class="imgwrapper" style="width:100%;">
                                <img class="img-fluid" src="images/liquor18.jpg">
                                </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                                <div class="form-row inline">
                                <div class="col">
                                <label class="modallablebox" for="name">
                                    Name
                                </label>
                                <input class="modalinput" id="namemodal" name="name" value="'.$username.'" placeholder="'.$username.'" readonly>
                                </div>
                                <div class="col">
                                <label class="modallablebox" for="email">
                                    Email Address
                                </label>
                                <input class="modalinput" id="emailmodal" name="email" value="'.$emailaddress.'" type="email" placeholder="'.$emailaddress.'" readonly>
                                </div>
                            </div>
                            <label class="modallablebox" for="address">
                            Shipping Address
                            </label>
                            <input class="modalinput" id="addressmodal" name="address" value="'.$address.'" type="address" placeholder="'.$address.'" readonly>
                                <label class="modallablebox" for="card-element">
                                Credit or debit card
                                </label>
                                <div id="card-element">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>
                                <hr>
                                <div>
                                <div style="font-weight:700; font-size: 15px; text-align:right; margin-right: 15px;">TOTAL: $ <span style="font-size: 25px; font-weight:700; ">'.$ultimatePrice.'</span> <div>
                                </div>
                                        
                        </div>

                <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                    </div>
                
        
                    <button id="paysubmitbtn">PAY NOW</button>
                    <button id="dismissbtn" data-dismiss="modal">Close</button>

                </form>
                </div>

                </div>
                </div>
                </div>
                
                </div>   
                
                
                </div>
                </article>

                <style>
.contacthead{
    font-size: 1.4rem;
    font-family: "Lato", sans-serif;
    font-weight: 600;
    text-align:left;
    margin-bottom:10px;
    margin-top: 15px;
}
.contactinformationbox input{
      
	  border: 1.6px solid #d9d9d9;
      border-radius: 5px;
      transition: all 1.5s cubic-bezier(.19,1,.22,1);
      font: 12px/1 effra;
      color: #333333;
      min-height: 40px;
      width: 100%;
      font-size: 15px;
      font-family:"Montserrat", sans-serif;
      padding-right: 15px;
}
.contactinformationbox label{
    font-family: "Lato", sans-serif;
    color: #333333;
    font-size: 1rem;
    float:left;
    margin-bottom: 0;
}
.contactinformationbox{
    margin: 10px auto;
}
.sidecart{
    background-color: rgba(217, 221, 146, 1);
    border-radius: 5px;
    width:100%;
    height: 100%;
    padding-top: 10px;
}
.labelindex{
	font-size: 1rem;
    font-weight: 600;
    text-align: left;
    margin-left: 15px;
    margin-top: 15px;

}
.costquantity{
    margin-left: 10px;
    color: rgba(48, 43, 41,1);
    font-size: 1rem;
    font-weight: 500;
}
.costquantity:hover{
    color: #8B0000;
    
}
#paysubmitbtn{
	background-color: rgba(244, 232, 117, 1);
	width: 150px;
	height: 45px;
	font-size: 20px;
    color: white;
    margin: 20px auto;
    border:none;
}
#paysubmitbtn:hover{
    background-color: rgba(224, 184, 65, 1);
}
#dismissbtn{
    background-color: rgba(124, 99, 84, 1);
	width: 150px;
	height: 45px;
	font-size: 20px;
    color: white;
    margin: 20px auto;
    border:none;
}
#dismissbtn:hover{
    background-color: rgba(48, 43, 41,1);
}
#ckbtn{
    background-color: #E12726;
	width: 150px;
	height: 45px;
	font-size: 20px;
    color: white;
    margin: 20px auto;
    border:none;
}
#ckbtn:hover{
    border: 1px solid #E12726;
    background-color: transparent;
    color: #E12726;
}
.buttonarea{
    margin: 15px auto;
}
</style>
';