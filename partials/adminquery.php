<?php
// *Backorder data*
// 1. Total completed backorders = $confirm_backorder_Arr
// 2. this month completed backorders =$confirm_backorder_monthly_Arr
// 3. pending backorders=$pending_backorder_Arr
// 4. Total completed backorder cost= $confirm_backorder_cost
// 5. this month completed backorders cost= $confirm_backorder_monthly_cost

// *Delivery data*
// 1. Total completed delivery order= $completed_delivery_Arr
// 2. this month completed delivery order=$completed_delivery_monthly_Arr
// 3. pending delivery =$pending_delivery_Arr
// 4. Total completed delivery cost=$confirm_delivery_cost
// 5. this month completed delivery cost=$confirm_delivery_monthly_cost

if (isset($_SESSION['admin'])) {
    // <!-- warehouse backorder -->
    $whID = 0;
    $_SESSION['connection'] = $connection;
    $select_user = "SELECT userID, whID FROM staff WHERE whID!=0";
    $select_month = "SELECT now(), extract(month from now()) as mon";
    $select_year = "SELECT now(), extract(year from now()) as yer";
    $selectuser_result = mysqli_query($connection, $select_user);

    $selectmonth_result = mysqli_query($connection, $select_month);
    $selectyear_result = mysqli_query($connection, $select_year);

    if ($selectuser_result != "" && $selectmonth_result != "" && $selectyear_result != "") {
        $selectmonth_arr = mysqli_fetch_all($selectmonth_result);
        $selectyear_arr = mysqli_fetch_all($selectyear_result);
        $selectedmonth = $selectmonth_arr[0][1];
        $selectedyear = $selectyear_arr[0][1];
        // all the warehouse admin
        $selectuser_arr = mysqli_fetch_all($selectuser_result, MYSQLI_ASSOC);

        // $backorder_arr=array();  
        // function
        function getBackorders($connection = " ", $userID = " ", $condition = " ")
        {

            $connection = $_SESSION['connection'];
            if ($condition!==" " && $userID!==" ") {

                $select_order = "SELECT * FROM orders WHERE buyerID=$userID";
                $select_order = $select_order . $condition;
                // echo  $select_order;
            } else if($condition!==" " && $userID ==" "){
                $select_order = "SELECT * FROM orders WHERE";
                $select_order = $select_order . $condition;
            } else{
                $select_order = "SELECT * FROM orders";
            }
            $selectorder_result = mysqli_query($connection, $select_order);
            $order_array = mysqli_fetch_all($selectorder_result, MYSQLI_ASSOC);
            $backorder_arr = array();
            if (!empty($order_array)) {
                if (!empty($backorder_arr)) {
                    $backorder_arr = array_merge($backorder_arr, $order_array);
                    echo '<br>';
                } else {
                    $backorder_arr = array_merge($order_array);
                }
            } else { }
            return $backorder_arr;
        }

        // all the backorder from warehouse
        for ($a = 0; $a < count($selectuser_arr); $a++) {
            $userID = $selectuser_arr[$a]['userID'];
            // echo $userID;
            // $GLOBALS[$userID] = $userID;
            $whID = $selectuser_arr[$a]['whID'];
            // total completed backorders
            $confirm_backorder_Arr = array();
            $confirm_backorder_Arr = getBackorders($connection = " ", $userID = $selectuser_arr[$a]['userID'], $condition = " AND status=4 AND `paymentmethod`='null' AND `deliverymethod`='null'order by `date`");
            // monthly completed backorders
            $confirm_backorder_monthly_Arr = array();
            $confirm_backorder_monthly_Arr = getBackorders($connection = " ", $userID = $selectuser_arr[$a]['userID'], $condition = " AND status=4 AND  extract(month from date) = '$selectedmonth'  AND `paymentmethod`='null' AND `deliverymethod`='null' order by `date`");
            // pending backorders
            $pending_backorder_Arr = array();
            $pending_backorder_Arr = getBackorders($connection = " ", $userID = $selectuser_arr[$a]['userID'], $condition = " AND status!=4 AND status!=0 AND status!=5  AND `paymentmethod`='null' AND `deliverymethod`='null' order by `date`");
        };
            //  amount calculate
            // total completed backorders cost
            if(!empty($confirm_backorder_Arr)){
                $confirm_backorder_cost=0;
                for($a=0;$a<count($confirm_backorder_Arr); $a++){
                $sum = $confirm_backorder_Arr[$a]['cost'];
                
                $confirm_backorder_cost=$confirm_backorder_cost+$sum;
                };              
              }
              else{
                $confirm_backorder_cost=0;
              }

            // var_dump($pending_backorder_Arr);
            // echo $confirm_backorder_cost;
            if(!empty($confirm_backorder_monthly_Arr)){
                $confirm_backorder_monthly_cost=0;
                for($a=0;$a<count($confirm_backorder_monthly_Arr); $a++){
                $sum = $confirm_backorder_monthly_Arr[$a]['cost'];
                
                $confirm_backorder_monthly_cost=$confirm_backorder_monthly_cost+$sum;
                };              
              }
              else{
                $confirm_backorder_monthly_cost=0;
              }

            // echo $confirm_backorder_monthly_cost;

            // delievery data select
            $completed_delivery_Arr = array();
            $completed_delivery_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `status`=4 AND `deliverymethod`='delivery' order by `date`");
            // var_dump($completed_delivery_Arr);
            $completed_delivery_monthly_Arr = array();
            $completed_delivery_monthly_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `status`=4 AND `deliverymethod`='delivery' AND  extract(month from date) = '$selectedmonth' order by `date`");
            // var_dump($completed_delivery_monthly_Arr);
            $pending_delivery_Arr = array();
            $pending_delivery_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `deliverymethod`='delivery' AND status!=4 AND status!=5 AND status!=6 AND status!=0 order by `date`");
            // var_dump($pending_delivery_Arr);

            // delivery income calculate
            if(!empty($completed_delivery_Arr)){
                $confirm_delivery_cost=0;
                for($a=0;$a<count($completed_delivery_Arr); $a++){
                $sum = $completed_delivery_Arr[$a]['cost'];
                
                $confirm_delivery_cost=$confirm_delivery_cost+$sum;
                };              
              }
              else{
                $confirm_delivery_cost=0;
              }
            //   echo $confirm_delivery_monthly_cost;
            if(!empty($completed_delivery_monthly_Arr)){
                $confirm_delivery_monthly_cost=0;
                for($a=0;$a<count($completed_delivery_monthly_Arr); $a++){
                $sum = $completed_delivery_monthly_Arr[$a]['cost'];
                
                $confirm_delivery_monthly_cost=$confirm_delivery_monthly_cost+$sum;
                };              
              }
              else{
                $confirm_delivery_monthly_cost=0;
              }
                //  echo $confirm_delivery_monthly_cost;

            // pickup orders data select
            $completed_pickup_Arr = array();
            $completed_pickup_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `status`=4 AND `deliverymethod`='pickup' AND whID='0' order by `date`");
            // var_dump($completed_delivery_Arr);
            $completed_pickup_monthly_Arr = array();
            $completed_pickup_monthly_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `status`=4 AND `deliverymethod`='pickup' AND whID='0' AND  extract(month from date) = '$selectedmonth' order by `date`");
            // var_dump($completed_delivery_monthly_Arr);
            $pending_pickup_Arr = array();
            $pending_pickup_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `deliverymethod`='pickup' AND whID='0' AND status!=4 AND status!=5 AND status!=0 order by `date`");
            // var_dump($pending_delivery_Arr);

            // delivery income calculate
            if(!empty($completed_pickup_Arr)){
                $confirm_pickup_cost=0;
                for($a=0;$a<count($completed_pickup_Arr); $a++){
                $sum = $completed_pickup_Arr[$a]['cost'];
                
                $confirm_pickup_cost=$confirm_pickup_cost+$sum;
                };              
              }
              else{
                $confirm_pickup_cost=0;
              }
            //   echo $confirm_delivery_monthly_cost;
            if(!empty($completed_pickup_monthly_Arr)){
                $confirm_pickup_monthly_cost=0;
                for($a=0;$a<count($completed_pickup_monthly_Arr); $a++){
                $sum = $completed_pickup_monthly_Arr[$a]['cost'];
                
                $confirm_pickup_monthly_cost=$confirm_pickup_monthly_cost+$sum;
                };              
              }
              else{
                $confirm_pickup_monthly_cost=0;
              }
                //  echo $confirm_delivery_monthly_cost;


    } else {
        echo "result empty";
    }
} else {
    echo '<script type="text/javascript">';
    echo 'alert("Please log in to proceed")';
    echo '</script>';
}
