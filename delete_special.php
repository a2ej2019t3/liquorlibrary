<?php
include("connection.php");
// echo "hai";
if(isset($_GET['specialId'])){
    $delete_special= $_GET['specialId'];
    $delete_specialId = 'delete from specials where specialId='.$delete_special;
    // echo $delete_specialId ;

    $run_delete = mysqli_query($connection, $delete_specialId);
    // var_dump($connection);
    
           echo "<script>alert('A banner has been deleted!')</script>";
       //echo "<script>window.open('index.php?view_brands','_self')</script>";
       
}
?>