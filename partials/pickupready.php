<?php
if(isset($_GET['id'])){
    include ('../connection.php');
    $orderID= $_GET['id'];
    $buyerID= $_GET['buyerid'];

    $ready_sql="UPDATE orders status=3 WHERE orderID='$orderID'";
    $ready_res= mysqli_query($connection,$ready_sql);
    // if(!empty($ready_res)){
        
    // }
    
        if(!empty($ready_res)){
            $selectemail_sql="SELECT email from users WHERE userID='$buyerID'";
            $selectemail_res=mysqli_query($connection,$selectemail_sql);
            if(!empty($selectemail_res)){
                $selectemail_array=mysqli_fetch_all($selectemail_res);
                $buyeremail=$selectemail_array[0][0];
                if($buyeremail !=null){
                    require '../Emailsending/pickup_ready_email.php';
                }
            }
            
        }
   
    
}
?>