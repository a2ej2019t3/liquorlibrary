<?php
                        function completed_Arr($arr=" ", $index = "all", $keyword = "orderID", $sort = "des")
                        {
                          if (!empty($GLOBALS[$arr])) {
                            $complete_arr = $GLOBALS[$arr];
                          }
                         

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
                                                   </div>
                                                   <div class="col-3 text-left">
                                                      <div class="row">
                                                          <h5 class="secondHeader">Items</h5>
                                                      </div>
                                                   <div class="row secondRow">';
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
                                                <div class="col-3 col-xs-6 p-1 my-auto  pl-5" style="font-size:1.25rem;">
                                                    <button class="btn btn-primary adminmsg" id="branchemailbutton"  data-toggle="modal" data-target="#branchemail" value="' . $complete_arr['orderID'] . '" ><i class="fa fa-envelope"></i> </button>
  
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
                          } else {
                            echo 'There is no new pickup order yet';
                          }
                        };
?>