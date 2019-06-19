<?php
session_start();
$_SESSION['location'] = 'customerorder';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Order_History</title>
  <?php
  include_once("./partials/head.php");
  ?>
  <link rel="stylesheet" href="css/index.css">
  <style type="text/css">
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
      color: grey;
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
  </style>
</head>

<body>
  <section>
    <?php
    include_once("./partials/header.php");
    ?>
  </section>
  <section>
    <div>
      <p class="contactms">Customer Order Details</p>
      <hr style="color: black;">
      <!-- <div class="filter-group"> -->
      <!-- <div class="container_fluid">    -->
      <!-- <div class="productresult col-md-9 col-xs-12 content-right"> -->
      <!-- product list results -->
      <div style="font-size:20px;">Status
        <select onchange="selectChecking()" id="statusSort" style="width: 100px;margin-left: 15px;">
          <option value="0" selected="ture">All</option> -->
          <option value="1">PAID</option>
          <option value="2">COMPLETED</option>
          <option value="3">PROCESSING</option>
          <option value="4">CANCELLED</option>
          <button type="submit"></button>
        </select>
      </div>
      <article id="container" class="container mx-auto">
        <!-----orders go here----->
        <?php
        include(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'liquorlibrary' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
        $DBsql = new sql;
        // $optIndex = $_GET['i'];
        // if ($optIndex == 0) {
        //   $statusID = '';
        // } else if ($optIndex == 1) {
        //   $statusID = array(1, 6);
        // } else if ($optIndex == 2) {
        //   $statusID = 3;
        // } else if ($optIndex == 3) {
        //   $statusID = 7;
        // } else if ($optIndex == 4) {
        //   $statusID = 4;
        // }
        // var_dump($statusID);
        if (isset($_SESSION['user'])) {
          $buyerID = $_SESSION['user']['userID'];

          // if ($statusID != '') {
            $consArr = array(
              'buyerID' => $buyerID,
              // 'status' => $statusID
            );
          // } else {
          //   $consArr = array(
          //     'buyerID' => $buyerID
          //   );
          // }
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
        ?>
      </article>
      <footer>
        <div style="height:500px;">
        </div>
      </footer>
      <?php
      include_once("partials/foot.php");
      ?>
      <script>
        $(function() {
          $('.collapse').on('show.bs.collapse', function() {
            var obj = $(this);
            var orderid = obj.siblings('.orders').data("orderid");
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                obj.children('div').html(xmlhttp.response);
              }
            }
            xmlhttp.open("GET", "orderHistoryDetail.php?oi=" + orderid, true);
            xmlhttp.send();
          });
        })

        function selectChecking() {
          var obj = document.getElementById('statusSort');
          var index = obj.options[obj.selectedIndex].getAttribute('value');
          if (index == 0) {
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
        }
      </script>
      <script type="text/javascript" src="js/sub.js"></script>
      <script type="text/javascript" src="js/search.js"></script>
      <script type="text/javascript" src="js/main.js"></script>
      <!-- <script type="text/javascript" src="js/orderhistory.js"></script> -->
</body>

</html>