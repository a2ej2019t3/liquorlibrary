<?php
include(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'liquorlibrary' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
$DBsql = new sql;
$optIndex = $_GET['i'];
if ($optIndex == 0) {
    $statusID = '';
} else if ($optIndex == 1) {
    $statusID = array(1, 6);
} else if ($optIndex == 2) {
    $statusID = 3;
} else if ($optIndex == 3) {
    $statusID = 7;
} else if ($optIndex == 4) {
    $statusID = 4;
}
var_dump($statusID);
if (isset($_SESSION['user'])) {
    $buyerID = $_SESSION['user']['userID'];

    if ($statusID != '') {
        $consArr = array(
            'buyerID' => $buyerID,
            'status' => $statusID
        );
    } else {
        $consArr = array(
            'buyerID' => $buyerID
        );
    }
    $res = $DBsql->select('orders LEFT JOIN status ON orders.status = status.statusID', $consArr);
    // var_dump($res);
    if ($res !== null) {
        echo '
              <div id="accordion">';
        for ($i = 0; $i < count($res); $i++) {
            echo '
                          <div class="card">
                              <a class="btn p-0 orders"  data-toggle="collapse" data-target="#coid' . $i . '" data-orderid="' . $res[$i]['orderID'] . '" style="width:100%;">

                                      <div id="heading" class="py-2">
                                          <div class="row">
                                              <div class="col-9 my-auto">
                                                  <div class="row">
                                                      <div class="col-2 mx-auto">
                                                          <h5 class="ids">#' . $res[$i]['orderID'] . '</h5>
                                                      </div>
                                                      <div class="col-4 text-left">
                                                          <div class="row">
                                                              <h5 class="secondHeader">Items</h5>
                                                          </div>
                                                          <div class="row secondRow">';
            $items = $DBsql->getCartItemsInfo($res[$i]['orderID'], array('LIMIT' => '3'));
            // var_dump($items);
            $imgpath = 'images/';
            if (count($items) != 0) {
                foreach ($items as $key => $value) {
                    echo '
                                                              <img class="img-thumbnail briefimg mx-1" src="' . $imgpath . $value['img'] . '">';
                }
                if (count($items) < 3) { } else {
                    echo '<i class="fas fa-ellipsis-h" style="color:grey; margin-left:5px; line-height:2.4;"></i>';
                }
            }
            echo '
                                                          </div>
                                                      </div>
                                                      <div class="col-3">
                                                          <div class="row">
                                                              <h5 class="secondHeader">Price</h5>
                                                          </div>
                                                          <div class="row secondRow">
                                                              <h5>NZ$' . $res[$i]['cost'] . '</h5>
                                                          </div>
                                                      </div>
                                                      <div class="col-3 text-left">
                                                          <div class="row">
                                                              <h5 class="ordertime secondHeader">Ordered On:</h5>
                                                          </div>
                                                          <div class="row secondRow">
                                                              <h5>' . $res[$i]['date'] . '</h5>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              ';
            $statusName = $res[$i]['statusName'];
            switch ($res[$i]['statusID']) {
                case 0:
                    $badgeType = 'badge-secondary';
                    break;
                case 1:
                    $badgeType = 'badge-info';
                    $statusName = 'paid';
                    break;
                case 2:
                    $badgeType = 'badge-primary';
                    break;
                case 3:
                    $badgeType = 'badge-warning';
                    break;
                case 4:
                    $badgeType = 'badge-success';
                    break;
                case 5:
                    $badgeType = 'badge-dark';
                    break;
                case 6:
                    $badgeType = 'badge-info';
                    $statusName = 'paid';
                    break;
                case 7:
                    $badgeType = 'badge-warning';
                default:
                    # code...
                    break;
            }
            echo '
                                              <div class="col-3 p-1 my-auto text-right pr-5" style="font-size:1.25rem;">
                                                  <span class="badge ' . $badgeType . '">' . $statusName . '</span>
                                              </div>';
            echo '
                                          </div>
                                      </div>

                              </a>
                              <div id="coid' . $i . '" class="collapse" data-parent="#accordion">
                                  <hr class="my-0">
                                  <div class="py-4 details">
                                      
                                  </div>
                              </div>
                          </div>';
        }
    }
    echo '</div>';
} else {
    echo 'Please log in to see your orders.';
}
