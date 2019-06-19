<?php
 

$get_day = array('1' =>"Jan",
                     '2' =>"Feb",
                     '3' =>"Mar",
                     '4' =>"Apr",
                     '5' =>"May",
                     '6' =>"Jun",
                     '7' =>"Jul",
                     '8' =>"Aug",
                     '9' =>"Sep",
                     '10' =>"Oct",
                     '11' =>"Nov",
                     '12' =>"Dec"
);
if($selectedmonth !=null){
    // $get_startmonth= $selectedmonth-11;
    $montharray = array();
    $incomearray = array();
    
    $b=0;
    for($a=11;$a>=0;$a--){
        $get_startmonth= $selectedmonth-$a;
        if($get_startmonth<=0){
            $pointmonth=$get_startmonth+12;
           

        }
        else{
            $pointmonth=$get_startmonth;
        }
            $montharray[$b]=$pointmonth;
                $b++;
                
    }
//   echo $montharray[0];
    if(!empty($montharray)){
        $totalpickup_earning=0;
        for($c=0;$c<count($montharray);$c++){
            $earning_query="SELECT * from orders where whID='$whID' AND deliverymethod='pickup' AND status=4  AND extract(month from date) = '$montharray[$c]'";
            $earning_res=mysqli_query($connection, $earning_query);
            // echo $montharray[$c];
            if ( $earning_res !=""){
                $earning_arr=mysqli_fetch_all($earning_res);
                $sum=$earning_arr[$c][6];
                echo $sum;
                $totalpickup_earning=$totalpickup_earning+$sum;

                echo $totalpickup_earning;
            }
        }
    }
    // print_r( $montharray);
  
        $dataPoints = array(
            array("y" => 25, "label" => $get_day[$montharray[0]]),
            array("y" => 15, "label" => $get_day[$montharray[1]]),
            array("y" => 25, "label" => $get_day[$montharray[2]]),
            array("y" => 5, "label" => $get_day[$montharray[3]]),
            array("y" => 5, "label" => $get_day[$montharray[4]]),
            array("y" => 5, "label" => $get_day[$montharray[5]]),
            array("y" => 25, "label" => $get_day[$montharray[6]]),
            array("y" => 35, "label" => $get_day[$montharray[7]]),
            array("y" => 5, "label" => $get_day[$montharray[8]]),
            array("y" => 10, "label" =>  $get_day[$montharray[9]]),
            array("y" => 0, "label" =>  $get_day[$montharray[10]]),
            array("y" => 20, "label" =>  $get_day[$montharray[11]])
        );
   
}
?>