<link rel="stylesheet" href="css/branch.css">
<?php
    include ('connection.php');
    // include_once ('partials/branchquery.php');
    session_start();
    $whID=$_SESSION['warehouse']['whID'];
    include_once("partials/head.php");
    include(__DIR__ . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
    $DBsql = new sql;
    $select_user="SELECT userID FROM staff WHERE whID='$whID'";
    $selectuser_result=mysqli_query($connection, $select_user);
    if ( $selectuser_result != ""){
        $selectuser_arr = mysqli_fetch_all($selectuser_result);

    }
    $searchcontent = $_REQUEST['sc'];

    // -----------------------------------
    $historyordername_arr=array();
    for($a=0; $a <count($selectuser_arr); $a++){
        $userID=$selectuser_arr[$a][0];
        // echo $userID;
        $select_historyordername="SELECT * FROM orders WHERE buyerID='$userID'AND status=4 AND orderID LIKE '%$searchcontent%' or buyerID='$userID'AND status=5 AND orderID LIKE '%$searchcontent%' order by `date` DESC";
        $selecthistoryordername_result=mysqli_query($connection, $select_historyordername);
        // $order_array[$a]=$selectorder_result;
      
          $historyordername_array=mysqli_fetch_all($selecthistoryordername_result);
          // print_r($order_array); 
          if(!empty($historyordername_array)){
            if(!empty($historyordername_arr)){
              $historyordername_arr=array_merge($historyordername_arr,$historyordername_array);
               echo '<br>';
             }else{
              $historyordername_arr=array_merge($historyordername_array);
              
             }
              
          }
      
      };
// -------------------------------------------
    if ($searchcontent != "") {
            $imgpath = 'images/';
            $tagForCategory = 'Category: ';
            $tagForBrand = 'Brand: ';
    // product result below
    
    echo '<div>
    <h6 class="dropdown-header"><center><b style="text-align:center;">search by Customer</b></center>Customer Name: '.$searchcontent.'</h6>
    ';

        if (count($historyordername_arr) > 0) { 
           
          echo'<div id="accordion">';
               
                if (!empty($historyordername_arr)) {
                  for ($i = 0; $i < count($historyordername_arr); $i++) {
                    
                    $statusName = $historyordername_arr[$i][4];
                    switch ($historyordername_arr[$i][4]) {
                      case 0:
                        $badgeType = 'badge-secondary';

                        break;
                      case 1:
                        $badgeType = 'badge-info';
                        $statusName = 'paid';
                        break;

                      case 3:
                        $badgeType = 'badge-warning';
                        $statusName = 'ready to pick up';
                        break;
                        case 4:
                        $badgeType = 'badge-success';
                        $statusName = 'completed';
                        break;
                      case 5:
                        $badgeType = 'badge-dark';
                        $statusName = 'cancelled';
                        break;
                      case 6:
                        $badgeType = 'badge-info';
                        $statusName = 'pay by cash';
                        break;
                      default:
                        # code...
                        break;
                    }
                    $orderIdArr = array(
                      'orderID' => $historyordername_arr[$i][0],
                      'buyerID' => $historyordername_arr[$i][1]
                    );
                    $orderidJson = json_encode($orderIdArr);      
                      echo '<div class="card">
                                <a class="btn p-0 orders"  data-toggle="collapse" data-target="#coid' . $i . '" data-orderid="' . $historyordername_arr[$i][0] . '" style="width:100%;">
                                 <div id="heading" class="py-2">
                                   <div class="row">
                                      <div class="col-1 mx-auto">
                                           <h5 class="ids">#' . $historyordername_arr[$i][0] . '</h5>
                                       </div>
                                       <div class="col-3 text-left">
                                          <div class="row">
                                              <h5 class="secondHeader">Items</h5>
                                          </div>
                                       <div class="row secondRow">';
                                       $imgpath = 'images/';
                                       $items = $DBsql->getCartItemsInfo($historyordername_arr[$i][0], array('LIMIT' => '3'));
                                          if (count($items) != 0) {
                                            foreach ($items as $key => $value) {
                                              echo '
                                          <img class="img-thumbnail briefimg mx-1" src="' . $imgpath . $value['img'] . '">';
                                            }
                                            if (count($items) < 3) { } else {
                                              echo '<i class="fas fa-ellipsis-h" style="color:grey; margin-left:5px; line-height:2.4;"></i>';
                                            }
                                          }
                                     echo'</div>
                                        </div>
                                        <div class="col-2">
                                            <div class="row">
                                                <h5 class="secondHeader">Price</h5>
                                            </div>
                                            <div class="row secondRow">
                                                <h5>NZ$' . $historyordername_arr[$i][6] . '</h5>
                                            </div>
                                      </div> 
                                      <div class="col-2 text-left">
                                          <div class="row">
                                              <h5 class="ordertime secondHeader">Ordered On:</h5>
                                          </div>
                                          <div class="row secondRow">
                                              <h5 class="orderdate">' . $historyordername_arr[$i][3] . '</h5>
                                          </div>
                                     </div>
                                     <div class="col-1 p-1 my-auto text-left pl-5" style="font-size:1.25rem;">
                                         <span class="badge ' . $badgeType . '">' . $statusName . '</span>
                                    </div>
                                    <div class="col-3 col-xs-6 p-1 my-auto  pl-5" style="font-size:1.25rem;">
                                        <button class="btn btn-primary adminmsg" id="branchemailbutton"  data-toggle="modal" value=' . $orderidJson . ' onclick="openEmailModal(this.value);" ><i class="fa fa-envelope"></i> </button>';
                                        if($historyordername_arr[$i][4]==1 ||$historyordername_arr[$i][4]==6){
                                            echo'
                                            <button class="btn btn-danger" id="updatebutton' . $i . '" data-id='.$i.' value=' . $orderidJson . ' onclick="updateorder(this); readypickup(this.value)" ><span id="readysign' . $i . '">READY</span>                                                  
                                            <span class="spinner-border spinner-border-sm" id="spinner' . $i . '" role="status" aria-hidden="true" style="display:none"></span>
                                            </button>';
                                        }
                                        else if($historyordername_arr[$i][4]==3){
                                            echo '
                                            <button class="btn btn-danger"  id="completebutton" data-id=' . $i . '   value=' . $orderidJson .  ' onclick="completeorder(this); completepickup(this.value);" ><span id="completereadysign' . $i . '"> COMPLETE</span>
                                            <span class="spinner-border spinner-border-sm" id="completespinner' . $i . '" role="status" aria-hidden="true" style="display:none"></span>
                                            </button>';
                                        }

                                echo'
                                   </div>
                                    </div>
                                  </div>
                                </a>
                                <div id="coid' . $i . '" class="collapsesub" data-parent="#accordion">
                                  <hr class="my-0">
                                  <div class="py-4 details" style="display:none;">
                                      
                                  </div>
                              </div>
                            </div>
                             '; 
                  }
                } else {
                  echo 'There is no customer found';
                }
               
                
         echo'   </div> ';
           

        } else {
            echo '
                <a class="dropdown-item disabled" href="#" tabindex="-1">No result</a>
            ';
        }

    } else {
        ob_clean();
        echo 000;
    }
    ?>
    <style>
    #col1{
background-color: rgba(224, 184, 65, 1);
border: 1px solid rgba(224, 184, 65, 1);
}
#col2{
background-color:rgba(48, 43, 41,1);
border: 1px solid rgba(48, 43, 41,1);
}
.status {
  font-size: 30px;
  margin: 2px 2px 0 0;
  display: inline-block;
  vertical-align: middle;
  line-height: 10px;
}

a {
  cursor: pointer;
}

#titlearea a {
  text-decoration: none;
  color: grey;
}

.card:hover {
  animation-name: shadowFrame;
  animation-duration: 0.2s;
  animation-fill-mode: forwards;
  z-index: 100;
}

.ids {
  color: royalblue;
  height: 100%;
  line-height: 3.6rem;
}

.secondHeader {
  color: black;
  font-size: 0.9rem;
  line-height: 1.45rem;
  margin-left: -10px;
}

.secondRow,
.secondRow>h5 {
  height: 40px;
  line-height: 40px;
}

.thirdHeader {
  font-size: 0.8rem;
  line-height: 1.45rem;
  color: gray;
  padding-left: 10px;
}

h5 {
  margin: 0;
}

h6 {
  text-align: right;
}

.briefimg {
  width: auto;
  max-width: 40px;
  height: 40px;
}

.button:active {
  border: none;
}

.collapse:before {
  box-shadow: 0px 6px 7px -6px rgba(0, 0, 0, 0.2) inset;
}

.details {
  padding-left: 80px;
  padding-right: 80px;
}

@keyframes shadowFrame {
  from {}

  to {
    box-shadow: 0px 0px 10px 5px lightgray;
  }
}
.orderdate{
  font-size: 1rem;
}

    </style>
