<?php


$get_day = array(
    '1' => "Jan",
    '2' => "Feb",
    '3' => "Mar",
    '4' => "Apr",
    '5' => "May",
    '6' => "Jun",
    '7' => "Jul",
    '8' => "Aug",
    '9' => "Sep",
    '10' => "Oct",
    '11' => "Nov",
    '12' => "Dec"
);
if ($selectedmonth != null) {
    // $get_startmonth= $selectedmonth-11;
    $montharray = array();
    $yeararray = array();
    $incomearray = array();

    $b = 0;
    $e = 0;
    for ($a = 11; $a >= 0; $a--) {
        $get_startmonth = $selectedmonth - $a;
        if ($get_startmonth <= 0) {
            $pointmonth = $get_startmonth + 12;
            $yeararray[$b] = $selectedyear - 1;
        } else {
            $pointmonth = $get_startmonth;
            $yeararray[$b] = $selectedyear;
        }
        $montharray[$b] = $pointmonth;
        $b++;
    }
    // var_dump($yeararray);
    //   echo $montharray[11];
    //   echo $get_day[$montharray[11]];
    if (!empty($montharray)) {
        require_once('admin_arr_function.php');

        for ($c = 0; $c < count($montharray); $c++) {

            $monthly_delivery_Arr = array();
            $monthly_delivery_Arr = getBackorders($connection = " ", $userID = " ", $condition = " `status`=4 AND `deliverymethod`='delivery' AND extract(month from date) = $montharray[$c] AND extract(year from date) = $yeararray[$c]");

            $monthly_pick_Arr = array();
            $monthly_pick_Arr = getBackorders($connection = " ", $userID = " ", $condition = " whID=0 AND `status`=4 AND `deliverymethod`='pickup' AND extract(month from date) = $montharray[$c] AND extract(year from date) = $yeararray[$c]");

            // echo count($monthly_delivery_Arr);
            // echo count($monthly_pick_Arr);

            $totaldelivery_earning = 0;
            $totalpickup_earning = 0;


            for ($d = 0; $d < count($monthly_delivery_Arr); $d++) {
                $sum = $monthly_delivery_Arr[$d]['cost'];
                $totaldelivery_earning = $totaldelivery_earning + $sum;
            }
            for ($d = 0; $d < count($monthly_pick_Arr); $d++) {
                $sum = $monthly_pick_Arr[$d]['cost'];
                $totalpickup_earning = $totalpickup_earning + $sum;
            }

            $income_delivery_array[$c]=$totaldelivery_earning;
            $income_pickup_array[$c]=$totalpickup_earning;

        }
    }
    // print_r( $income_delivery_array);
    // print_r( $income_pickup_array);

    $dataPoints_delivery = array(
        array("y" => $income_delivery_array[0], "label" => $yeararray[0] . $get_day[$montharray[0]]),
        array("y" => $income_delivery_array[1], "label" => $yeararray[1] . $get_day[$montharray[1]]),
        array("y" => $income_delivery_array[2], "label" => $yeararray[2] . $get_day[$montharray[2]]),
        array("y" => $income_delivery_array[3], "label" => $yeararray[3] . $get_day[$montharray[3]]),
        array("y" => $income_delivery_array[4], "label" => $yeararray[4] . $get_day[$montharray[4]]),
        array("y" => $income_delivery_array[5], "label" => $yeararray[5] . $get_day[$montharray[5]]),
        array("y" => $income_delivery_array[6], "label" => $yeararray[6] . $get_day[$montharray[6]]),
        array("y" => $income_delivery_array[7], "label" => $yeararray[7] . $get_day[$montharray[7]]),
        array("y" => $income_delivery_array[8], "label" => $yeararray[8] . $get_day[$montharray[8]]),
        array("y" => $income_delivery_array[9], "label" =>  $yeararray[9] . $get_day[$montharray[9]]),
        array("y" => $income_delivery_array[10], "label" =>  $yeararray[10] . $get_day[$montharray[10]]),
        
    );
    $dataPoints_pickup = array(
        array("y" => $income_pickup_array[0], "label" => $yeararray[0] . $get_day[$montharray[0]]),
        array("y" => $income_pickup_array[1], "label" => $yeararray[1] . $get_day[$montharray[1]]),
        array("y" => $income_pickup_array[2], "label" => $yeararray[2] . $get_day[$montharray[2]]),
        array("y" => $income_pickup_array[3], "label" => $yeararray[3] . $get_day[$montharray[3]]),
        array("y" => $income_pickup_array[4], "label" => $yeararray[4] . $get_day[$montharray[4]]),
        array("y" => $income_pickup_array[5], "label" => $yeararray[5] . $get_day[$montharray[5]]),
        array("y" => $income_pickup_array[6], "label" => $yeararray[6] . $get_day[$montharray[6]]),
        array("y" => $income_pickup_array[7], "label" => $yeararray[7] . $get_day[$montharray[7]]),
        array("y" => $income_pickup_array[8], "label" => $yeararray[8] . $get_day[$montharray[8]]),
        array("y" => $income_pickup_array[9], "label" =>  $yeararray[9] . $get_day[$montharray[9]]),
        array("y" => $income_pickup_array[10], "label" =>  $yeararray[10] . $get_day[$montharray[10]]),
    );



}
