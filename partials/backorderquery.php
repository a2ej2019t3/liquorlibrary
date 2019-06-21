<?php

    if ( isset($selectuser_result) && isset($selectmonth_result) &&  isset($selectyear_result)) {
        // $selectmonth_arr=mysqli_fetch_all($selectmonth_result);
        // $selectyear_arr=mysqli_fetch_all($selectyear_result);
        // $selectedmonth=$selectmonth_arr[0][1];
        // $selectedyear=$selectyear_arr[0][1];
        // // store this month data
        // $selectuser_arr = mysqli_fetch_all($selectuser_result);
        $totalbackorder_arr=array();  
        $shippingorder_arr=array();  
        $cancelorder_arr=array();  
        $paidorder_arr=array();
        for($a=0; $a <count($selectuser_arr); $a++){
            $userID=$selectuser_arr[$a][0];
            // echo $userID;
            // selecting all the order made under this warehouse
            $select_totalorder="SELECT * FROM orders WHERE buyerID='$userID' AND NOT status=0 order by `date` DESC";
            $selecttotalorder_result=mysqli_query($connection, $select_totalorder);
            // $order_array[$a]=$selectorder_result;
          
              $totalorder_array=mysqli_fetch_all($selecttotalorder_result);
              // print_r($order_array); 
              if(!empty($totalorder_array)){
                if(!empty($totalbackorder_arr)){
                  $totalbackorder_arr=array_merge($totalbackorder_arr,$totalorder_array);
                   echo '<br>';
                 }else{
                  $totalbackorder_arr=array_merge($totalorder_array);
                
                 }
                       
              }
     
        };
        // select shipping backorders
        for($a=0; $a <count($selectuser_arr); $a++){
            $userID=$selectuser_arr[$a][0];
            // echo $userID;
            $select_shippingorder="SELECT * FROM orders WHERE buyerID='$userID'AND status=7 order by `date` DESC";
            $selectshinppingorder_result=mysqli_query($connection, $select_shippingorder);
            // $order_array[$a]=$selectorder_result;
          
              $shippingorder_array=mysqli_fetch_all($selectshinppingorder_result);
              // print_r($order_array); 
              if(!empty($shippingorder_array)){
                if(!empty($shippingorder_arr)){
                  $shippingorder_arr=array_merge($shippingorder_arr,$shippingorder_array);
                   echo '<br>';
                 }else{
                  $shippingorder_arr=array_merge($shippingorder_array);
                  
                 }
                  
              }
     
        };
        // select paid back order
        for($a=0; $a <count($selectuser_arr); $a++){
            $userID=$selectuser_arr[$a][0];
            // echo $userID;
            $select_paidorder="SELECT * FROM orders WHERE buyerID='$userID'AND status=1 order by `date` DESC";
            $selectpaidorder_result=mysqli_query($connection, $select_paidorder);
            // $order_array[$a]=$selectorder_result;
          
              $paidorder_array=mysqli_fetch_all($selectpaidorder_result);
              // print_r($order_array); 
              if(!empty($paidorder_array)){
                if(!empty($paidorder_arr)){
                  $paidorder_arr=array_merge($paidorder_arr,$paidorder_array);
                   echo '<br>';
                 }else{
                  $paidorder_arr=array_merge($paidorder_array);
                  
                 }
                  
              }
     
        };

// cancelled order
for($a=0; $a <count($selectuser_arr); $a++){
    $userID=$selectuser_arr[$a][0];
    // echo $userID;
    $select_cancelorder="SELECT * FROM orders WHERE buyerID='$userID'AND status=5 order by `date` DESC";
    $selectcancelorder_result=mysqli_query($connection, $select_cancelorder);
    // $order_array[$a]=$selectorder_result;
  
      $cancelorder_array=mysqli_fetch_all($selectcancelorder_result);
      // print_r($order_array); 
      if(!empty($cancelorder_array)){
        if(!empty($cancelorder_arr)){
          $cancelorder_arr=array_merge($cancelorder_arr,$cancelorder_array);
           echo '<br>';
         }else{
          $cancelorder_arr=array_merge($cancelorder_array);
          
         }
          
      }

};

                
      } else {
        echo "result empty";
      }

    ?>











                    