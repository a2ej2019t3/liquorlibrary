<?php

    if (isset($selectmonth_result) &&  isset($selectyear_result)) {

        // $newpickuporder=array();  
        // $readyorder_arr=array();  
        // $cancelorder_arr=array();  
        // $completedorder_arr=array();

        $newpickuporders_query="SELECT * from orders where whID='$whID' AND deliverymethod='pickup' AND status=1 or whID='$whID' AND status=6 order by `date` DESC ";
        $readypickuporders_query="SELECT * from orders where whID='$whID' AND deliverymethod='pickup' AND status=3 order by `date` DESC";
        
        $newpickuporders_res=mysqli_query($connection, $newpickuporders_query);
        $readypickups_res=mysqli_query($connection, $readypickuporders_query);
        if ( $newpickuporders_res != "" || $readypickups_res != "") {
              $newpickups_arr=mysqli_fetch_all($newpickuporders_res);
              $readypickups_arr=mysqli_fetch_all($readypickups_res);

        }

        $completepickuporders_query="SELECT * from orders where whID='$whID' AND deliverymethod='pickup' AND status=4 order by `date` DESC ";
        $cancelpickuporders_query="SELECT * from orders where whID='$whID' AND deliverymethod='pickup' AND status=5 order by `date` DESC";
        
        $completepickuporders_res=mysqli_query($connection, $completepickuporders_query);
        $cancelpickuporders_res=mysqli_query($connection, $cancelpickuporders_query);
        if ( $completepickuporders_res != "" || $cancelpickuporders_res != "") {
              $complete_arr=mysqli_fetch_all($completepickuporders_res, MYSQLI_ASSOC);
              $cancelled_arr=mysqli_fetch_all($cancelpickuporders_res, MYSQLI_ASSOC);

        }

                
      } else {
        echo "result empty";
      }

    ?>
