<?php
// *Backorder data*
// 1. Total completed backorders = $confirm_backorder_Arr
// 2. this month completed backorders =$confirm_backorder_monthly_Arr
// 3. pending backorders=$pending_backorder_Arr
// 4. Total completed backorder cost= $confirm_backorder_cost
// 5. this month completed backorders cost= $confirm_backorder_monthly_cost

// 6. paid (new backorder need to be shipped) =$new_backorder_Arr
// 7. shipping backorder(need to be completed or cancelled)= $shipping_backorder_Arr

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
    switch($selectedmonth){
      case 1:
      $selectedmonthname= 'Jan';
      break;
      case 2:
      $selectedmonthname= 'Feb';
      break;
      case 3:
      $selectedmonthname= 'Mar';
      break;
      case 4:
      $selectedmonthname= 'Apr';
      break;
      case 5:
      $selectedmonthname= 'May';
      break;
      case 6:
      $selectedmonthname= 'Jun';
      break;
      case 7:
      $selectedmonthname= 'Jul';
      break;
      case 8:
      $selectedmonthname= 'Aug';
      break;
      case 9:
      $selectedmonthname= 'Sep';
      break;
      case 10:
      $selectedmonthname= 'Oct';
      break;
      case 11:
      $selectedmonthname= 'Nov';
      break;
      case 12:
      $selectedmonthname= 'Dec';
      break;

    }
    $selectedyear = $selectyear_arr[0][1];
    // all the warehouse admin
    $selectuser_arr = mysqli_fetch_all($selectuser_result, MYSQLI_ASSOC);

    // $backorder_arr=array();  
    // function
    require_once('admin_arr_function.php');

    // all the backorder from warehouse
    $confirm_backorder_Arr = array();
    $confirm_backorder_monthly_Arr = array();
    $pending_backorder_Arr = array();
    $new_backorder_Arr = array();
    $shipping_backorder_Arr = array();
    $cancel_backorder_Arr = array();
    for ($a = 0; $a < count($selectuser_arr); $a++) {
      $userID = $selectuser_arr[$a]['userID'];
      // var_dump($selectuser_arr);
      // echo count($selectuser_arr);

      $whID = $selectuser_arr[$a]['whID'];


      // total completed backorders
      $confirm_backorder_Array = array();
      $confirm_backorder_Array = getBranchorder($connection = " ", $userID = $selectuser_arr[$a]['userID'], $condition = " AND status=4 AND `paymentmethod`='null' AND `deliverymethod`='null'order by `date`", $whID = $whID);

      $confirm_backorder_Arr = array_merge($confirm_backorder_Arr, $confirm_backorder_Array);
      // var_dump($confirm_backorder_Array);
      // monthly completed backorders
      $confirm_backorder_monthly_Array = array();
      $confirm_backorder_monthly_Array = getBackorders($connection = " ", $userID = $selectuser_arr[$a]['userID'], $condition = " AND status=4 AND  extract(month from date) = '$selectedmonth'  AND `paymentmethod`='null' AND `deliverymethod`='null' order by `date`");

      $confirm_backorder_monthly_Arr = array_merge($confirm_backorder_monthly_Arr, $confirm_backorder_monthly_Array);


      // pending backorders
      $pending_backorder_Array = array();
      $pending_backorder_Array = getBackorders($connection = " ", $userID = $selectuser_arr[$a]['userID'], $condition = " AND status!=4 AND status!=0 AND status!=5  AND `paymentmethod`='null' AND `deliverymethod`='null' order by `date`");

      $pending_backorder_Arr = array_merge($pending_backorder_Arr, $pending_backorder_Array);

      // New backorder
      $new_backorder_Array = array();
      $new_backorder_Array = getBranchorder($connection = " ", $userID = $selectuser_arr[$a]['userID'], $condition = " AND status=1 AND `paymentmethod`='null' AND `deliverymethod`='null'order by `date`", $whID = $whID);

      $new_backorder_Arr = array_merge($new_backorder_Arr, $new_backorder_Array);

      $shipping_backorder_Array = array();
      $shipping_backorder_Array = getBranchorder($connection = " ", $userID = $selectuser_arr[$a]['userID'], $condition = " AND status=7 AND `paymentmethod`='null' AND `deliverymethod`='null'order by `date`", $whID = $whID);

      $shipping_backorder_Arr = array_merge($shipping_backorder_Arr, $shipping_backorder_Array);
      // cancel backordr
      $cancel_backorder_Array = array();
      $cancel_backorder_Array = getBranchorder($connection = " ", $userID = $selectuser_arr[$a]['userID'], $condition = " AND status=5 AND `paymentmethod`='null' AND `deliverymethod`='null'order by `date`", $whID = $whID);

      $cancel_backorder_Arr = array_merge($cancel_backorder_Arr, $cancel_backorder_Array);
    };

    // var_dump($confirm_backorder_Arr);
    //  amount calculate
    // total completed backorders cost
    if (!empty($confirm_backorder_Arr)) {
      $confirm_backorder_cost = 0;
      for ($a = 0; $a < count($confirm_backorder_Arr); $a++) {
        $sum = $confirm_backorder_Arr[$a]['cost'];

        $confirm_backorder_cost = $confirm_backorder_cost + $sum;
      };
    } else {
      $confirm_backorder_cost = 0;
    }

    // var_dump($pending_backorder_Arr);
    // echo $confirm_backorder_cost;
    if (!empty($confirm_backorder_monthly_Arr)) {
      $confirm_backorder_monthly_cost = 0;
      for ($a = 0; $a < count($confirm_backorder_monthly_Arr); $a++) {
        $sum = $confirm_backorder_monthly_Arr[$a]['cost'];

        $confirm_backorder_monthly_cost = $confirm_backorder_monthly_cost + $sum;
      };
    } else {
      $confirm_backorder_monthly_cost = 0;
    }

    // echo $confirm_backorder_monthly_cost;

    // delievery data select

    // total sales
    $totalsales_Arr = array();
    $totalsales_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `status`=4 AND `paymentmethod`!='null' AND `deliverymethod`!='null' order by `date`");
    
    if (!empty($totalsales_Arr)) {
      $totalsales_Arr_cost = 0;
      for ($a = 0; $a < count($totalsales_Arr); $a++) {
        $sum = $totalsales_Arr[$a]['cost'];

        $totalsales_Arr_cost = $totalsales_Arr_cost + $sum;
      };
    } else {
      $totalsales_Arr_cost = 0;
    }

    
// total monthly sales
    $totalsales_monthly_Arr = array();
    $totalsales_monthly_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `status`=4 AND `paymentmethod`!='null' AND `deliverymethod`!='null'  extract(month from date) = '$selectedmonth' order by `date`");

    if (!empty($totalsales_monthly_Arr)) {
      $totalsales_monthly_Arr_cost = 0;
      for ($a = 0; $a < count($totalsales_monthly_Arr); $a++) {
        $sum = $totalsales_monthly_Arr[$a]['cost'];

        $totalsales_monthly_Arr_cost = $totalsales_monthly_Arr_cost + $sum;
      };
    } else {
      $totalsales_monthly_Arr_cost = 0;
    }

    $completed_delivery_Arr = array();
    $completed_delivery_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `status`=4 AND `deliverymethod`='delivery' order by `date`");
    // var_dump($completed_delivery_Arr);
    $completed_delivery_monthly_Arr = array();
    $completed_delivery_monthly_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `status`=4 AND `deliverymethod`='delivery' AND  extract(month from date) = '$selectedmonth' order by `date`");
    // var_dump($completed_delivery_monthly_Arr);
    $pending_delivery_Arr = array();
    $pending_delivery_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `deliverymethod`='delivery' AND status!=4 AND status!=5 AND status!=6 AND status!=0 order by `date`");
    // var_dump($pending_delivery_Arr);
    $new_delivery_Arr = array();
    $new_delivery_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `deliverymethod`='delivery' AND status=1 order by `date`");

    // shipping delivery
    $shpping_delivery_Arr = array();
    $shpping_delivery_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `deliverymethod`='delivery' AND status=7 order by `date`");

    // cancell DELIEVERY
    
    $cancel_delivery_Arr = array();
    $cancel_delivery_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `deliverymethod`='delivery' AND status=5 order by `date`");


    // delivery income calculate
    if (!empty($completed_delivery_Arr)) {
      $confirm_delivery_cost = 0;
      for ($a = 0; $a < count($completed_delivery_Arr); $a++) {
        $sum = $completed_delivery_Arr[$a]['cost'];

        $confirm_delivery_cost = $confirm_delivery_cost + $sum;
      };
    } else {
      $confirm_delivery_cost = 0;
    }
    //   echo $confirm_delivery_monthly_cost;
    if (!empty($completed_delivery_monthly_Arr)) {
      $confirm_delivery_monthly_cost = 0;
      for ($a = 0; $a < count($completed_delivery_monthly_Arr); $a++) {
        $sum = $completed_delivery_monthly_Arr[$a]['cost'];

        $confirm_delivery_monthly_cost = $confirm_delivery_monthly_cost + $sum;
      };
    } else {
      $confirm_delivery_monthly_cost = 0;
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
    $new_pickup_Arr = array();
    $new_pickup_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `deliverymethod`='pickup' AND whID='0' AND status=1 or `deliverymethod`='pickup' AND whID='0' AND status=6 order by `date`");
// READY PICKUPS
$ready_pickup_Arr = array();
$ready_pickup_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `deliverymethod`='pickup' AND whID='0' AND status=3 order by `date`");
// cancel
    
$cancel_pickup_Arr = array();
$cancel_pickup_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `deliverymethod`='pickup'  AND whID='0' AND status=5 order by `date`");



    // delivery income calculate
    if (!empty($completed_pickup_Arr)) {
      $confirm_pickup_cost = 0;
      for ($a = 0; $a < count($completed_pickup_Arr); $a++) {
        $sum = $completed_pickup_Arr[$a]['cost'];

        $confirm_pickup_cost = $confirm_pickup_cost + $sum;
      };
    } else {
      $confirm_pickup_cost = 0;
    }
    //   echo $confirm_delivery_monthly_cost;
    if (!empty($completed_pickup_monthly_Arr)) {
      $confirm_pickup_monthly_cost = 0;
      for ($a = 0; $a < count($completed_pickup_monthly_Arr); $a++) {
        $sum = $completed_pickup_monthly_Arr[$a]['cost'];

        $confirm_pickup_monthly_cost = $confirm_pickup_monthly_cost + $sum;
      };
    } else {
      $confirm_pickup_monthly_cost = 0;
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
