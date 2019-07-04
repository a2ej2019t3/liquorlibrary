<?php
function getBackorders($connection = " ", $userID = " ", $condition = " ")
        {

            $connection = $_SESSION['connection'];
            if ($condition!==" " && $userID!==" ") {

                $select_order = "SELECT * FROM orders WHERE buyerID=$userID";
                $select_order = $select_order . $condition;
                // echo  $select_order;
            } else if($condition!==" " && $userID ==" "){
                $select_order = "SELECT * FROM orders WHERE";
                $select_order = $select_order . $condition;
            } else{
                $select_order = "SELECT * FROM orders";
            }
            $selectorder_result = mysqli_query($connection, $select_order);
            $empty_arr=array();
            if($selectorder_result){
                $order_array = mysqli_fetch_all($selectorder_result, MYSQLI_ASSOC);
                $backorder_arr = array();
                if (!empty($order_array)) {
                    if (!empty($backorder_arr)) {
                        $backorder_arr = array_merge($backorder_arr, $order_array);
                        echo '<br>';
                    } else {
                        $backorder_arr = array_merge($order_array);
                    }
                } else { }
                return $backorder_arr;
            }
            else{
                return $empty_arr;
            }
            
        }
       
        
        function getBranchorder( $connection = " ", $userID = " ", $condition = " ", $whID=" ")
        {
            $connection = $_SESSION['connection'];
                    if ($condition!==" " && $userID!==" " && $whID!= " ") {
        
                        $select_order = "SELECT * , '$whID' AS `BranchID` FROM orders WHERE buyerID=$userID";
                        $select_order = $select_order . $condition;
                        // echo  $select_order;
                    } else if($condition!==" " && $userID ==" "){
                        $select_order = "SELECT * FROM orders WHERE";
                        $select_order = $select_order . $condition;
                    } else{
                        $select_order = "SELECT * FROM orders";
                    }
                    $selectorder_result = mysqli_query($connection, $select_order);
                    $empty_arr=array();
                    if($selectorder_result){
                        $order_array = mysqli_fetch_all($selectorder_result, MYSQLI_ASSOC);
                        $backorder_arr = array();
                        if (!empty($order_array)) {
                            if (!empty($backorder_arr)) {
                                $backorder_arr = array_merge($backorder_arr, $order_array);
                                echo '<br>';
                            } else {
                                $backorder_arr = array_merge($order_array);
                            }
                        } else { }
                        return $backorder_arr;
                    }
                    else{
                        return $empty_arr;
                    }
                    
                }
?>