<?php
if(isset($_GET['id'])){
    include ('../connection.php');
    $orderID= $_GET['id'];
    $buyerID= $_GET['buyerid'];
    $ready_sql="UPDATE orders SET status=4 WHERE orderID='$orderID'";
    $ready_res= mysqli_query($connection,$ready_sql);
    // $ready_arr=mysqli_fetch_all($ready_res);
}
?>