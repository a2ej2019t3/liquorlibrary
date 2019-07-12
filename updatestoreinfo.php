<?php
session_start();
$_SESSION['location'] = 'updatestoreinfo';
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Branch Admin Dashboard</title>
  <?php
  include_once("partials/head.php");
  ?>
  <link rel="stylesheet" href="css/branchreport.css">
  <link rel="stylesheet" href="css/branch.css">
  <style>
    .maintop {
      font-size: 1.2rem;
      font-weight: 800;
      margin: 10px 15px;
      margin-bottom: 30xp;
    }
  </style>
</head>

<body>
  <!-- top header included--------------------------------------------------------------------------------- -->
  <section>
    <?php
    include_once("partials/header.php");
    ?>
  </section>
  <?php
  if (isset($_SESSION['user'])) {
    include_once("profile_modal.php");
    include_once("store_modal1.php");
    include_once("partials/foot.php");

    ?>
    <!-- top header ends--------------------------------------------------------------------------------- -->
    <!-- Side Nav included--------------------------------------------------------------------------------- -->
    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: rgba(48, 43, 41,1); margin-top:130px; background-image:none;">

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
            <span>Dashboard</span></a>
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
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Back Order</h6>
              <a class="collapse-item" href="backorderstatus.php">Order status</a>
              <a class="collapse-item" href="backorderhistory.php">Order history</a>

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
          <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item active" href="updatestoreinfo.php">Update information</a>

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
      <div id="content" style="margin-top:130px; width:100%;">

        <!-- Begin Page Content -->
        <div class="container-fluid" style="width:100%;">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Branch Information </h1><span style="float:left!important">Click the panel to see the information.</span>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>
          <div class="card">
    

            <nav>
              <div class="nav nav-tabs nav-fill" id="nav-tab nav nav-tabs" role="tablist">
                <a class="nav-item mytabs active nav-link " id="nav-home" data-toggle="tab" href="#home" role="tab" aria-selected="true">Store Information</a>
                <a class="nav-item mytabs nav-link" id="nav-update" data-toggle="tab" href="#update" role="tab" aria-selected="false">Admin Information</a>
              </div>
            </nav>

            <div id="myTabContent" class="tab-content">
              <div class="tab-pane active in" id="home">
                <form id="tab">
                  <span class="maintop" style="margin-left:0;">
                    Store Info <span class="pull-right">
                      <button type="button" data-toggle="modal" data-target="#editstore" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i> UPDATE</button>
                    </span>
                  </span>
                  <div class="row">
                    <div class="col-12">
                      <div class="row firstbox">
                        <table class="table" style="margin-top:10px;">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">#ID</th>
                              <th scope="col">Store Name</th>
                              <th scope="col">Contact</th>
                              <th scope="col">Email</th>
                              <th scope="col">Address</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php

                            if (isset($_SESSION['user'])) {
                              $user = $_SESSION['user'];
                              // echo $_SESSION['warehouse']['whID'];
                              $whID = $_SESSION['warehouse']['whID'];
                              $orders_list =  "SELECT * from warehouse w where w.whID = '$whID'";
                              // $orders_list = "SELECT w.*, u.whID from warehouse w, users u where u.userID = w.whID and w.whID = '$whID'";
                              $query = mysqli_query($connection, $orders_list);
                              if (mysqli_num_rows($query) > 0) {
                                $orderRow = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                ?>

                                <?php
                                //var_dump(count($orderRow));
                                for ($i = 0; $i < count($orderRow); $i++) {
                                  //var_dump($i);
                                  echo '

                                    <tr>

                                    <th scope="row">' . $orderRow[$i]["whID"] . '</th>
                                    <td>' . $orderRow[$i]["whName"] . '	</td>
                                    <td>' . $orderRow[$i]["phone"] . '</td>
                                    <td>' . $orderRow[$i]["email"] . ' </td>
                                    <td>' . $orderRow[$i]["address"] . ' </td>
                                  </tr>                 
                                ';
                                } ?>

                              </tbody>
                            </table>


                          </div>
                        </div>

                      </div><!-- row TAB -->
                      <div class="row">
                        <div class="maintop">
                          Store Manager Info <span style="font-size:0.7rem; font-weight:600;">Total: <?php echo count($orderRow) + 1; ?> managers<span>
                        </div>
                        <table class="table table-bordered">
                          <thead>
                            <th>UserID:</th>
                            <th>Name:</th>
                            <th>Phone:</th>
                            <th>Email:</th>
                            <th>Address:</th>
                          </thead>
                          <?php

                          if (isset($_SESSION['user'])) {
                            // $user = $_SESSION['user'];
                            // echo $_SESSION['warehouse']['whID'];
                            $whID = $_SESSION['warehouse']['whID'];
                            $orders_list =  "SELECT u.*, s.whID from users u, staff s where u.userID = s.userID and s.whID = '$whID'";
                            $query = mysqli_query($connection, $orders_list);
                            // var_dump($query);
                            if (!empty($query)) {
                              $orderRow = mysqli_fetch_all($query, MYSQLI_ASSOC);
                              // var_dump($orderRow);
                              ?>


                              <?php
                              //var_dump(count($orderRow));
                              for ($i = 0; $i < count($orderRow); $i++) {
                                //var_dump($i);
                                echo '
									<tr>
                        <h4><th>' . $orderRow[$i]["userID"] . '</th></h4>
                        <h4><th>' . $orderRow[$i]["firstName"] . $orderRow[$i]["lastName"] . '</th></h4>
                        <h4><th>' . $orderRow[$i]["phone"] . '</th></h4>
                        <h4><th>' . $orderRow[$i]["email"] . '</th></h4>
                        <h4><th>' . $orderRow[$i]["address"] . '</th></h4>  
                           </tr><br>           
									';
                              } ?>

                            </table>

                          </div><!-- row TAB -->

                        </form>
                      </div><!-- HOME TAB -->

                      <div class="tab-pane in" id="update">
                        <form id="tab2">
                          <div class="row">
                            <div class="col-sm-3">
                              <h4>userID:</h4>
                              <h4>Name:</h4>
                              <h4>Contact Info:</h4>
                              <h4>Email:</h4>
                              <h4>Address:</h4>
                            </div>
                            <div calss="col-sm-3">
                              <?php
                              if (isset($_SESSION['user'])) {
                                $user = $_SESSION['user'];
                                echo $_SESSION['user']['userID'];
                                $userID = $_SESSION['user']['userID'];
                                $orders_list =  "SELECT * from users u where u.userID = '$userID'";
                                $query = mysqli_query($connection, $orders_list);
                                if (mysqli_num_rows($query) > 0) {
                                  $orderRow = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                  ?>
                                  <?php
                                  //var_dump(count($orderRow));
                                  for ($i = 0; $i < count($orderRow); $i++) {
                                    //var_dump($i);
                                    echo '
									
											
											<h6>' . $orderRow[$i]["firstName"] . '</h6>
																					<h6><td>' . $orderRow[$i]["phone"] . '	</h6>
											<h6>' . $orderRow[$i]["email"] . '</h6>
                      <h6>' . $orderRow[$i]["address"] . ' </h6>                     
										';
                                  } ?>
                                  <span class="pull-right">
                                    <button type="button" href="#edit" class="btn btn-success btn-flat btn-sm" data-toggle="modal"><i class="fa fa-edit"></i> Edit</button>
                                  </span>
                                </div>

                            </form>
                          </div>
                        </div>
                      </div> <!-- mycontents -->
                    </div>
                  </div>
                </div>
              <?php
              }
            }
            ?>
          <?php
          }
        }
        ?>
      <?php
      }
    }
    ?>

    </div>


    <!-- --------------------------------------------------------------------------------------------------------- -->
  <?php
  } else {
    echo '<h4 style="position: absolute; top: 40%; left: 40%;">This page needs a valid authentification to read.</h4> ';
  }
  ?>
  <?php
  include_once("partials/foot.php");
  ?>
  <script type="text/javascript" src="js/sub.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
  <!---------------------------------------------------------------------------------------------------------------->

</body>

</html>