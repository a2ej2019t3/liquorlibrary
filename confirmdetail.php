
    <?php
      session_start();
      require_once "config.php";
      include ('connection.php');
      if(isset($_SESSION['user']['userID'])){
        $userID=$_SESSION['user']['userID'];
        $user_sql = "SELECT u.userID, u.typeID, u.firstName, u.lastName, u.companyName, u.email, u.phone, u.address, ut.typeID, ut.typeName FROM `users` AS u, usertype AS ut WHERE u.typeID=ut.typeID and u.userID='$userID'";
        
        $user_res = mysqli_query($connection, $user_sql);
        
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
    $_SESSION['ordertotalcost']= $_GET['ordertotalcost'];
    $ordertotalcost= $_SESSION['ordertotalcost'];
    $_SESSION['ordertotalquantity']= $_GET['ordertotalquantity'];
    $ordertotalquantity= $_SESSION['ordertotalquantity'];
    $note= $_GET['note'];
    // echo $ordertotalcost;
    // echo $ordertotalquantity;
    // echo $note;
 	?>
	 <link rel="stylesheet" href="css/cart.css">
<article id="second">
<form method="POST" action="confirmpay.php">
<div class="container">
    <div class="row">
        <!-- info confirmation -->
        <div class="col-sm-12 col-lg-8">
           
                <div class="contactinformation">
                    <div class="contacthead">Contact Information</div>
                        <div class="row">
                            <div class="col-6 usernamebox contactinformationbox">
                            <label for="lable">Your Name </label><br>
                            <input name="username" class="username" type="text" placeholder="<?php echo $username?>" value="<?php echo $username?>" id="usernamebox" onchange="detailname();" required>   
                            </div>
                            <div class="col-6 companynamebox contactinformationbox">
                            <label for="lable">Company Name </label><br>
                            <input name="companyname" class="companyname" placeholder="<?php echo $companyname?>" type="text" value="<?php echo $companyname?>" id="comname" onchange="detailcompany();" >   
                            </div>                            
                        </div>

                        <div class="row">
                             <div class="col-12 emailaddressbox contactinformationbox">
                                <label for="lable">Contact Email </label><br>
                                <input name="emailaddress" class="emailaddress" placeholder="<?php echo $emailaddress?>" type="email" value="<?php echo $emailaddress?>" id="emailadd" onchange="detailemailupdate();"required>   
                            </div>                        
                        
                            <div class="col-12 contactnumberbox contactinformationbox">
                                <label for="lable">Contact Number</label><br>
                                <input name="contactnumber" class="contactnumber" placeholder="<?php echo $phone?>" value="<?php echo $phone?>" type="text" id="numberadd" onchange="detailnumberupdate();" required>   
                            </div>                        
                    <div class="contacthead">Shipping Information</div>    
                          <div class="col-12 addressbox contactinformationbox">
                                <label for="lable">Delivery Address</label><br>
                                <input name="address" class="address" placeholder="<?php echo $address?>" type="text" value="<?php echo $emailaddress?>" id="addressadd" onchange="detailaddressupdate();" required>   
                            </div>                        
                        </div>
                </div> 
            
        </div>
        <!-- item confirmation -->
        <div class="col-sm-12 col-lg-4">
            <div class="sidecart">
            
                <div class="detailwrapper">
                    <input type="hidden" value="<?php $note ?>" name="notecontext">
                  <div class="contacthead" style="text-align:center; margin-bottom: 20px;">Order Details</div>
                    <div class="iconwrapper"><img src="images/deliverytruck.png" alt="truckicon" style="width: 55px;"></div>
                    <div class="labelindex">Total cost: <span class="costquantity" value="<?php  $ordertotalcost ?>"> $<?php  echo $ordertotalcost ?> </span></div>
                    <input type="hidden" name="costbox" value="<?php $ordertotalcost ?>">
                    <div class="labelindex">Total amount: <span class="costquantity" name="costquantitybox" value="<?php  $ordertotalquantity ?>"> <?php echo $ordertotalquantity?> items</span></div>
                    <div class="labelindex">Name: <span class="costquantity" name="namebox"><?php echo $username?> </span> <span class="costquantity" name="companybox">  </span></div>
                    <div class="labelindex">Contact Email: <br><span class="costquantity" name="emailbox"> <?php echo $emailaddress?> </span></div>
                    <div class="labelindex">Delivery Address: <br><span class="costquantity" name="addresschangearea" value="<?php  $address ?>" > <?php echo $address?> </span></div>
                 <div>
                    <button type="button" class="btn btn-secondary btn-sm" id="checkbutton">
                        BACK TO CART
                        </a>
                    </button> 
                    </div>

                </div>
            </div>
        </div>
        <div class="buttonarea">
          <button type="submit" class="btn btn-secondary btn-sm" id="checkbutton">
              <a> PROCEED
              </a>
          </button>        
        </div>   
   
    </div>  
</div>
  </form>
</article>
<style>
.contacthead{
    font-size: 1.4rem;
    font-family: 'Lato', sans-serif;
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
      font-family: 'Montserrat', sans-serif;
      padding-right: 15px;
}
.contactinformationbox label{
    font-family: 'Lato', sans-serif;
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

</style>