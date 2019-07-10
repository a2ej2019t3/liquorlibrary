<?php
function completed_Arr($arr = " ", $index = "all", $keyword = "orderID", $sort = "des")
{

  if (!empty($GLOBALS[$arr])) {
    $complete_arr = $GLOBALS[$arr];
    
      if (isset($GLOBALS['DBsql'])) {
        $DBsql = $GLOBALS['DBsql'];
      }
      if ($index == 'all') {
        $sorted = $complete_arr;
      } else if ($index == 'sort') {
        if (isset($keyword) && isset($sort)) {
          $sortKey = $keyword;
          $result = $complete_arr;
          foreach ($result as $key => $value) {
            $finalResult[$value['orderID']] = $value;
          }
          // var_dump($finalResult);
          foreach ($finalResult as $key => $value) {
            $sortArr[$value['orderID']] = $value[$sortKey];
          }
          // var_dump($sortKey);
          if ($sort == 'asc') {
            asort($sortArr);
          } else if ($sort == 'des') {
            arsort($sortArr);
          }
          // var_dump($sortArr);
          foreach ($sortArr as $key => $value) {
            $sorted[$key] = $finalResult[$key];
          }
        }
      }
      // var_dump($complete_arr);
      if (!empty($sorted)) {
        // for ($i = 0; $i < count($complete_arr); $i++) {
        foreach ($sorted as $key => $complete_arr) {
    
          $statusName = $complete_arr['status'];
          switch ($complete_arr['status']) {
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
              $statusName = 'Completed';
              break;
            case 5:
              $badgeType = 'badge-dark';
              $statusName = 'Cancelled';
              break;
            case 6:
              $badgeType = 'badge-info';
              $statusName = 'pay by cash';
              break;
            case 7:
              $badgeType = 'badge-warning';
              $statusName = 'Shipping';
              break;
            default:
              # code...
              break;
          }
          $orderIdArr = array(
            'orderID' => $complete_arr['orderID'],
            'buyerID' => $complete_arr['buyerID']
          );
          $orderidJson = json_encode($orderIdArr);
    
    
          echo '<div class="card">
                                                <a class="btn p-0 orders"  data-toggle="collapse" data-target="#coid' . $complete_arr['orderID']  . '" data-orderid="' . $complete_arr['orderID'] . '" style="width:100%;">
                                                 <div id="heading" class="py-2">
                                                   <div class="row">
                                                      <div class="col-1 mx-auto">
                                                           <h5 class="ids">#' . $complete_arr['orderID'] . '</h5>
                                                       </div>';
                                              if(isset($complete_arr['BranchID'])){
                                                echo'<div class="col-1 text-left">
                                                <div class="row">
                                                    <h5 class="secondHeader">Branch ID</h5>
                                                </div>
                                                <div class="row secondRow">
                                                  <h5 class="ids">#' . $complete_arr['BranchID'] . '</h5>
                                                </div>
                                                </div>
                                                <div class="col-2 text-left">
                                                <div class="row">
                                                    <h5 class="secondHeader">Items</h5>
                                                </div>
                                             <div class="row secondRow">';
                                                }
                                                else{
                                                  echo'     <div class="col-3 text-left">
                                                          <div class="row">
                                                              <h5 class="secondHeader">Items</h5>
                                                          </div>
                                                       <div class="row secondRow">';

                                                }
          $imgpath = 'images/';
          $items = $DBsql->getCartItemsInfo($complete_arr['orderID'], array('LIMIT' => '3'));
          if (count($items) != 0) {
            foreach ($items as $key => $value) {
              echo '
                <img class="img-thumbnail briefimg mx-1" src="' . $imgpath . $value['img'] . '">';
            }
            if (count($items) < 3) { } else {
              echo '<i class="fas fa-ellipsis-h" style="color:grey; margin-left:5px; line-height:2.4;"></i>';
            }
          }
          echo '</div>
                                                        </div>
                                                        <div class="col-2">
                                                            <div class="row">
                                                                <h5 class="secondHeader">Price</h5>
                                                            </div>
                                                            <div class="row secondRow">
                                                                <h5>NZ$' . $complete_arr['cost'] . '</h5>
                                                            </div>
                                                      </div> 
                                                      <div class="col-2 text-left">
                                                          <div class="row">
                                                              <h5 class="ordertime secondHeader">Ordered On:</h5>
                                                          </div>
                                                          <div class="row secondRow">
                                                              <h5 class="orderdate">' . $complete_arr['date'] . '</h5>
                                                          </div>
                                                     </div>
                                                     <div class="col-1 p-1 my-auto text-left pl-5" style="font-size:1.25rem;">
                                                         <span class="badge ' . $badgeType . '">' . $statusName . '</span>
                                                    </div>
                                                    <div class="col-3 col-xs-6 p-1 my-auto  pl-5" style="font-size:1.25rem;">';
                                                    if(isset($complete_arr['BranchID'])){
                                                      if($complete_arr['status']==1 ){
                                                        echo'<button class="btn btn-primary adminmsg" id="branchemailbutton"  value=' . $orderidJson . ' onclick="openEmail(this.value);"><i class="fa fa-envelope"></i> </button>';
                                                        
                                                        echo '
                                                          <button class="btn btn-danger" id="updatebutton' . $complete_arr['orderID'] . '" data-id=' . $complete_arr['orderID'] . ' value=' . $orderidJson . ' onclick="updateorder(this); shippingbackorder(this.value)" ><span id="readysign' . $complete_arr['orderID'] . '"> SHIPPING</span>                                                  
                                                          <span class="spinner-border spinner-border-sm" id="spinner' . $complete_arr['orderID'] . '" role="status" aria-hidden="true" style="display:none"></span>
                                                          </button>';
                                                      }  
                                                      else if( $complete_arr['status']==7 ){
                                                        echo'<button class="btn btn-primary adminmsg" id="branchemailbutton"  value=' . $orderidJson . ' onclick="openEmail(this.value);"><i class="fa fa-envelope"></i> </button>
                                                        <button class="btn btn-danger"  id="completebutton" data-id=' . $complete_arr['orderID'] . '   value=' . $orderidJson .  ' onclick="completeorder(this); completebackorder(this.value);" ><span id="completereadysign' . $complete_arr['orderID'] . '"> COMPLETE</span>
                                                        <span class="spinner-border spinner-border-sm" id="completespinner' . $complete_arr['orderID'] . '" role="status" aria-hidden="true" style="display:none"></span>
                                                        </button>
          
                                                        <button class="btn btn-danger" style="background-color:black; border: none;" id="cancelbutton' . $complete_arr['orderID'] . '" data-id=' . $complete_arr['orderID'] . '   value=' . $orderidJson .  ' onclick="cancelorder(this);" ><span id="cancelsign' . $complete_arr['orderID'] . '"> Cancel</span>
                                                        <span class="spinner-border spinner-border-sm" id="cancelspinner' . $complete_arr['orderID'] . '" role="status" aria-hidden="true" style="display:none"></span>
                                                        </button>';
  
                                                      }
                                                      else if($complete_arr['status']==4 || $complete_arr['status']==5 ){
                                                        echo'<button class="btn btn-primary adminmsg" id="branchemailbutton"  data-toggle="modal" data-target="#branchemail" value="' . $complete_arr['orderID'] . '" onclick="openEmail(this.value);" ><i class="fa fa-envelope"></i> </button>';
  
                                                      }

                                                    } 
                                                    else if(!isset($complete_arr['BranchID'])){

                                                      if( $complete_arr['status']==1 && $complete_arr['deliverymethod']=='delivery' ){                                                  
                                                        echo'<button class="btn btn-primary adminmsg" id="branchemailbutton"   data-toggle="modal" value=' . $orderidJson . ' onclick="openEmailModal(this.value);" ><i class="fa fa-envelope"></i> </button>';
                                                        echo '
                                                          <button class="btn btn-danger" id="updatebutton' . $complete_arr['orderID'] . '" data-id=' . $complete_arr['orderID'] . ' value=' . $orderidJson . ' onclick="updateorder(this); shippingbackorder(this.value)" ><span id="readysign' . $complete_arr['orderID'] . '"> SHIPPING</span>                                                  
                                                          <span class="spinner-border spinner-border-sm" id="spinner' . $complete_arr['orderID'] . '" role="status" aria-hidden="true" style="display:none"></span>
                                                          </button>';
                                                      }
                                                      else if( $complete_arr['status']==7 && $complete_arr['deliverymethod']=='delivery' ){                                                  
                                                        echo'<button class="btn btn-primary adminmsg" id="branchemailbutton"   data-toggle="modal" value=' . $orderidJson . ' onclick="openEmailModal(this.value);"><i class="fa fa-envelope"></i> </button>
                                                        <button class="btn btn-danger"  id="completebutton" data-id=' . $complete_arr['orderID'] . '   value=' . $orderidJson .  ' onclick="completeorder(this); completebackorder(this.value);" ><span id="completereadysign' . $complete_arr['orderID'] . '"> COMPLETE</span>
                                                        <span class="spinner-border spinner-border-sm" id="completespinner' . $complete_arr['orderID'] . '" role="status" aria-hidden="true" style="display:none"></span>
                                                        </button>
          
                                                        <button class="btn btn-danger" style="background-color:black; border: none;" id="cancelbutton' . $complete_arr['orderID'] . '" data-id=' . $complete_arr['orderID'] . '   value=' . $orderidJson .  ' onclick="cancelorder(this);" ><span id="cancelsign' . $complete_arr['orderID'] . '"> Cancel</span>
                                                        <span class="spinner-border spinner-border-sm" id="cancelspinner' . $complete_arr['orderID'] . '" role="status" aria-hidden="true" style="display:none"></span>
                                                        </button>';
                                                      }
                                                      else if( $complete_arr['status']==1 && $complete_arr['deliverymethod']=='pickup' and $complete_arr['whID']==0 or $complete_arr['status']==6 && $complete_arr['deliverymethod']=='pickup' and $complete_arr['whID']==0 ){                                                  
                                                        echo'<button class="btn btn-primary adminmsg" id="branchemailbutton"   data-toggle="modal" value=' . $orderidJson . ' onclick="openEmailModal(this.value);" ><i class="fa fa-envelope"></i> </button>';
                                                        echo '
                                                          <button class="btn btn-danger" id="updatebutton' . $complete_arr['orderID'] . '" data-id=' . $complete_arr['orderID'] . ' value=' . $orderidJson . ' onclick="updateorder(this); readypickup(this.value)" ><span id="readysign' . $complete_arr['orderID'] . '"> READY</span>                                                  
                                                          <span class="spinner-border spinner-border-sm" id="spinner' . $complete_arr['orderID'] . '" role="status" aria-hidden="true" style="display:none"></span>
                                                          </button>';
                                                      }
                                                      else if( $complete_arr['status']==3 && $complete_arr['deliverymethod']=='pickup' and $complete_arr['whID']==0){                                                  
                                                        echo'<button class="btn btn-primary adminmsg" id="branchemailbutton"   data-toggle="modal" value=' . $orderidJson . ' onclick="openEmailModal(this.value);"><i class="fa fa-envelope"></i> </button>
                                                        <button class="btn btn-danger"  id="completebutton" data-id=' . $complete_arr['orderID'] . '   value=' . $orderidJson .  ' onclick="completeorder(this); completepickup(this.value);" ><span id="completereadysign' . $complete_arr['orderID'] . '"> COMPLETE</span>
                                                        <span class="spinner-border spinner-border-sm" id="completespinner' . $complete_arr['orderID'] . '" role="status" aria-hidden="true" style="display:none"></span>
                                                        </button>
          
                                                        <button class="btn btn-danger" style="background-color:black; border: none;" id="cancelbutton' . $complete_arr['orderID'] . '" data-id=' . $complete_arr['orderID'] . '   value=' . $orderidJson .  ' onclick="cancelorder(this);" ><span id="cancelsign' . $complete_arr['orderID'] . '"> Cancel</span>
                                                        <span class="spinner-border spinner-border-sm" id="cancelspinner' . $complete_arr['orderID'] . '" role="status" aria-hidden="true" style="display:none"></span>
                                                        </button>';
                                                      }
                                                      else{
                                                        echo'<button class="btn btn-primary adminmsg" id="branchemailbutton"   data-toggle="modal" value=' . $orderidJson . ' onclick="openEmailModal(this.value);"><i class="fa fa-envelope"></i> </button>
                                                        ';

                                                      }
                                                    }
                                                   

                                                    echo'
                                                   </div>
                                                    </div>
                                                  </div>
                                                </a>
                                                 <div id="coid' . $complete_arr['orderID']  . '" class="collapsesub" data-parent="#accordion">
                                                        
                                                  <hr class="my-0">
                                                  <div class="py-4 details" style="display:none;">
                                                      
                                                  </div>
                                              </div>
                                            </div>
                                             ';
        }
  }

  } else {
    echo '<center style="margin-top:50px;">There is no order shown.</center>';
  }
};
