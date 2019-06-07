<?php
  session_start();
  include ('../connection.php');
$updateorderid=$_GET['orderid'];
$updateitemid=$_GET['itemid'];
$updatequantity=$_GET['quantity'];
$updateprice=$_GET['updatetotal'];

 $cartitemupdate_sql = "UPDATE `orderitems` SET `quantity`='$updatequantity',`totalprice`='$updateprice' WHERE orderID='$updateorderid' and itemID='$updateitemid'";
  
 $cartitemupdate_res = mysqli_query($connection, $cartitemupdate_sql);
 
 if ($cartitemupdate_res != "") {
    echo 'result not empty';
   } else {
    echo 'result empty';
   }


?>
