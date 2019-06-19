<?php

if(isset($_SESSION['warehouse']['whID'])){
    $whID=$_SESSION['warehouse']['whID'];
        // Select pick up orders information
        $pickupCard_query="SELECT * from orders where whID='$whID' AND deliverymethod='pickup' AND status=4 AND paymentmethod='card'";
        $pickupCash_query="SELECT * from orders where whID='$whID' AND deliverymethod='pickup' AND status=4 AND paymentmethod='cash'";
        
        $pickupCard_res=mysqli_query($connection, $pickupCard_query);
        $pickupCash_res=mysqli_query($connection, $pickupCash_query);     
        if ( $pickupCard_res != "" && $pickupCash_res != "") {
            $card_arr=mysqli_fetch_all($pickupCard_res);

            $cash_arr=mysqli_fetch_all($pickupCash_res);
            if(!empty($card_arr)&& !empty($cash_arr)){
                $totalVisitors=count($card_arr)+count($cash_arr);
                $numberofcash=count($cash_arr);
                $numberofcard=count($card_arr);
                 // $totalVisitors = 883000;              
                $paymentmethodDataPoints = array(
                    array("y"=> $numberofcard, "name"=> "Card", "color"=> "#E7823A"),
                    array("y"=> $numberofcash, "name"=> "Cash", "color"=> "#546BC1")
                );
                 
                $payDataPoints = array(
                    array("x"=> 1420050600000 , "y"=> 33000),
                    array("x"=> 1422729000000 , "y"=> 35960),
                    array("x"=> 1425148200000 , "y"=> 42160),
                    array("x"=> 1427826600000 , "y"=> 42240),
                    array("x"=> 1430418600000 , "y"=> 43200),
                    array("x"=> 1433097000000 , "y"=> 40600),
                    array("x"=> 1435689000000 , "y"=> 42560),
                    array("x"=> 1438367400000 , "y"=> 44280),
                    array("x"=> 1441045800000 , "y"=> 44800),
                    array("x"=> 1443637800000 , "y"=> 48720),
                    array("x"=> 1446316200000 , "y"=> 50840),
                    array("x"=> 1448908200000 , "y"=> 51600)
                );
                 
                $returningpayDataPoints = array(
                    array("x"=> 1420050600000 , "y"=> 22000),
                    array("x"=> 1422729000000 , "y"=> 26040),
                    array("x"=> 1425148200000 , "y"=> 25840),
                    array("x"=> 1427826600000 , "y"=> 23760),
                    array("x"=> 1430418600000 , "y"=> 28800),
                    array("x"=> 1433097000000 , "y"=> 29400),
                    array("x"=> 1435689000000 , "y"=> 33440),
                    array("x"=> 1438367400000 , "y"=> 37720),
                    array("x"=> 1441045800000 , "y"=> 35200),
                    array("x"=> 1443637800000 , "y"=> 35280),
                    array("x"=> 1446316200000 , "y"=> 31160),
                    array("x"=> 1448908200000 , "y"=> 34400)
                ); 
               
            }

        }


}
else{
        echo '<script type="text/javascript">';                
        echo 'alert("Please log in to proceed")';
        echo '</script>';
}
// $totalVisitors = 883000;
 