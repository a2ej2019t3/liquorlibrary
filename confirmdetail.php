<?php
      session_start();
      require_once "config.php";
      include ('connection.php');
      if(isset($_SESSION['user']['userID'])){
        $userID=$_SESSION['user']['userID'];
        $user_sql = "SELECT u.userID, u.typeID, u.firstName, u.lastName, u.companyName, u.email, u.phone, u.address, ut.typeID, ut.typeName FROM `users` AS u, usertype AS ut WHERE u.typeID=ut.typeID and u.userID='$userID'";
        $usertype=$_SESSION['user']['typeID'];
        $user_res = mysqli_query($connection, $user_sql);
        $ultimatePrice = $_GET['ordertotalcost'];
        $ultimateQuantity = $_GET['ordertotalquantity'];
        $note= $_GET['note'];
        $orderID=$_GET['orderId'];
        // echo $userID;
        
        if ($user_res != "") {
            $user_arr = mysqli_fetch_all($user_res);
            $username= $user_arr[0][2]. $user_arr[0][3];
            $companyname=$user_arr[0][4];
            $emailaddress=$user_arr[0][5];
            $phone=$user_arr[0][6];
            $address=$user_arr[0][7];
            // echo $username;
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
    echo $note;

// getting warehouse information
$warehouse_sql = "SELECT * from warehouse";
$warehouse_res = mysqli_query($connection, $warehouse_sql);
    if($warehouse_res != ""){
        $warehouse_arr = mysqli_fetch_all($warehouse_res);

    }
    else{
        alert("warehouse result empty");
    }


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
                             <div class="col-6 emailaddressbox contactinformationbox">
                                <label for="lable">Contact Email </label><br>
                                <input name="emailaddress" class="emailaddress" placeholder="'.$emailaddress.'" type="email" value="'.$emailaddress.'" id="emailadd" onchange="detailemailupdate();"required>   
                            </div>                        
                        
                            <div class="col-6 contactnumberbox contactinformationbox">
                                <label for="lable">Contact Number</label><br>
                                <input name="contactnumber" class="contactnumber" placeholder="'.$phone.'" value="'.$phone.'" type="text" id="numberadd" onchange="detailnumberupdate();" required>   
                            </div>   
                         </div>';
                         if($usertype==1){

                         }
                         else{
                             echo'<div class="extrainfo" id="extrainfo">
                             <div class="contacthead">Shipping & Payment Information</div>
                          <div class="row">                       
                             
                                  <div class="col-6 addressbox contactinformationbox">
                                  <label for="lable">Delivery Method</label><br>
                                  <select class="deliverymothod" name="deliverymothod" id="deliverymothod" required onchange="deliveryinput();"> 
                                      <option value="">Select</option>
                                      <option value="delivery">Delivery</option>
                                      <option value="pickup">Pick up</option>
                                  </select>
                              </div>
                                  
                              <div class="col-6 addressbox contactinformationbox">
                                      <label for="lable">Delivery Address</label><br>
                                      <input name="address" class="address" placeholder="'.$address.'" type="text" value="'.$address.'" id="addressadd" onchange="detailaddressupdate();" required>   
                                  </div> 
                                  </div>
                                  </div>   
                         
                           
                     
                    <div class="row">                       
                           
                    <div class="col-6 addressbox contactinformationbox">
                    <label for="lable">Payment Method</label><br>
                                <select class="paymentmothod" name="paymentmothod" id="paymentmothod" style="display:none" onchange="paymentinput();"> 
                                    
                                    <option value="1">Pay with Card</option>
                                    <option value="2">Pay with Cash</option>
                                </select>
                    </div>
                    
                    <div class="col-6 addressbox contactinformationbox">
                                <label for="lable">Pick Up Location</label><br>
                                <select class="locationselect" name="locationselect" id="locationselect" style="display:none" onchange="locationinput();">                             
                                <option value="">Select</option>';

                                for($a = 0; $a < count($warehouse_arr); $a++){
                                        $warehouseID=$warehouse_arr[$a][0];
                                        $warehousename=$warehouse_arr[$a][2];
                                        $warehouseaddress=$warehouse_arr[$a][3];     
                                 echo '<option value='.$warehouseID.'>'.$warehouseaddress.' </option>';
                                }

                               echo' </select>
                                             
                    </div>
                    </div>
                  ';
                }
                          
         echo   '</div>
         </div>
        <!-- item confirmation -->
        <div class="col-sm-12 col-lg-4">
            <div class="sidecart">
            
                <div class="detailwrapper">
                    
                  <div class="contacthead" style="text-align:center; margin-bottom: 20px;">Order Details</div>
                    <div class="iconwrapper"><img src="images/deliverytruck.png" alt="truckicon" style="width: 55px;"></div>
                    <div class="labelindex">Total cost: <span class="costquantity" value="'.$ultimatePrice.'" style="margin-right: 10px;"> $'.$ultimatePrice.' </span>Total amount: <span class="costquantity" name="costquantitybox" value="'.$ultimateQuantity.'"> '.$ultimateQuantity.' items</span></div>
                    <div class="labelindex">Name: <span class="costquantity" id="namebox">'.$username.' </span> <span class="costquantity" id="companybox">  </span></div>
                    <div class="labelindex">Contact Number: <span class="costquantity" id="numberbox" style="margin-right: 10px;"> '.$phone.' </span></div>
                    <div class="labelindex">Contact Email: <span class="costquantity" id="emailbox" style="margin-right: 10px;"> '.$emailaddress.' </span></div>
                    <div class="labelindex">Delivery Address: <br><span class="costquantity" id="addresschangearea" value="'.$address.'" > '.$address.' </span></div>
                    <div class="labelindex">Delivery: <span class="costquantity" id="deliveryoption" style="margin-right: 10px;"> </span>Paymemt: <span class="costquantity" id="paymentoption"> </span></div>
                    <div class="labelindex">Pick Up Address: <span class="costquantity" id="pickuparea" > </span></div>
                 </div>
            </div>
        </div>
        <hr>
        <div class="buttonarea">
            <button type="submit" class="btn btn-secondary btn-sm" id="checkbutton">
                <a href="paymentprocess.php"> BACK TO CART
                </a>
            </button>';
            if($usertype==1){
        echo    '<button type="button" class="btn btn-secondary btn-sm" onclick="payproceed()" id="ckbtn2" name="ckbtn2"> CEHCK OUT</button>';
            }
            else{
         echo  ' <button type="button" class="btn btn-secondary btn-sm" onclick="payproceed()" id="ckbtn2" name="ckbtn2" style="display:none;"> CEHCK OUT</button>
            <button type="button" class="btn btn-secondary btn-sm" onclick="paymentModal()" id="ckbtn" name="ckbtn" data-toggle="modal" data-target="#payModal">
            CEHCK OUT
            </button>   ';             
            }
echo '
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
                    <input type="hidden" id="delivercontext" name="delivercontext">
                    <input type="hidden" id="paymentcontext" name="paymentcontext">
                    <input type="hidden" value="" id="pickupcontext" name="pickupcontext">
                    <input type="hidden" value="'.$usertype.'" id="usertypecontext" name="usertypecontext">

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
#ckbtn2{
    background-color: yellow;
	width: 150px;
	height: 45px;
	font-size: 20px;
    color: white;
    margin: 20px auto;
    border:none;
}
#ckbtn2:hover{
    border: 1px solid #E12726;
    background-color: transparent;
    color: #E12726;
}
.buttonarea{
    margin: 15px auto;
}
</style>
';
?>
<!-- <script>
function deliveryinput() {

    var sel = $(this).val();
    if (sel == '2') $('select[name=paymentmothod]').show();


$('input[name=btn_submit]').click(function() {
    var sel = $('#deliverymothod').val();
    if (sel == 'delivery') {
        if ($('input[name=address]').val() == '') {
            alert('Please input your delivery address');
            return false; //prevent submit from submitting
        }else{
            // alert('Your entry was submitted');
        }
    }else{
        //Model is NOT 2 or 3 so don't check
        alert('please select your delivery method');
    }
});
};
</script> -->