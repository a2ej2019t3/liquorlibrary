<?php
include(__DIR__ . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
$DBsql = new sql;
$buyerID = $_SESSION['user']['userID'];
$rf = dirname(__DIR__);

$consArr = array(
    'buyerID' => $buyerID,
    'LIMIT' => 3
);
$result = $DBsql->select('orders LEFT JOIN status ON orders.status = status.statusID', $consArr);
echo '
                <div class="row">
                  <div class="col mx-3 pb-2 card homeCards">
                    <div class="py-auto my-3 d-flex justify-content-between">
                        <h5 style="width:auto;"><i class="fas fa-book-open"></i> Recent Orders</h5>
                        <button class="badge badge-primary badge-pill btn orderBadge">NEW MESSAGE</button>
                    </div>
                  <div class="list-group list-group-flush d-flex flex-column" style="height:100%">';
if ($result !== null) {
    foreach ($result as $key => $value) {
        $sorted[$value['date']] = $value;
    }
    krsort($sorted);
    foreach ($sorted as $key => $res) {
        echo '
                        <div class="list-group-item">
                        <div class="row">
                          <div class="col">
                            <div class="row">
                              <h6 class="ordertitle">Items</h6>
                            </div>
                            <div class="row">';
        $items = $DBsql->getCartItemsInfo($res['orderID'], array('LIMIT' => '3'));
        // var_dump($items);
        $imgpath = 'images/';
        if (count($items) != 0) {
            foreach ($items as $key => $value) {
                echo '
                              <img class="img-thumbnail briefimg mx-1" src="' . $imgpath . $value['img'] . '">';
            }
            if (count($items) < 3) { } else {
                echo '
                              <i class="fas fa-ellipsis-h" style="color:grey; margin-left:5px; line-height:2.4;"></i>';
            }
        }
        include('./partials/badgeSwitch.php');

        echo '
                            </div>
                          </div>
                          <div class="col">
                            <div class="row">
                              <h6 class="ordertitle">Ordered on</h6>
                            </div>
                            <div class="row">
                              <h6>' . $res['date'] . '</h6>
                            </div>
                          </div>
                          <div class="col">
                            <div class="row statusBadgeRow justify-content-center" style="padding-top:20px;">
                              <span class="badge statusBadge ' . $badgeType . '">' . $statusName . '</span>
                            </div>
                          </div>
                          <div class="col" style="padding-top:20px;">
                            <button class="btn btn-sm btn-light goToOrder" data-oid="'. $res['orderID'] .'">
                              Detail>
                            </button>
                          </div>
                          </div>
                        </div>';
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

echo '
              </div>
              <button type="button" class="btn btn-light">See more</button>
            </div>
            <div class="col mx-3 pb-2 card homeCards">
              <div class="py-auto my-3 d-flex justify-content-between">
                <h5 style="width:auto;"><i class="fas fa-shopping-cart"></i> Shopping Cart</h5>
              </div>
              <div id="showItems" class="container" style="height:100%;">

              </div>
                <div id="cartInfo" class="d-flex flex-column text-right">
                  <span class="totalquantity">Total ( <b id="cartTotalQuantity" class="total-cart"></b>)</span>
                  <span class="totalcost">price: $<b id="cartTotalPrice" class="total-cart"></b></span>
                </div>
              <a href="paymentprocess.php" class="btn btn-light">Check Out</a>
            </div>';
