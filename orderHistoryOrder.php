<?php
$rf = dirname(__DIR__);

session_start();
include(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'liquorlibrary' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
$DBsql = new sql;
if (isset($_SESSION['user'])) {
    $buyerID = $_SESSION['user']['userID'];
    if ($_GET['op'] == 'filt') {
        // echo '1';
        if ($_GET['si']) {
            $optIndex = $_GET['si'];
            if ($optIndex == 'all') {
                $statusID = array(1, 3, 4, 6, 7);
            } else if ($optIndex == 'paid') {
                $statusID = array(1, 6);
            } else if ($optIndex == 'completed') {
                $statusID = 4;
            } else if ($optIndex == 'processing') {
                $statusID = array(3, 7);
            } else if ($optIndex == 'cancelled') {
                $statusID = 5;
            }
        } else {
            echo 'no opt index.';
        }
        $consArr = array(
            'buyerID' => $buyerID,
            'statusID' => $statusID
        );
        $result = $DBsql->select('orders LEFT JOIN status ON orders.status = status.statusID', $consArr);
        // echo var_dump($result);
        if ($result !== null) {
            foreach ($result as $key => $value) {
                $sorted[$value['orderID']] = $value;
            }
            ksort($sorted);
            $_SESSION['sorted'] = $sorted;
        } else {
            $sorted = null;
            echo "
                <div class='container text-center'>
                    <div class='alert alert-secondary'>
                        <b>You don't have any orders.</b>
                    </div>
                </div>";
        }
    } else if ($_GET['op'] == 'sort') {
        if (isset($_SESSION['sorted'])) {
            // echo '2';
            $sortKey = $_GET['key'];
            $sort = $_GET['sort'];
            $result = $_SESSION['sorted'];
            foreach ($result as $key => $value) {
                $sortArr[$key] = $value[$sortKey];
            }
            if ($sort == 'asc') {
                asort($sortArr);
            } else if ($sort == 'des') {
                arsort($sortArr);
            }
            foreach ($sortArr as $key => $value) {
                $sorted[$key] = $result[$key];
            }
        } else {
            $sorted = null;
            echo "
                <div class='container text-center'>
                    <div class='alert alert-secondary'>
                        <b>You don't have any orders.</b>
                    </div>
                </div>";
        }
    }
    if ($sorted !== null) {
        echo '
              <div id="accordion">';
        foreach ($sorted as $key => $res) {
            echo '
                          <div class="card orderCard">
                              <a class="btn p-0 orders"  data-toggle="collapse" data-target="#coid' . $res['orderID'] . '" data-orderid="' . $res['orderID'] . '" style="width:100%;">

                                      <div id="heading" class="py-2">
                                          <div class="row">
                                              <div class="col-9 my-auto">
                                                  <div class="row">
                                                      <div class="col-2 mx-auto">
                                                          <h5 class="ids">#' . $res['orderID'] . '</h5>
                                                      </div>
                                                      <div class="col-4 text-left">
                                                          <div class="row">
                                                              <h5 class="secondHeader">Items</h5>
                                                          </div>
                                                          <div class="row secondRow">';
            $items = $DBsql->getCartItemsInfo($res['orderID'], array('LIMIT' => '3'));
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
                                                              <h5>NZ$' . $res['cost'] . '</h5>
                                                          </div>
                                                      </div>
                                                      <div class="col-3 text-left">
                                                          <div class="row">
                                                              <h5 class="ordertime secondHeader">Ordered On:</h5>
                                                          </div>
                                                          <div class="row secondRow">
                                                              <h5>' . $res['date'] . '</h5>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              ';
            include('./partials/badgeSwitch.php');

            echo '
                                              <div class="col-3 p-1 my-auto text-left pl-5" style="font-size:1.25rem;">
                                                  <span class="badge statusBadge ' . $badgeType . '">' . $statusName . '</span>
                                              </div>';
            echo '
                                          </div>
                                      </div>

                              </a>
                              <div id="coid' . $res['orderID'] . '" class="collapse orderCollapse" data-parent="#accordion">
                                  <hr class="my-0">
                                  <div class="py-4 details">
                                      
                                  </div>
                              </div>
                          </div>';
        }
    }
    echo '</div>';
} else {
    echo '
        <div class="container text-center">
            <div class="alert alert-warning">
                <b>Please log in to see your orders.</b>
            </div>
        </div>';
}
