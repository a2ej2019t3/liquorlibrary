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
                  <div class="col-6 ml-3 pb-2 card homeCards">
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
            </div>
          </div>';
            // profile edit 
$infoArr = $DBsql->select('users', array('userID'=>$buyerID));
$info = $infoArr[0];
var_dump($info);
echo '
            <div class="row mt-3">
              <div class="col-6 ml-3 pb-2 card homeCards">
                <div class="py-auto my-3 d-flex justify-content-between">
                  <h5 style="width:auto;"><i class="fas fa-user-circle"></i> My Profile</h5>
                  <button id="profileBtn" class="editProfileBtn btn btn-sm btn-light"><i class="fas fa-edit" style="color:inherit;"></i> Edit</button>
                </div>
                <hr class="m-0 p-0">
                <div class="row">
                <table id="profileTable" class="table table-borderless" style="text-align:left;">
                  <thead>
                    <tr>
                      <th scope="col" style="width:25%"></th>
                      <th scope="col" style="width:25%"></th>
                      <th scope="col" style="width:25%"></th>
                      <th scope="col" style="width:25%"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row"><b class="displayTable show">Name:</b><b class="editForm hide">First name:</b></th>
                      <td colspan="3" class="displayTable show">'.$info['firstName'].' '.$info['lastName'].'</td>
                      <td class="editForm hide"><input name="firstName" type="text" class="form-control form-control-sm" placeholder="'.$info['firstName'].'" value="'.$info['firstName'].'"></td>
                      <th class="editForm hide" scope="row"><b class="editForm hide">Last name:</b></th>
                      <td class="editForm hide"><input name="lastName" type="text" class="form-control form-control-sm" placeholder="'.$info['lastName'].'" value="'.$info['lastName'].'"></td>
                    </tr>
                    <tr>
                      <th scope="row"><b>Email:</b></th>
                      <td colspan="3" class="displayTable show">'. $info['email'] .'</td>
                      <td colspan="3" class="editForm hide"><input name="email" type="email" class="form-control form-control-sm" placeholder="'.$info['email'].'" value="'.$info['email'].'"></td>
                    </tr>
                    <tr>
                      <th scope="row"><b>Contact number:</b></th>
                      <td colspan="3" class="displayTable show">'. $info['phone'] .'</td>
                      <td colspan="3" class="editForm hide"><input name="phone" type="number" class="form-control form-control-sm" placeholder="'.$info['phone'].'" value="'.$info['phone'].'"></td>
                    </tr>
                    <tr>
                      <th scope="row"><b>Billing address:</b></th>
                      <td colspan="3" class="displayTable show">'. $info['address'] .'</td>
                      <td colspan="3" class="editForm hide"><input name="address" type="text" class="form-control form-control-sm" placeholder="'.$info['address'].'" value="'.$info['address'].'"></td>
                    </tr>
                    <tr>
                      <th scope="row"><b>Company name:</b></th>
                      <td colspan="3" class="displayTable show">'. $info['companyName'] .'</td>
                      <td colspan="3" class="editForm hide"><input name="companyName" type="text" class="form-control form-control-sm" placeholder="'.$info['companyName'].'" value="'.$info['companyName'].'"></td>
                    </tr>
                    <tr>
                      <th scope="row"><b>Password:</b></th>
                      <td colspan="3" colspan="3"><b>********</b>  <a id="resetPasswordBtn" class="ml-3" style="color:royalblue; font-size:1rem;"><i class="fas fa-undo" style="font-size:0.8rem;"></i> Reset</a></td>
                    </tr>
                  </tbody>
                </table>
                </div>
              </div>
            </div>';