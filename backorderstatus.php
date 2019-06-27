<?php
    session_start();
    $_SESSION['location'] = 'backorderstatus';
    include ('connection.php');  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Branch Admin Dashboard</title>
    <?php
    include_once ("partials/head.php");
    include(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'liquorlibrary' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
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
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: rgba(48, 43, 41,1); background-image:none;">

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
        <a class="collapse-item active" href="backorderstatus.php">Order status</a>
        <a class="collapse-item" href="backorderhistory.php">Order history</a>
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
                    <h1 class="h3 mb-0 text-gray-800">Order status</h1>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                </div>
                <!-- backorder collapse starts -->
                                      
                <div class="container-fluid">                                         
                          <div class="card">
                        <button type="button" class="btn btn-primary listcol" id="col1" data-toggle="collapse" data-target="#demo">Latest back order</button>
                        <div id="demo" class="collapse show">
                            <p></p>
                           <?php
                          //  
                                echo '<div class="card">
                              
                                        <div id="heading" class="py-2">
                                            <div class="row">
                                                <div class="col-9 mx-auto">
                                                    <div class="row">
                                                        <div class="col-2 col-xs-1 mx-auto">
                                                            <h5 class="ids">#' . $totalbackorder_arr[0][0] . '</h5>
                                                        </div>
                                                        <div class="col-4 col-xs-3 text-left">
                                                            <div class="row">
                                                                <h5 class="secondHeader">Items</h5>
                                                            </div>
                                                            <div class="row secondRow">';
                                                            $imgpath = 'images/';
                                                            $items = $DBsql->getCartItemsInfo($totalbackorder_arr[0][0], array('LIMIT' => '3'));
                            
                                                            if (count($items) != 0) {
                                                              foreach ($items as $key => $value) {
                                                                echo '
                                                                    <img class="img-thumbnail briefimg mx-1" src="' . $imgpath . $value['img'] . '">';
                                                              }
                                                              if (count($items) < 3) { } else {
                                                                echo '<i class="fas fa-ellipsis-h" style="color:grey; margin-left:5px; line-height:2.4;"></i>';
                                                              }
                                                            }
                                                        echo'
                                                            </div>
                                                        </div>
                                                        <div class="col-3 col-xs-4">
                                                            <div class="row">
                                                                <h5 class="secondHeader">Price</h5>
                                                            </div>
                                                            <div class="row secondRow">
                                                                <h5>NZ$' . $totalbackorder_arr[0][6] . '</h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-3 col-xs-4 text-left">
                                                            <div class="row">
                                                                <h5 class="ordertime secondHeader">Ordered On:</h5>
                                                            </div>
                                                            <div class="row secondRow">
                                                                <h5 class="orderdate">' . $totalbackorder_arr[0][3] . '</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>';
                                                $statusName = $totalbackorder_arr[0][4];
                                                switch ($totalbackorder_arr[0][4]) {
                                                  case 0:
                                                    $badgeType = 'badge-secondary';
                                                    
                                                    break;
                                                  case 1:
                                                    $badgeType = 'badge-info';
                                                    $statusName = 'paid';
                                                    break;
                                                  case 2:
                                                    $badgeType = 'badge-primary';
                                                    $statusName = 'processing';
                                                    break;
                                                  case 3:
                                                    $badgeType = 'badge-warning';
                                                    $statusName = 'ready to pick up';
                                                    break;
                                                  case 4:
                                                    $badgeType = 'badge-success';
                                                    $statusName = 'completed';
                                                    break;
                                                  case 5:
                                                    $badgeType = 'badge-dark';
                                                    $statusName = 'cancelled';
                                                    break;
                                                  case 6:
                                                    $badgeType = 'badge-info';
                                                    $statusName = 'paid';
                                                    break;
                                                  case 7:
                                                    $badgeType = 'badge-warning';
                                                    $statusName = 'shipping';
                                                  default:
                                                    # code...
                                                    break;
                                                }
                                               echo' <div class="col-1  p-1 my-auto pl-5" style="font-size:1.25rem;">
                                                    <span class="badge ' . $badgeType . '">' . $statusName . '</span>
                                                    
                                                </div>
                                                <div class="col-2 p-1 my-auto  pl-5" style="font-size:1.25rem;">
                                            <button class="btn btn-primary adminmsg" id="branchemailbutton"  data-toggle="modal" data-target="#branchemail" value="' . $totalbackorder_arr[0][0] . '" onclick="branchorderid();"><i class="fa fa-envelope"></i> </button>
                                                
                                            </div>

                                            </div>
                                        </div>
                                <div>
                                <hr  >
                                    <hr class="my-0">
                                    <div class="py-4 details">
                                   
                                <div class="row">';
                                $userinfo = $DBsql->select('users', array('userID'=>$totalbackorder_arr[0][1]));
                                    echo' 
                                    <div class="col-4 text-left">                                        
                                              <div class="row">
                                                  <h5 class="secondHeader">Order Name</h5>
                                              </div>
                                              <div class="row">
                                              <h5>'.$userinfo[0]['firstName'].' '.$userinfo[0]['lastName'].'</h5>
                                              </div>
                                              <div class="row">
                                              <h5 class="secondHeader">Warehouse Name</h5>
                                              </div>
                                              <div class="row">
                                              <h5>'.$_SESSION['warehouse']['whName'].'</h5>
                                              </div>
                                              <div class="row">
                                              <h5 class="secondHeader">Warehouse Address</h5>
                                              </div>
                                              <div class="row">
                                              <h5>'.$_SESSION['warehouse']['address'].'</h5>
                                              </div>
                                      </div>
                                      <div class="col-8 ">';
                                      $cartID = $totalbackorder_arr[0][0];
                                      // $cartID = 1;
                                      $res = $DBsql->getOrderInfo($cartID, null);
                                      // var_dump($res);
                                      $tagForCategory = 'Category: ';
                                      $tagForBrand = 'Brand: ';
                                      $tagForPrice = 'Price: ';
                                      for ($b = 0; $b < count($res); $b++) {
                                        echo '
                                            <div class="row" style="width: 100%; margin:0;">
                                                    <div class="container" style="left:0;">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="row" style="min-height:80px;">
                                    
                                                                    <div id="posterarea" class="col" 
                                                                    style="max-width: 50px;
                                                                    min-width: 25px;
                                                                    padding: 0 0 0 10px !important;
                                                                    margin: auto;
                                                                    text-align: center;">
                                                                        <img class="img-fluid" src='.$imgpath.$res[$b]['img'].' style = "max-height:70px;">
                                                                    </div>
                                    
                                                                    <div id="titlearea" class="col" style="padding:0 0 0 5px; margin:auto;">
                                                                        <p style="color:black; text-align:left; margin:0;">
                                                                            <b>'.$res[$b]['productName'].'</b><br>
                                                                            <a href="../categorysearch.php?searchcategoryID='.$res[$b]['categoryID'].'&searchcategoryName='.$res[$b]['categoryName'].'&location=category"><i style="font-size">'.$tagForCategory.$res[$b]['categoryName'].'</i></a><br>
                                                                            <a href="../categorysearch.php?brandname='.$res[$b]['brandName'].'&location=brandproduct"><i>'.$tagForBrand.$res[$b]['brandName'].'</i></a>
                                                                        </p>
                                                                    </div>
                                    
                                                                </div>
                                                            </div>
                                                            <div class="col" style="padding:0;">
                                                                <div class="row">
                                    
                                                                    <div id="quantityCol" class="col" style="margin-top:15px;">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <h5>&times;'.$res[$b]['quantity'].'</h5>
                                                                            </div>
                                                                            <div class="col">
                                                                                <h5>NZ$'.$res[$b]['totalprice'].'</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr style="margin:0;">';
                                        }
                                        
                                        echo '
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="secondHeader">Total:</h5>
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="pr-3"style="font-weight:700; color: black;font-size: 1.3rem; margin-right: 50px;">NZ$'.$res[0]['cost'].'
                                                    </div>
                                                </div>
                                                <div class="row">
                                        
                                                </div>
                                            </div>
                                      </div>
                                  </div>      
                                </div>
                                </div>  
                               

                            </div>';
                          // 
                           ?>
                          <p></p>

                        </div>
                        <p></p>
                        </div>
                          <div class="card">
                          <button type="button" class="btn btn-primary listcol" id="col2" data-toggle="collapse" data-target="#demo2">Back orders on shipping</button>
                        <div id="demo2" class="collapse">
                            <p></p>
                            <?php
                            
            echo '
              <div id="accordion">';
        if(!empty($shippingorder_arr)){
            for ($i = 0; $i < count($shippingorder_arr); $i++) {
              echo '
                          <div class="card">
                              <a class="btn p-0 orders"  data-toggle="collapse" data-target="#coid' . $i . '" data-orderid="' . $shippingorder_arr[$i][0] . '" style="width:100%;">

                                      <div id="heading" class="py-2">
                                          <div class="row">
                                              <div class="col-9 my-auto">
                                                  <div class="row">
                                                      <div class="col-2 mx-auto">
                                                          <h5 class="ids">#' . $shippingorder_arr[$i][0] . '</h5>
                                                      </div>
                                                      <div class="col-4 text-left">
                                                          <div class="row">
                                                              <h5 class="secondHeader">Items</h5>
                                                          </div>
                                                          <div class="row secondRow">';
              $items = $DBsql->getCartItemsInfo($shippingorder_arr[$i][0], array('LIMIT' => '3'));
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
                                                              <h5>NZ$' . $shippingorder_arr[$i][6] . '</h5>
                                                          </div>
                                                      </div>
                                                      <div class="col-3 text-left">
                                                          <div class="row">
                                                              <h5 class="ordertime secondHeader">Ordered On:</h5>
                                                          </div>
                                                          <div class="row secondRow">
                                                              <h5 class="orderdate">' . $shippingorder_arr[$i][3] . '</h5>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                            
       
                                              <div class="col-1 p-1 my-auto text-left pl-5" style="font-size:1.25rem;">
                                                  <span class="badge badge-warning">shipping</span>
                                              </div>';
                                          echo ' <div class="col-2 col-xs-6 p-1 my-auto  pl-5" style="font-size:1.25rem;">
                                          <button class="btn btn-primary adminmsg"  data-toggle="modal" data-target="#branchemail"><i class="fa fa-envelope"></i> </button>
                                          
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
            echo '<center>There is no shipping order at the moment</center>';
          }
        ?>
                        </div>
                        </div>
                        <!-- last collapse -->
                        <p></p>
                        <div class="card">
                          <button type="button" class="btn btn-primary listcol" id="col3" data-toggle="collapse" data-target="#demo3">paid back orders</button>
                        <div id="demo3" class="collapse">
                            <p></p>
                            <?php
                            
                            echo '
                              <div id="accordion">';
                        if(!empty($paidorder_arr)){
                            for ($i = 0; $i < count($paidorder_arr); $i++) {
                              echo '
                                          <div class="card">
                                              <a class="btn p-0 orders"  data-toggle="collapse" data-target="#coid2' . $i . '" data-orderid="' . $paidorder_arr[$i][0] . '" style="width:100%;">
                
                                                      <div id="heading" class="py-2">
                                                          <div class="row">
                                                              <div class="col-9 my-auto">
                                                                  <div class="row">
                                                                      <div class="col-2 mx-auto">
                                                                          <h5 class="ids">#' . $paidorder_arr[$i][0] . '</h5>
                                                                      </div>
                                                                      <div class="col-4 text-left">
                                                                          <div class="row">
                                                                              <h5 class="secondHeader">Items</h5>
                                                                          </div>
                                                                          <div class="row secondRow">';
                              $items = $DBsql->getCartItemsInfo($paidorder_arr[$i][0], array('LIMIT' => '3'));
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
                                                                              <h5>NZ$' . $paidorder_arr[$i][6] . '</h5>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-3 text-left">
                                                                          <div class="row">
                                                                              <h5 class="ordertime secondHeader">Ordered On:</h5>
                                                                          </div>
                                                                          <div class="row secondRow">
                                                                              <h5 class="orderdate">' . $paidorder_arr[$i][3] . '</h5>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                              <div class="col-1 p-1 my-auto text-left pl-5" style="font-size:1.25rem;">
                                                                  <span class="badge badge-info">paid</span>
                                                                </div>';
                                                            echo '       <div class="col-2 col-xs-6 p-1 my-auto  pl-5" style="font-size:1.25rem;">
                                                        <button class="btn btn-primary adminmsg" id="branchemailbutton"  data-toggle="modal" data-target="#branchemail" value="' . $totalbackorder_arr[$i][0] . '" onclick="branchorderid();"><i class="fa fa-envelope"></i> </button>
                                                            
                                                        </div>
                                                          </div>
                                                      </div>
                
                                              </a>
                                              <div id="coid2' . $i . '" class="collapsesub" data-parent="#accordion">
                                                  <hr class="my-0">
                                                  <div class="py-4 details" style="display:none;">
                                                      
                                                  </div>
                                              </div>
                                          </div>';
                            }
                         
                          echo '</div>';
                          }else{
                            echo '<center>There is no shipping order at the moment</center>';
                          }
                        ?>
                        </div>
                        </div>
                        <!-- collapse ends -->
                        <p></p>
                        <div class="card">
                          <button type="button" class="btn btn-primary listcol" id="col4" data-toggle="collapse" data-target="#demo4">Cancelled back orders</button>
                        <div id="demo4" class="collapse">
                            <p></p>
                            <?php
                            
                            echo '
                              <div id="accordion">';
                        if(!empty($cancelorder_arr)){
                            for ($i = 0; $i < count($cancelorder_arr); $i++) {
                              echo '
                                          <div class="card">
                                              <a class="btn p-0 orders"  data-toggle="collapse" data-target="#coid3' . $i . '" data-orderid="' . $cancelorder_arr[$i][0] . '" style="width:100%;">
                
                                                      <div id="heading" class="py-2">
                                                          <div class="row">
                                                              <div class="col-9 my-auto">
                                                                  <div class="row">
                                                                      <div class="col-2 mx-auto">
                                                                          <h5 class="ids">#' . $cancelorder_arr[$i][0] . '</h5>
                                                                      </div>
                                                                      <div class="col-4 text-left">
                                                                          <div class="row">
                                                                              <h5 class="secondHeader">Items</h5>
                                                                          </div>
                                                                          <div class="row secondRow">';
                              $items = $DBsql->getCartItemsInfo($cancelorder_arr[$i][0], array('LIMIT' => '3'));
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
                                                                              <h5>NZ$' . $cancelorder_arr[$i][6] . '</h5>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-3 text-left">
                                                                          <div class="row">
                                                                              <h5 class="ordertime secondHeader">Ordered On:</h5>
                                                                          </div>
                                                                          <div class="row secondRow">
                                                                              <h5 class="orderdate">' . $cancelorder_arr[$i][3] . '</h5>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>

                                                              <div class="col-1 p-1 my-auto text-left pl-5" style="font-size:1.25rem;">
                                                                  <span class="badge badge-dark' . $badgeType . '">cancelled</span>
                                                              </div>';
                                                                echo ' <div class="col-2 col-xs-6 p-1 my-auto  pl-5" style="font-size:1.25rem;">
                                                            <button class="btn btn-primary adminmsg" id="branchemailbutton"  data-toggle="modal" data-target="#branchemail" value="' . $totalbackorder_arr[$i][0] . '" onclick="branchorderid();"><i class="fa fa-envelope"></i> </button>
                                                                
                                                            </div>
                                                          </div>
                                                      </div>
                
                                              </a>
                                              <div id="coid3' . $i . '" class="collapsesub" data-parent="#accordion">
                                                  <hr class="my-0">
                                                  <div class="py-4 details" style="display:none;">
                                                      
                                                  </div>
                                              </div>
                                          </div>';
                            }
                         
                          echo '</div>';
                          }else{
                            echo '<center>There is no cancelled order</center>';
                          }
                        ?>
                        </div>
                        </div>
                      </div>
                
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
