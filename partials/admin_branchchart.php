<?php
require ('connection.php');
$branch_sql="SELECT * from warehouse WHERE typeID=1 order by `WhID` ASC";
$branch_res=mysqli_query($connection,$branch_sql);
if($branch_res){
    $point_branchchart=array();
    // $branch_arr=mysqli_fetch_all($branch_res, MYSQLI_ASSOC);
    while($branch_arr = mysqli_fetch_array($branch_res, MYSQLI_ASSOC))
    {        
  /* Push the results in our array */
        $point = array("y" =>  30 ,"label" =>  $branch_arr['whName']);
        array_push($point_branchchart, $point);
    }
    // var_dump($point_branchchart);
    require_once ('admin_arr_function.php');
    // var_dump($branch_arr);
    if (!empty($branch_arr)) {
        $branchbackorder=array();
            for($a = 0; $a < count($branch_arr); $a++){
                $whID=$branch_arr[$a]['whID'];
                // echo $whID;
                $branch_staff_sql="SELECT * from staff WHERE whID='$whID'";
                $branch_staff_res=mysqli_query($connection,$branch_staff_sql);
                if($branch_staff_res){
                    $branch_staff_arr=mysqli_fetch_all($branch_staff_res,MYSQLI_ASSOC);
                    for($b; $b< count($branch_staff_arr); $b++){
                        $usersID=$branch_staff_arr[$b]['userID'];
                        $wareID=$branch_staff_arr[$b]['whID'];
                            $getstafforder_sql="SELECT * from orders WHERE buyerID='$usersID' AND `paymentmethod`='null' AND `deliverymethod`='null'";
                            $getstafforder_res=mysqli_query($connection,$getstafforder_sql);
                            if($getstafforder_res){
                                $getstafforder_arr= mysqli_fetch_all($getstafforder_res,MYSQLI_ASSOC);
                                var_dump($getstafforder_arr);
                                // if(!empty($branchbackorder)){
                                //     $branchbackorder[$wareID]=array_merge( $branchbackorder[$wareID],$getstafforder_arr[$b]['orderID']);
                                // }
                                // else{
                                //     $branchbackorder[$wareID]=$getstafforder_arr[$b]['orderID'];
                                // }
                                // var_dump($branchbackorder);
                            }
                    }
                }
                else{}
            }
// var_dump($branchbackorder);
            
    }
    // // $dataPoints_branch = 
    // array(
    //     array("y" => $income_delivery_array[0], "label" => $yeararray[0] . $get_day[$montharray[0]]),
    //     array("y" => $income_delivery_array[1], "label" => $yeararray[1] . $get_day[$montharray[1]]),
    //     array("y" => $income_delivery_array[2], "label" => $yeararray[2] . $get_day[$montharray[2]]),
    //     array("y" => $income_delivery_array[3], "label" => $yeararray[3] . $get_day[$montharray[3]]),
    //     array("y" => $income_delivery_array[4], "label" => $yeararray[4] . $get_day[$montharray[4]]),
    //     array("y" => $income_delivery_array[5], "label" => $yeararray[5] . $get_day[$montharray[5]]),
    //     array("y" => $income_delivery_array[6], "label" => $yeararray[6] . $get_day[$montharray[6]]),
    //     array("y" => $income_delivery_array[7], "label" => $yeararray[7] . $get_day[$montharray[7]]),
    //     array("y" => $income_delivery_array[8], "label" => $yeararray[8] . $get_day[$montharray[8]]),
    //     array("y" => $income_delivery_array[9], "label" =>  $yeararray[9] . $get_day[$montharray[9]]),
    //     array("y" => $income_delivery_array[10], "label" =>  $yeararray[10] . $get_day[$montharray[10]]),
        
    // );
    
    

}else{
    echo 'no branch searched.';
}

?>