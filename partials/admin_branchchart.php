<?php
require ('connection.php');
$branch_sql="SELECT * from warehouse WHERE typeID=1 order by `WhID` ASC";
$branch_res=mysqli_query($connection,$branch_sql);
if($branch_res){
    $branch_arr=mysqli_fetch_all($branch_res, MYSQLI_ASSOC);
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
                        $userID=$branch_staff_arr[$b]['userID'];
                        $wareID=$branch_staff_arr[$b]['whID'];
                            $getstafforder_sql="SELECT * from orders WHERE buyerID='$userID' AND `paymentmethod`='null' AND `deliverymethod`='null'";
                            $getstafforder_res=mysqli_query($connection,$getstafforder_sql);
                            if($getstafforder_res){
                                $getstafforder_arr= mysqli_fetch_all($getstafforder_res,MYSQLI_ASSOC);
                                if(!empty($branchbackorder)){
                                    $branchbackorder[$wareID]=array_merge( $branchbackorder[$wareID],$getstafforder_arr[$b]['orderID']);
                                }
                                else{
                                    $branchbackorder[$wareID]=$getstafforder_arr[$b]['orderID'];
                                }
                                // var_dump($branchbackorder);
                            }
                    }
                }
                else{}
            }
var_dump($branchbackorder);
            
    }
                // $branch_staff_sql="SELECT o.*,s.whID from orders AS o, staff AS s WHERE o.userID=s.userID AND `paymentmethod`='null' AND `deliverymethod`!=null";
                // $branch_staff_res=mysqli_query($connection,$branch_staff_sql)
                // if($branch_staff_res){
                    
                //     $branch_staff_arr=mysqli_fetch_all($branch_staff_res,MYSQLI_ASSOC);


}else{
    echo 'no branch searched.';
}

?>