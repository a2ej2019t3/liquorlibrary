<?php
session_start();
$_SESSION['location'] = 'index';
include(__DIR__ . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
$DBsql = new sql;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Order_History</title>
  <?php
  include_once("./partials/head.php");
  ?>
  <!-- <link rel="stylesheet" href="css/branchreport.css"> -->
  <link rel="stylesheet" href="css/index.css">
  <style type="text/css">
    body {
      background-color: rgba(221, 226, 234, 0.11);
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

    .orderCard {
      transition: box-shadow 0.3s;
    }

    .orderCard:hover {
      box-shadow: 0px 0px 10px 5px lightgray;
      z-index: 100;
    }

    .orderCard:focus,
    .orderCard:active {
      box-shadow: 0px 0px 10px 5px lightgray;
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

    .sideBtn:focus,
    .sideBtn:active,
    .filter:focus,
    .filter:active {
      background-color: rgba(255, 193, 5, 1);
      outline: none !important;
      box-shadow: none !important;
    }

    .collapse:before {
      box-shadow: 0px 6px 7px -6px rgba(0, 0, 0, 0.2) inset;
    }

    .details {
      padding-left: 80px;
      padding-right: 80px;
    }

    .sideCard {
      background-color: none;
      min-height: 100vh;
      height: 100%;
      /* border-right: 1px solid lightgrey */
    }

    .sidenav li .sideBtn,
    .sidenav li .filter {
      text-align: left;
      font-size: 1rem;
      margin: 3px 0px 3px 3px;
    }

    .fas:hover {
      color: white;
    }

    .sideBtn {
      width: 100%;
      height: 40px;
    }

    .filter {
      width: auto;
      height: 40px;
    }

    .sideBtn:hover,
    .filter:hover {
      color: white;
      background-color: rgba(255, 193, 5, 1);
    }

    .homeCards>div {
      width: 100%;
      margin: 2px 3px 2px;
    }

    .homeCards {
      transition: box-shadow 0.2s;
    }

    .homeCards:hover {
      box-shadow: 0px 0px 10px 5px lightgray;
      z-index: 99;
    }

    .card-header {
      text-align: left;
      font-size: 1.2rem;
    }

    .optBtn {
      text-align: right;
      color: white;
    }

    .optBtn:hover {
      background-color: rgba(255, 193, 5, 1);
    }

    #statusFilter {
      background-color: rgba(255, 193, 5, 0.7);
      border-radius: 3px;
      margin-left: auto;
      margin-right: auto;
    }

    #wrapper {
      /* margin-top:130px; */
      margin-top: 0px;
      /* z-index: 10; */
    }

    #bannerPic {
      object-fit: cover;
      height: 300px;
      min-width: 100vw;
    }

    #bannerPic::after {
      position: absolute;
      top: 0;
      left: 0;
      height: 300px;
      min-width: 100vw;
      box-shadow: 0px 0px 7px 6px rgba(0, 0, 0, 0.8) inset;
      z-index: 1000;
    }

    .orderBadge {
      line-height: 1rem;
      transition: background-color 0.2s;
    }

    .orderBadge:hover {
      color: white;
      background-color: darkblue;
      cursor: pointer;
    }

    #toast_wrapper {
      position: fixed;
      z-index: 1000;
      bottom: 0;
      right: 0;
    }

    .ordertitle {
      color: lightslategrey;
    }

    .statusBadge {
      min-width: 90px;
      line-height: 1rem;
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
  <?php
  $buyerID = $_SESSION['user']['userID'];
  $readyOrder = $DBsql->select('orders LEFT JOIN status ON orders.status = status.statusID', array('buyerID' => $buyerID, 'status' => 3));
  // var_dump($readyOrder);

  // toast wrapper here
  echo '
                  <div id="toast_wrapper" class="d-flex flex-column m-4">';
  foreach ($readyOrder as $key => $value) {
    $orderID = $value['orderID'];
    echo '
                          <div id="myToast" class="toast" data-autohide="false">
                            <div class="toast-header">
                              <i class="fas fa-bell"></i>
                              <strong class="mr-auto">&nbsp;&nbsp;Order ready</strong>
                              <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">
                                <span>&times;</span>
                              </button>
                            </div>
                            <div class="toast-body">
                              <p class="my-auto">You have an order ready to pickup! <button class="btn btn-link toastCheck" data-oid="' . $orderID . '">check</button></p>
                            </div>
                          </div>';
  }
  echo '
                  </div>';
  // toast wrapper end

  ?>
  <section>
    <?php
    include_once($rf . "/partials/header.php");
    ?>
  </section>
  <section id="banner">
    <img id="bannerPic" class="img-fluid" src="images\liquor19.jpeg">
  </section>
  <div id="wrapper" class="container-fluid">
    <div class="row pt-2">
      <!-- Sidebar -->
      <div id="sideNav_wrapper" class="col-2 pr-0">
        <div class="card sideCard px-2">
          <ul class="navbar-nav sidenav">
            <div class="headerPart mb-4">
              <span class="sidebar-brand d-flex flex-column align-items-center justify-content-center" href="index.php">
                <div style="width:auto;">
                  <img src="images/filepic1.png" alt="File pic" class="rounded-circle img-thumbnail img-fluid" style="max-width:60%; background-color:white; margin-top:-30%;">
                </div>
                <div>
                  <p id="userName">Welcome!<br><?php echo '<b>' . $_SESSION['user']['firstName'] . ' ' . $_SESSION['user']['lastName'] . '</b>'; ?></p>
                </div>
              </span>
            </div>
            <hr class="p-0 mx-auto mb-1" style="width:95%;">
            <li>
              <button class="btn sideBtn homeBtn" type="button">
                <i class="fas fa-home"></i>
                Home
              </button>
            </li>
            <li>
              <div class="btn-group d-flex">
                <button id="orderHistoryTab" type="button" class="btn sideBtn" value="all" onclick="selectChecking(this.value)">
                  <i class="fas fa-history"></i>
                  Order History
                </button>
                <button type="button" class="btn filter my-auto " style="border-left:1px solid grey;" data-toggle="collapse" data-target="#statusFilter">
                  <i class="fas fa-filter"></i>
                </button>
              </div>
              <div id="statusFilter" class="collapse mx-2 mt-1">
                <div class="d-flex flex-column">
                  <button class="btn optBtn" value="paid" onclick="selectChecking(this.value)"><b>Paid</b></button>
                  <button class="btn optBtn" value="completed" onclick="selectChecking(this.value)"><b>Completed</b></button>
                  <button class="btn optBtn" value="processing" onclick="selectChecking(this.value)"><b>Processing</b></button>
                  <button class="btn optBtn" value="cancelled" onclick="selectChecking(this.value)"><b>Cancelled</b></button>
                </div>
              </div>
            </li>
            <li>
              <button class="btn sideBtn" type="button">
                <i class="fas fa-user-circle"></i>
                My Profile
              </button>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-10">

        <section id="content_wrapper" class="col card" style="width:100%; padding-top: 30px; min-height:100vh; height:100%; padding-bottom: 30px;">
          
        </section>
      </div>
    </div>
  </div>
  <?php
  include_once("partials/foot.php");
  ?>
  <script type="text/javascript" src="js/sub.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/cart.js"></script>
  <script type="text/javascript" src="js/orderhistory.js"></script>
  <script type="text/javascript" src="js/chart.js"></script>
  <script type="text/javascript" src="js/pay.js"></script>

  <script>

  </script>

  <!-- <script type="text/javascript" src="js/orderhistory.js"></script> -->
</body>

</html>