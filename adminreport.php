<?php
session_start();
$_SESSION['location'] = 'branchreport';
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

</head>

<body>
    <!-- top header included--------------------------------------------------------------------------------- -->
    <section>
        <?php
        include_once("partials/header.php");
        ?>
    </section>
    <!-- top header ends--------------------------------------------------------------------------------- -->
    <!-- Side Nav included--------------------------------------------------------------------------------- -->
    <?php
    if (isset($_SESSION['admin'])) {
        // require_once('partials/branchquery.php');
        // require_once('partials/branchearningchart.php');
        // require_once('partials/piechartquery.php');
        // require_once('partials/chartrender.php');
        require_once('partials/adminquery.php');
        ?>
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: rgba(48, 43, 41,1); margin-top:100px; background-image:none;">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">

                    <div class="sidebar-brand-text mx-3"><?php echo $_SESSION['user']['email'] ?></div>
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
                    Admin information
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Store information</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="updatestoreinfo.php">Update information</a>

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
            <div id="content" style="margin-top:100px; width:100%;">

                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:100%;">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800" style="font-wight:600">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">pending delivery orders</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                if (!empty($pending_delivery_Arr)) {
                                                    echo count($pending_delivery_Arr);
                                                } else {
                                                    echo '0';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">completed delivery orders</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <span class="thismonth">
                                                    <?php
                                                    if (!empty($completed_delivery_monthly_Arr)) {
                                                        echo count($completed_delivery_monthly_Arr);
                                                    } else {
                                                        echo '0';
                                                    }
                                                    ?>
                                                </span>
                                                /
                                                <span class="total">
                                                    <?php
                                                    if (!empty($completed_delivery_Arr)) {
                                                        echo count($completed_delivery_Arr);
                                                    } else {
                                                        echo '0';
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bus-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">pending pickup orders</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                                if (!empty($pending_pickup_Arr)) {
                                                    echo count($pending_pickup_Arr);
                                                } else {
                                                    echo '0';
                                                }
                                                ?>
                                            </div>

                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">completed Pickup orders</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <span class="thismonth">
                                                    <?php
                                                    if (!empty($completed_pickup_monthly_Arr)) {
                                                        echo count($completed_pickup_monthly_Arr);
                                                    } else {
                                                        echo '0';
                                                    }
                                                    ?>
                                                </span>
                                                /
                                                <span class="total">
                                                    <?php
                                                    if (!empty($completed_pickup_Arr)) {
                                                        echo count($completed_pickup_Arr);
                                                    } else {
                                                        echo '0';
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-person-booth fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="container-fluid" style="width:100%;">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-6">
                            <div class="card border-left-success shadow h-100 py-2" style="border-left: .25rem solid black!important;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="color: black!important;">Backorder Cost (This month)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <span class="thismonth">
                                                    <?php
                                                    echo '$' . number_format($confirm_delivery_monthly_cost, 2, '.', ', ');
                                                    ?>
                                                </span>
                                                /
                                                <span class="total">
                                                    <?php
                                                    echo number_format($confirm_delivery_cost, 2, '.', ', ');
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="col-xl-6 col-md-6 col-6">
                            <div class="card border-left-success shadow h-100 py-2" style="border-left: .25rem solid black!important;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="color: black!important;">Pickup income (This month)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <span class="thismonth">
                                                    <?php
                                                    echo '$' . number_format($confirm_pickup_monthly_cost, 2, '.', ', ');
                                                    ?>
                                                </span>
                                                /
                                                <span class="total">
                                                    <?php
                                                    echo number_format($confirm_pickup_cost, 2, '.', ', ');
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <!-- Line chart -->
                        <div class="col-xl-7 col-lg-7 col-sm-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Pickup Orders :Earnings Overview</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <div id="myAreaChart" style="width: 100%;"></div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- branch backorders -->

                        <div class="col-xl-5 col-lg-5 col-sm-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Branch Backorders : Overview</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="width: 100%;">
                                    <!--  -->
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="card border-left-success shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="color: black!important;">Pending backorders</div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                                                                                if (!empty($pending_backorder_Arr)) {
                                                                                                                    echo count($pending_backorder_Arr);
                                                                                                                } else {
                                                                                                                    echo '0';
                                                                                                                }
                                                                                                                ?></div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col-6">
                                            <div class="card border-left-success shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="color: black!important;">completed backorders</div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                                <span class="thismonth">
                                                                    <?php
                                                                    if (!empty($confirm_backorder_monthly_Arr)) {
                                                                        echo count($confirm_backorder_monthly_Arr);
                                                                    } else {
                                                                        echo '0';
                                                                    }
                                                                    ?>
                                                                </span>
                                                                /
                                                                <span class="total">
                                                                    <?php
                                                                    if (!empty($confirm_backorder_Arr)) {
                                                                        echo count($confirm_backorder_Arr);
                                                                    } else {
                                                                        echo '0';
                                                                    }
                                                                    ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <br>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card border-left-success shadow h-100 py-2" style="border-left: .25rem solid black!important;">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="color: black!important;">backorders amount</div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                                <span class="thismonth">
                                                                    <?php
                                                                    echo '$' . number_format($confirm_backorder_monthly_cost, 2, '.', ', ');
                                                                    ?>
                                                                </span>
                                                                /
                                                                <span class="total">
                                                                    <?php
                                                                    echo number_format($confirm_backorder_cost, 2, '.', ', ');
                                                                    ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- pie chart -->



        <!-- ---------------------------------------------------------------------------------------------------------- -->
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
    <script type="text/javascript" src="js/chart.js"></script>
    <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <!---------------------------------------------------------------------------------------------------------------->

</body>

</html>