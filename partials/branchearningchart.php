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
    $yeararray = array();
    $incomearray = array();
    
    $b=0;
    $e=0;
    for($a=11;$a>=0;$a--){
        $get_startmonth= $selectedmonth-$a;
        if($get_startmonth<=0){
            $pointmonth=$get_startmonth+12;
            $yeararray[$b]=$selectedyear-1;
            
        }
        else{
            $pointmonth=$get_startmonth;
            $yeararray[$b]=$selectedyear;
        }
            $montharray[$b]=$pointmonth;
            $b++;

    }
    // var_dump($yeararray);
//   echo $montharray[0];
    if(!empty($montharray)){
        
        for($c=0;$c<count($montharray);$c++){
            $earning_query="SELECT * from orders where whID='$whID' AND deliverymethod='pickup' AND status=4  AND extract(month from date) = $montharray[$c] AND extract(year from date) = $yeararray[$c]";
            $earning_res=mysqli_query($connection, $earning_query);
            // echo $montharray[12];
            if ( $earning_res !=""){
                $earning_arr=mysqli_fetch_all($earning_res);
                $totalpickup_earning=0;
                for($d=0;$d<count($earning_arr);$d++){
                $sum=$earning_arr[$d][6];   
                $totalpickup_earning=$totalpickup_earning+$sum;
                }
                // monthly total earning
                //  echo $totalpickup_earning;
                 $incomearray[$c]=$totalpickup_earning;
            }
        }
    }
    // print_r( $incomearray);
  
        $dataPoints = array(
            array("y" => $incomearray[0], "label" => $yeararray[0].$get_day[$montharray[0]]),
            array("y" => $incomearray[1], "label" => $yeararray[1].$get_day[$montharray[1]]),
            array("y" => $incomearray[2], "label" => $yeararray[2].$get_day[$montharray[2]]),
            array("y" => $incomearray[3], "label" => $yeararray[3].$get_day[$montharray[3]]),
            array("y" => $incomearray[4], "label" => $yeararray[4].$get_day[$montharray[4]]),
            array("y" => $incomearray[5], "label" => $yeararray[5].$get_day[$montharray[5]]),
            array("y" => $incomearray[6], "label" => $yeararray[6].$get_day[$montharray[6]]),
            array("y" => $incomearray[7], "label" => $yeararray[7].$get_day[$montharray[7]]),
            array("y" => $incomearray[8], "label" => $yeararray[8].$get_day[$montharray[8]]),
            array("y" => $incomearray[9], "label" =>  $yeararray[9].$get_day[$montharray[9]]),
            array("y" => $incomearray[10], "label" =>  $yeararray[10].$get_day[$montharray[10]]),
            array("y" => $incomearray[11], "label" =>  $yeararray[11].$get_day[$montharray[11]])
        );
   
}
?>