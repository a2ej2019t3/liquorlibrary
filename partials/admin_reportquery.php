<?php
if (isset($_SESSION['admin'])) {

    // Total sales annually
    // function
    require_once('admin_arr_function.php');
    //initializing array
    $sales_annual_Arr = array();
    $sales_annual_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `status`=4 AND `paymentmethod`!='null' AND `deliverymethod`!='null' AND  extract(year from date) = '$selectedyear' order by `date`");
    // var_dump($sales_annual_Arr);
    if ($sales_annual_Arr) {
        $sales_number = count($sales_annual_Arr);
        $sales_amount = 0;

        for ($a = 0; $a < count($sales_annual_Arr); $a++) {
            $sum = $sales_annual_Arr[$a]['cost'];
            $sales_amount = $sales_amount + $sum;
        };
    } else {
        $sales_number = 0;
        $sales_amount = 0;
    }


    $sales_card_Arr = array();
    $sales_card_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `status`=4 AND `paymentmethod`='card' AND `deliverymethod`!='null' AND  extract(year from date) = '$selectedyear' order by `date`");
    $sales_cash_Arr = array();
    $sales_cash_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `status`=4 AND `paymentmethod`='cash' AND `deliverymethod`!='null' AND  extract(year from date) = '$selectedyear' order by `date`");
    if ($sales_card_Arr && $sales_cash_Arr) {
        $sales_card_number = count($sales_card_Arr);
        $sales_cash_number = count($sales_cash_Arr);
        $total_payment_number = count($sales_card_Arr) + count($sales_cash_Arr);
        $sales_card_amount = 0;
        $sales_cash_amount = 0;

        for ($a = 0; $a < count($sales_card_Arr); $a++) {
            $sum = $sales_card_Arr[$a]['cost'];
            $sales_card_amount = $sales_card_amount + $sum;
        };
        for ($a = 0; $a < count($sales_cash_Arr); $a++) {
            $sum = $sales_cash_Arr[$a]['cost'];
            $sales_cash_amount = $sales_cash_amount + $sum;
        };
    } else {
        if(empty($sales_cash_Arr)&& !empty($sales_card_Arr) ){
            $total_payment_number=count($sales_card_Arr);
        }
        else if(!empty($sales_cash_Arr)&& empty($sales_card_Arr) ){
            $total_payment_number=count($sales_cash_Arr);
        }
        else{
            $total_payment_number=0;
        }
        $sales_card_amount = 0;
        $sales_cash_amount = 0;
    }

    // delivery method

    $sales_pickup_Arr = array();
    $sales_pickup_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `status`=4 AND `paymentmethod`!='null' AND `deliverymethod`='pickup' AND  extract(year from date) = '$selectedyear' order by `date`");
    $sales_delivery_Arr = array();
    $sales_delivery_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `status`=4 AND `paymentmethod`!='null' AND `deliverymethod`='delivery' AND  extract(year from date) = '$selectedyear' order by `date`");
    if ($sales_pickup_Arr && $sales_delivery_Arr) {
        $sales_pickup_number = count($sales_pickup_Arr);
        $sales_delivery_number = count($sales_delivery_Arr);
        $total_payment_number = count($sales_pickup_Arr) + count($sales_delivery_Arr);
        $sales_pickup_amount = 0;
        $sales_delivery_amount = 0;

        for ($a = 0; $a < count($sales_pickup_Arr); $a++) {
            $sum = $sales_pickup_Arr[$a]['cost'];
            $sales_pickup_amount = $sales_pickup_amount + $sum;
        };
        for ($a = 0; $a < count($sales_delivery_Arr); $a++) {
            $sum = $sales_delivery_Arr[$a]['cost'];
            $sales_delivery_amount = $sales_delivery_amount + $sum;
        };
    } else {
        if(empty($sales_delivery_Arr)&& !empty($sales_pickup_Arr) ){
            $total_payment_number=count($sales_pickup_Arr);
        }
        else if(!empty($sales_delivery_Arr)&& empty($sales_pickup_Arr) ){
            $total_payment_number=count($sales_delivery_Arr);
        }
        else{
            $total_payment_number=0;
        }
        $sales_pickup_amount = 0;
        $sales_delivery_amount = 0;
    }

} else {
    echo '<script type="text/javascript">';
    echo 'alert("Please log in to proceed")';
    echo '</script>';
}
