<link rel="stylesheet" href="css/branch.css">
<?php
    include ('connection.php');

    include_once("partials/head.php");
    include(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'liquorlibrary' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
    $DBsql = new sql;

    $searchcontent = $_REQUEST['sc'];

    //search Customer
    $searchCustomer_sql = 
        "SELECT DISTINCT  o.* FROM `orders` AS o, `users` AS u WHERE u.userID=o.buyerID  AND o.status !=0  AND o.status !=1 AND o.status !=2  AND o.status !=3  AND o.status !=6 AND o.status !=7 AND CONCAT(u.firstname, u.lastname) LIKE '%$searchcontent%' ";

    $searchCustomer_res = mysqli_query($connection, $searchCustomer_sql);
    if ($searchCustomer_res) {
        $searchCustomer_arr = mysqli_fetch_all($searchCustomer_res);
    }
    //search orderID
    $searchID_sql = "SELECT DISTINCT * from orders WHERE status !=0  AND `status` !=1 AND `status` !=2  AND `status` !=3  AND `status` !=6 AND `status` !=7  AND orderID LIKE '%$searchcontent%' ";
    $searchID_res = mysqli_query($connection, $searchID_sql);
    if ($searchID_res) {
        $searchID_arr = mysqli_fetch_all($searchID_res);
    }


    if ($searchcontent != "") {
            $imgpath = 'images/';
            $tagForCategory = 'Category: ';
            $tagForBrand = 'Brand: ';
    // product result below
    
    echo '<div>
    <h6 class="dropdown-header"><center><b style="text-align:center;">search by Customer</b></center>Customer Name: '.$searchcontent.'</h6>
    ';

        if (count($searchCustomer_arr) > 0) { 
           
          echo'<div id="accordion">';
               
                if (!empty($searchCustomer_arr)) {
                  for ($i = 0; $i < count($searchCustomer_arr); $i++) {
                    
                    $statusName = $searchCustomer_arr[$i][4];
                    switch ($searchCustomer_arr[$i][4]) {
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
                      'orderID' => $searchCustomer_arr[$i][0],
                      'buyerID' => $searchCustomer_arr[$i][1]
                    );
                    $orderidJson = json_encode($orderIdArr);      
                      echo '<div class="card">
                                <a class="btn p-0 orders"  data-toggle="collapse" data-target="#coid' . $i . '" data-orderid="' . $searchCustomer_arr[$i][0] . '" style="width:100%;">
                                 <div id="heading" class="py-2">
                                   <div class="row">
                                      <div class="col-1 mx-auto">
                                           <h5 class="ids">#' . $searchCustomer_arr[$i][0] . '</h5>
                                       </div>
                                       <div class="col-3 text-left">
                                          <div class="row">
                                              <h5 class="secondHeader">Items</h5>
                                          </div>
                                       <div class="row secondRow">';
                                       $imgpath = 'images/';
                                       $items = $DBsql->getCartItemsInfo($searchCustomer_arr[$i][0], array('LIMIT' => '3'));
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
                                                <h5>NZ$' . $searchCustomer_arr[$i][6] . '</h5>
                                            </div>
                                      </div> 
                                      <div class="col-2 text-left">
                                          <div class="row">
                                              <h5 class="ordertime secondHeader">Ordered On:</h5>
                                          </div>
                                          <div class="row secondRow">
                                              <h5 class="orderdate">' . $searchCustomer_arr[$i][3] . '</h5>
                                          </div>
                                     </div>
                                     <div class="col-1 p-1 my-auto text-left pl-5" style="font-size:1.25rem;">
                                         <span class="badge ' . $badgeType . '">' . $statusName . '</span>
                                    </div>
                                    <div class="col-3 col-xs-6 p-1 my-auto  pl-5" style="font-size:1.25rem;">
                                        <button class="btn btn-primary adminmsg" id="branchemailbutton"  data-toggle="modal" value=' . $orderidJson . ' onclick="openEmailModal(this.value);" ><i class="fa fa-envelope"></i> </button>';
                                        if($searchCustomer_arr[$i][4]==1 ||$searchCustomer_arr[$i][4]==6){
                                            echo'
                                            <button class="btn btn-danger" id="updatebutton' . $i . '" data-id='.$i.' value=' . $orderidJson . ' onclick="updateorder(this); readypickup(this.value)" ><span id="readysign' . $i . '">READY</span>                                                  
                                            <span class="spinner-border spinner-border-sm" id="spinner' . $i . '" role="status" aria-hidden="true" style="display:none"></span>
                                            </button>';
                                        }
                                        else if($searchCustomer_arr[$i][4]==3){
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

    // orderID result below
    echo '
    <div class="dropdown-divider"></div>
    <h6 class="dropdown-header"><center><b style="text-align:center;">search by orderID</b></center>Order ID: '.$searchcontent.'</h6>
    ';
    
    
    if (count($searchID_arr) > 0) { 
           
        echo'      <div id="accordion">';
             
              if (!empty($searchID_arr)) {
                for ($i = 0; $i < count($searchID_arr); $i++) {
                  
                  $statusName = $searchID_arr[$i][4];
                  switch ($searchID_arr[$i][4]) {
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
                    'orderID' => $searchID_arr[$i][0],
                    'buyerID' => $searchID_arr[$i][1]
                  );
                  $orderidJson = json_encode($orderIdArr);      
                    echo '<div class="card">
                              <a class="btn p-0 orders"  data-toggle="collapse" data-target="#coid' . $i . '" data-orderid="' . $searchID_arr[$i][0] . '" style="width:100%;">
                               <div id="heading" class="py-2">
                                 <div class="row">
                                    <div class="col-1 mx-auto">
                                         <h5 class="ids">#' . $searchID_arr[$i][0] . '</h5>
                                     </div>
                                     <div class="col-3 text-left">
                                        <div class="row">
                                            <h5 class="secondHeader">Items</h5>
                                        </div>
                                     <div class="row secondRow">';
                                     $imgpath = 'images/';
                                     $items = $DBsql->getCartItemsInfo($searchID_arr[$i][0], array('LIMIT' => '3'));
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
                                              <h5>NZ$' . $searchID_arr[$i][6] . '</h5>
                                          </div>
                                    </div> 
                                    <div class="col-2 text-left">
                                        <div class="row">
                                            <h5 class="ordertime secondHeader">Ordered On:</h5>
                                        </div>
                                        <div class="row secondRow">
                                            <h5 class="orderdate">' . $searchID_arr[$i][3] . '</h5>
                                        </div>
                                   </div>
                                   <div class="col-1 p-1 my-auto text-left pl-5" style="font-size:1.25rem;">
                                       <span class="badge ' . $badgeType . '">' . $statusName . '</span>
                                  </div>
                                  <div class="col-3 col-xs-6 p-1 my-auto  pl-5" style="font-size:1.25rem;">
                                      <button class="btn btn-primary adminmsg" id="branchemailbutton"  data-toggle="modal" value=' . $orderidJson . ' onclick="openEmailModal(this.value);" ><i class="fa fa-envelope"></i> </button>';
                                      if($searchID_arr[$i][4]==1 ||$searchID_arr[$i][4]==6){
                                        echo'
                                        <button class="btn btn-danger" id="updatebutton' . $i . '" data-id='.$i.' value=' . $orderidJson . ' onclick="updateorder(this); readypickup(this.value)" ><span id="readysign' . $i . '">READY</span>                                                  
                                        <span class="spinner-border spinner-border-sm" id="spinner' . $i . '" role="status" aria-hidden="true" style="display:none"></span>
                                        </button>';
                                    }
                                    else if($searchID_arr[$i][4]==3){
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
                echo 'There is no order information found under searched order ID';
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
