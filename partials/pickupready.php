<?php
if(isset($_GET['id'])){
    include ('../connection.php');
    $orderID= $_GET['id'];
    $buyerID= $_GET['buyerid'];
    $ready_sql="UPDATE orders SET status=3 WHERE orderID='$orderID'";
    $ready_res= mysqli_query($connection,$ready_sql);
    // $ready_arr=mysqli_fetch_all($ready_res);
    
        if(!empty($ready_res)){
            $selectemail_sql="SELECT email from users WHERE userID='$buyerID'";
            $selectemail_res= mysqli_query($connection,$selectemail_sql);
            $selectemail_array=mysqli_fetch_all($selectemail_res);
            if(!empty($selectemail_array)){
                $buyeremail=$selectemail_array[0][0];
            
                if($buyeremail !=null){
                    require '../Emailsending/pickup_ready_email.php';
                }
            }
            
        }
   
    
}
?>