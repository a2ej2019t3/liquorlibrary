<?php
        
        $orderId=$_GET['id'];
        $username=$_GET['username'];
        $email=$_GET['email'];
        $address=$_GET['address'];
        $contactnumber=$_GET['contactnumber'];
        $paymentmethod=$_GET['paymentmethod'];
        $deliverymethod=$_GET['deliverymothod'];
        $pickuplocation=$_GET['pickuplocation'];
        $pickupwarehouseId=$_GET['pickupwarehouseId'];
        $fianlprice=$_GET['cost'];
        $finalquantity=$_GET['quantity'];
        $logintype=$_GET['logintype'];
        $note=$_GET['note'];
        include ('../connection.php');
        if(isset($_GET['id'])){
                
                // Cart items > in case of order status=0 
                $date = date('Y-m-d H:i:s');
                if($paymentmethod=='cash'){
                $updateorder_sql = "UPDATE `orders` SET `status`=6 , note='$note', `date`= '$date', `whID`='$pickupwarehouseId', `paymentmethod`='$paymentmethod', `deliverymethod`='$deliverymethod' WHERE orderID='$orderId'";
       
                }
                else{
                $updateorder_sql = "UPDATE `orders` SET `status`=1 , note='$note', `date`= '$date', `whID`='$pickupwarehouseId', `paymentmethod`='$paymentmethod', `deliverymethod`='$deliverymethod' WHERE orderID='$orderId'";

                }
                // var_dump($charge->failure_message);
                $updateorder_res = mysqli_query($connection, $updateorder_sql);
               
                
                        if ($updateorder_res != "") {
                                // $updateorder_arr = mysqli_fetch_all($connection, $updateorder_res);
                                // $resultcount=count($updateorder_arr);
                                
                                if(isset($_GET['email']) && isset($updateorder_res)){
                                        
                                        // require 'Emailsending/mail_config.php';
                                        require '../Emailsending/mail_config.php';
                                        require '../Emailsending/successfulpayment_email.php';
                                        
        
echo'
<article id="fourth">
        <div class="invoicepaper" style=" border: 1px solid #bab9b9;border-radius: 25px;width: 100%;height: 100%;min-height: 300px;padding: 15px;">
                <div class="invoicetitle" style="text-align: center;font-size: 20px;font-weight: 700;">You made an order to <span class="brandindentify">LIQUOR LIBRARY<span></div>
                <hr>
                <div class="row" style="text-align: left!important;">
                        <div class="col-sm-6 col-md-4" style="border-right: 1px solid #bab9b9; height: 100%; min-height: 200px;">
                                <div class="order">
                                <div class="contacthead">Order Information</div>
                                <div>Order Id: <span>'.$orderId.'</span></div>
                                <div>Order items: <span>Total: '.$finalquantity.' items </span></div>
                                <div>Order Cost: <span>Total: NZ$ '.$fianlprice.'</span></div>
                                </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                        <div class="contacthead">Customer Information</div>
                        <div>Order Name: <span>'.$username.'</span></div>
                        <div>Order Email: <span>'.$email.'</span></div>
                        <div>Contact Number: <span>'.$contactnumber.'</span></div>
                        <div>Address: <span>'.$address.'</span></div>
    
                        </div>

                        <div class="col-sm-6 col-md-4" style="border-left: 1px solid #bab9b9; height: 100%; min-height: 200px;">
                                         <div class="contacthead">Shipping Information</div>';
                                        if($logintype==1){
                                        echo 'Not specified';
                                        }
                                        else if($logintype==2 || $logintype==3)
                                        {
                                                if($paymentmethod==2){
                                                        echo '<div>Payment Method: <span> Pay with Cash</span></div>';
                                                }
                                                else if($paymentmethod==1)
                                                {
                                                        echo '<div>Payment Method: <span> Pay with Card</span></div>';
       
                                                }

                                     echo     '<div>Delivery Method: <span>'.$deliverymethod.' </span></div>';
                                                if($deliverymethod=='pickup'){
                                                echo'<div>Pick Up Location: <span>'.$pickuplocation.'</span></div>';                                                
                                                } 
                                                else{
                                                        
                                                }     
                                        }
                                        else{
                                        echo 'something wrong';
                                        }


                   echo'     </div>
                </div>
                <hr>
                <div class="row" style="text-align: left!important;">
                        <div class="col-9">
                         <div>Thank you for your order, you can check your order status <a href="orderhistory.php">Click here</a></div>
                         <div>Also, we will notify the process status through your email.</div>
                         </div>
                         <div class="col-3">
                         <button type="submit" class="btn btn-secondary btn-sm" id="checkbutton" style="width:100%; height:60%;">
                        <a href="index.php"> GO BACK TO HOMEPAGE  </a>
                       
                     </button>                         
                         </div>

                        </div>
                </div>
        </div>
</article>';
                                        



                
                                }
                
                                                return 2;
                        } 
                        
        
        
        };
?>
