<?php
if(isset($_SESSION['admin'])){
// <!-- warehouse backorder -->
    $whID=0;
    $select_user="SELECT userID, whID FROM staff WHERE whID!=0";
    $select_month="SELECT now(), extract(month from now()) as mon";
    $select_year="SELECT now(), extract(year from now()) as yer";
    $selectuser_result=mysqli_query($connection, $select_user);

    $selectmonth_result=mysqli_query($connection, $select_month);
    $selectyear_result=mysqli_query($connection, $select_year);

    if ( $selectuser_result != "" && $selectmonth_result != "" && $selectyear_result != "" ) {
        $selectmonth_arr=mysqli_fetch_all($selectmonth_result);
        $selectyear_arr=mysqli_fetch_all($selectyear_result);
        $selectedmonth=$selectmonth_arr[0][1];
        $selectedyear=$selectyear_arr[0][1];
        // all the warehouse admin
        $selectuser_arr = mysqli_fetch_all($selectuser_result, MYSQLI_ASSOC);
        
        $backorder_arr=array();  
        
        for($a=0; $a <count($selectuser_arr); $a++){
            $userID=$selectuser_arr[$a]['userID'];
            $whID=$selectuser_arr[$a]['whID'];
            // echo $userID;
            // total backorder
            $select_order="SELECT * FROM orders WHERE buyerID='$userID' AND extract(month from date) = '$selectedmonth' AND status=4 order by `date`";
            $selectorder_result=mysqli_query($connection, $select_order);
            // $order_array[$a]=$selectorder_result;
          
              $order_array=mysqli_fetch_all($selectorder_result);
              // print_r($order_array); 
              if(!empty($order_array)){
                if(!empty($backorder_arr)){
                  $backorder_arr=array_merge($backorder_arr,$order_array);
                   echo '<br>';
                 }else{
                  $backorder_arr=array_merge($order_array);
                
                 }
                       
              }
              else{
                
              }
     
        };

    }
    else{
        echo "result empty";
    }

}
else{
    echo '<script type="text/javascript">';                
    echo 'alert("Please log in to proceed")';
    echo '</script>';
}
?>