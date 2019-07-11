<?php
session_start();
$_SESSION['location'] = 'admin_branchreport';
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
        .sumnumber {

            width: 50%;
            height: 100px;
            text-align: center;
            margin: 0 auto;

        }

        .sumnum {
            /* margin: 10px; */
            margin-bottom: 10px;
            border-bottom: 3px dashed rgb(94, 68, 153);
            font-size: 2rem;
            font-weight: 800;
        }

        .list-group-item {
            text-align: left;
        }

        .rankicon {
            width: 30px;
        }
        .rank{
            font-size:2rem;
            font-weight: 800;
            margin-left:50px;
            margin-right:10px;
            color: rgba(250, 188, 60, 1);
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
    <!-- top header ends--------------------------------------------------------------------------------- -->
    <!-- Side Nav included--------------------------------------------------------------------------------- -->
    <?php
    if (isset($_SESSION['admin'])) {
        require_once('partials/adminquery.php');
        require_once('partials/admin_reportquery.php');
        require_once('partials/adminearningchart.php');
        require_once('partials/testchart.php');
        // require_once('partials/piechartquery.php');
        require_once('partials/adminchartrender.php');
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
                    <a class="nav-link" href="adminreport.php">
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
                            <a class="collapse-item" href="admin_backorderstatus.php">BackOrder status</a>
                            <a class="collapse-item" href="admin_backorderhistory.php">BackOrder history</a>
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
                            <a class="collapse-item" href="admin_deliveryorders.php">Delivery Orders</a>
                            <a class="collapse-item" href="admin_pickuporders.php">Pickup Orders</a>
                            <a class="collapse-item" href="admin_orderhistory.php">Order history</a>

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
                        <span>Report</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="admin_branchreport.php">Branch Report</a>
                            <a class="collapse-item" href="updatestoreinfo.php">Staff Report</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="true" aria-controls="collapsePages2">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Store information</span>
                    </a>
                    <div id="collapsePages2" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
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
                        <h1 class="h3 mb-0 text-gray-800" style="font-wight:600">Branch Reports</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <h3 id="header">
                        <strong>Online Sales</strong>
                        <small class="text-muted"><?php echo '-&nbsp' . $selectedmonthname . '&nbsp' . $selectedyear ?></small>
                    </h3>
                    <div class="row m-b-2">
                        <div class="col-lg-4">
                            <div class="card card-block">
                                <h4 class="card-title">Annual Sales</h4>
                                <span class="badge badge-warning badgeforchart">Payment method</span>
                                <div id="annualsales-doughnut-chart"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-block">
                                <h4 class="card-title">Annual Sales</h4>
                                <span class="badge badge-success badgeforchart">Delivery method</span>
                                <div id="users-medium-pie-chart"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-block">
                                <h4 class="card-title">Annual Sales</h4>
                                <span class="badge badge-inverse badgeforchart">per method </span>
                                <div id="users-category-pie-chart"></div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card card-block">
                                <h4 class="card-title m-b-2">
                                    <span id="visitors-chart-heading">Sales Summary</span>
                                    <button class="btn pull-right invisible" type="button" id="visitors-chart-back-button"><i class="fa fa-angle-left fa-lg" aria-hidden="true"></i> Back</button>
                                </h4>
                                <div id="visitors-chart">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="sumtitle" style="font-size: 1.1rem;font-weight: 700;">TOTAL ONLINE SALES</div>

                                            <div class="sumnumber">
                                                <?php
                                                echo '<p class="sumnum">$' . number_format($totalsales_Arr_cost, 2, ',', ' ') . '</p>';

                                                ?>
                                                <span class="tooltiptext"><?php echo count($totalsales_Arr) . 'orders'; ?></span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="sumtitle " style="font-size: 1.1rem;font-weight: 700;">MONTHLY ONLINE SALES</div>

                                            <div class="sumnumber">
                                                <?php
                                                echo '<p class="sumnum">$' . number_format($totalsales_monthly_Arr_cost, 2, ',', ' ') . '</p>';
                                                ?>
                                                <span class="tooltiptext"><?php echo count($totalsales_monthly_Arr) . 'orders'; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="sumtitle" style="font-size: 1.1rem;font-weight: 700;">MONTHLY DOMINANT PAY/DELIVERY METHOD</div>

                                            <div class="sumnumber">
                                                <?php
                                                echo '<p class="sumnum">' . $dominantpay . '/' . $dominantdelivery . '</p>';
                                                ?>
                                                <span class="tooltiptext"><?php echo $dominantordernumberpay . 'orders/ ' . $dominantordernumberpay; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card card-block">
                                <h4 class="card-title m-b-2">Best Selling items</h4>
                                <span class="tag custom-tag" id="visitors-chart-tag">Top5_total</span>

                                <div id="users-spline-chart">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div>
                                                <span class="rank">1</span><span class="rankicon"><i class="fas fa-award fa-2x"></i></span>
                                                
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div>
                                                <span class="rank">2</span><span class="rankicon"><i class="fas fa-award fa-2x"></i></span>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div>
                                                <span class="rank">3</span><span class="rankicon"><i class="fas fa-award fa-2x"></i></span>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div>
                                                <span class="rank">4</span><span class="rankicon"><i class="fas fa-award fa-2x"></i></span>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div>
                                                <span class="rank">5</span><span class="rankicon"><i class="fas fa-award fa-2x"></i></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
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