<?php
if(isset($_SESSION['warehouse']['whID'])){
    $whID=$_SESSION['warehouse']['whID'];
    // echo $whID;
    $select_user="SELECT userID FROM staff WHERE whID='$whID'";
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
        // store this month data
        $selectuser_arr = mysqli_fetch_all($selectuser_result);
        $backorder_arr=array();  
        
        for($a=0; $a <count($selectuser_arr); $a++){
            $userID=$selectuser_arr[$a][0];
            // echo $userID;
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
        // select pending backorders
        for($a=0; $a <count($selectuser_arr); $a++){
            $userID=$selectuser_arr[$a][0];
            // echo $userID;
            $select_pendingorder="SELECT * FROM orders WHERE buyerID='$userID' AND extract(month from date) = '$selectedmonth'  AND extract(year from date) = '$selectedyear'and status=1 or status=2 or status=7 order by `date`";
            $selectpendingorder_result=mysqli_query($connection, $select_pendingorder);
            // $order_array[$a]=$selectorder_result;
          
              $pendingorder_array=mysqli_fetch_all($selectpendingorder_result);
              // print_r($order_array); 
              if(!empty($pendingorder_array)){
                if(!empty($pendingbackorder_arr)){
                  $pendingbackorder_arr=array_merge($pendingbackorder_arr,$pendingorder_array);
                   echo '<br>';
                 }else{
                  $pendingbackorder_arr=array_merge($pendingorder_array);
                  
                 }
                  
              }
              else{
              }
     
        };
        // 
        if(!empty($backorder_arr)){
          $totalbackorder_cost=0;
          for($a=0;$a<count($backorder_arr); $a++){
          $sum = $backorder_arr[$a][6];
          
          $totalbackorder_cost=$totalbackorder_cost+$sum;
          };              
        }
        else{
          $totalbackorder_cost=0;
        }
 
        // echo  $totalbackorder_cost;
        // var_dump($backorder_arr);

          // Select pick up orders information
          $pickuporders_query="SELECT * from orders where whID='$whID' AND deliverymethod='pickup' AND status=4  AND extract(month from date) = '$selectedmonth'";
          $pendingpickuporders_query="SELECT * from orders where whID='$whID' AND deliverymethod='pickup' AND status=1 or status=3 or status=6";
          
          $pickuporders_res=mysqli_query($connection, $pickuporders_query);
          $pendingpickups_res=mysqli_query($connection, $pendingpickuporders_query);
          if ( $pickuporders_res != ""&& $selectmonth_result != "") {
                $pickups_arr=mysqli_fetch_all($pickuporders_res);
                $pendingpickups_arr=mysqli_fetch_all($pendingpickups_res);

                if(!empty($pickups_arr)){
                    $totalpickup_income=0;
                    for($a=0;$a<count($pickups_arr); $a++){
                    $sum = $pickups_arr[$a][6];
                    
                    $totalpickup_income=$totalpickup_income+$sum;
                    };              
                }
                else{
                  $totalpickup_income=0;
                }

          }
                
      } else {
        echo "result empty";
      }
    }
    else{
      echo '<script type="text/javascript">';                
      echo 'alert("Please log in to proceed")';
      echo '</script>';
    }
    ?>