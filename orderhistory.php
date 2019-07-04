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
  <link rel="stylesheet" href="css/orderhistory.css">
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