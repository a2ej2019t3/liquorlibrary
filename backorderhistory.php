<?php
    session_start();
    $_SESSION['location'] = 'backorderhistory';
    include ('connection.php');  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Branch Admin backorder history</title>
    <?php
    include_once ("partials/head.php");
    include(__DIR__ . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
    $DBsql = new sql;
    ?>
    <link rel="stylesheet" href="css/branchreport.css">
    <link rel="stylesheet" href="css/branch.css">
</head>

<body>
<!-- top header included--------------------------------------------------------------------------------- -->
<section>
        <?php
            include_once ("partials/header.php");
        ?>        
</section>
<?php
if(isset($_SESSION['warehouse'])){
require_once ('partials/branchquery.php');
require_once ('partials/backorderquery.php');
include_once ("Emailsending/branchemail.php");
  ?>
<!-- top header ends--------------------------------------------------------------------------------- -->
<!-- Side Nav included--------------------------------------------------------------------------------- -->
<div id="wrapper" style="margin-top:50px;">
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: rgba(48, 43, 41,1);background-image:none;">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">

    <div class="sidebar-brand-text mx-3"><?php echo $_SESSION['warehouse']['whName'] ?></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="branchreport.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span  style="font-weight:500">Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
   Product orders
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Back Order</span>
    </a>
    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Back Order</h6>
        <a class="collapse-item" href="backorderstatus.php">Order status</a>
        <a class="collapse-item active" href="backorderhistory.php">Order history</a>
        <a class="collapse-item" href="cards.html">Reports</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-wrench"></i>
      <span>Customer Order</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Customer Order</h6>
        <a class="collapse-item" href="pickuporderstatus.php">Order status</a>
        <a class="collapse-item" href="pickuporderhistory.php">Order history</a>
        <a class="collapse-item" href="utilities-animation.html">Reports</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Warehouse information
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
      <i class="fas fa-fw fa-folder"></i>
      <span>Store information</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="partials/updatestoreinfo.php">Update information</a>

      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- content starts -------------------------------------------------------------------------------------------->
    <div id="content" style="width:100%;">

    <!-- Begin Page Content -->
        <div class="container-fluid" style="width:100%;">

          <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Order history </h1><span style="float:left!important">All the completed orders</span>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                </div>
                <!-- backorder collapse starts -->
                <p></p>
                            <?php
                            
            echo '
              <div id="accordion">';
        if(!empty($totalbackorder_arr)){
            for ($i = 0; $i < count($totalbackorder_arr); $i++) {
              echo '
                          <div class="card">
                              <a class="btn p-0 orders"  data-toggle="collapse" data-target="#coid' . $i . '" data-orderid="' . $totalbackorder_arr[$i][0] . '" style="width:100%;">

                                      <div id="heading" class="py-2">
                                          <div class="row">
                                              <div class="col-9 my-auto">
                                                  <div class="row">
                                                      <div class="col-2 mx-auto">
                                                          <h5 class="ids">#' . $totalbackorder_arr[$i][0] . '</h5>
                                                      </div>
                                                      <div class="col-4 text-left">
                                                          <div class="row">
                                                              <h5 class="secondHeader">Items</h5>
                                                          </div>
                                                          <div class="row secondRow">';
             $imgpath = 'images/';
              $items = $DBsql->getCartItemsInfo($totalbackorder_arr[$i][0], array('LIMIT' => '3'));
              // var_dump($items);
              
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
                                                              <h5>NZ$' . $totalbackorder_arr[$i][6] . '</h5>
                                                          </div>
                                                      </div>
                                                      <div class="col-3 text-left">
                                                          <div class="row">
                                                              <h5 class="ordertime secondHeader">Ordered On:</h5>
                                                          </div>
                                                          <div class="row secondRow">
                                                              <h5 class="orderdate">' . $totalbackorder_arr[$i][3] . '</h5>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                            
       
                                              <div class="col-1 p-1 my-auto text-left pl-5" style="font-size:1.25rem;">
                                                  <span class="badge badge-success">Completed</span>
                                              </div>';
                                            echo ' <div class="col-2 col-xs-6 p-1 my-auto  pl-5" style="font-size:1.25rem;">
                                            <button class="btn btn-primary adminmsg" id="branchemailbutton"  data-toggle="modal" data-target="#branchemail" value="' . $totalbackorder_arr[$i][0] . '" onclick="branchorderid();"><i class="fa fa-envelope"></i> </button>
                                            
                                        </div>
                                          </div>
                                      </div>

                              </a>
                              <div id="coid' . $i . '" class="collapsesub" data-parent="#accordion">
                                  <hr class="my-0">
                                  <div class="py-4 details" style="display:none;">
                                      
                                  </div>
                              </div>
                          </div>';
            }
         
          echo '</div>';
          }else{
            echo 'There is no completed order yet';
          }
        ?>
    <!-- backorder collapse ends -->



        </div>
    </div>
</div>
<!-- --------------------------------------------------------------------------------------------------------- -->
<?php
}
else{
  echo '<h4 style="position: absolute; top: 40%; left: 40%;">This page needs a valid authentification to read.</h4> ';
}
?>
<?php
    include_once ("partials/foot.php");
  ?>  
  <script>
        $(function() {
          $('.collapsesub').on('show.bs.collapse', function() {
            var obj = $(this);
            var orderid = obj.siblings('.orders').data("orderid");
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                obj.children('div').html(xmlhttp.response);
                obj.children('div').css('display','block');
              }
            }
            xmlhttp.open("GET", "orderHistoryDetail.php?oi=" + orderid, true);
            xmlhttp.send();
          });
        })

      </script>
  <script type="text/javascript" src="js/sub.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
  <script type="text/javascript" src="js/chart.js"></script>
<!---------------------------------------------------------------------------------------------------------------->

</body>
</html>
