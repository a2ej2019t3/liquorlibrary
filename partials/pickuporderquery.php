<?php

    if ( isset($selectuser_result) && isset($selectmonth_result) &&  isset($selectyear_result)) {

        // $newpickuporder=array();  
        // $readyorder_arr=array();  
        // $cancelorder_arr=array();  
        // $completedorder_arr=array();

        $newpickuporders_query="SELECT * from orders where whID='$whID' AND deliverymethod='pickup' AND status=1 or status=6 order by `date` DESC ";
        $readypickuporders_query="SELECT * from orders where whID='$whID' AND deliverymethod='pickup' AND status=3 order by `date` DESC";
        
        $newpickuporders_res=mysqli_query($connection, $newpickuporders_query);
        $readypickups_res=mysqli_query($connection, $readypickuporders_query);
        if ( $newpickuporders_res != ""&& $readypickups_res != "") {
              $newpickups_arr=mysqli_fetch_all($newpickuporders_res);
              $readypickups_arr=mysqli_fetch_assoc($readypickups_res);

        }


                
      } else {
        echo "result empty";
      }

    ?>
