<?php
    session_start();
    $_SESSION['location'] = 'updatestoreinfo';
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
    ?>
    <link rel="stylesheet" href="css/branchreport.css">

</head>

<body>
<!-- top header included--------------------------------------------------------------------------------- -->
<section>
        <?php
            include_once ("partials/header.php");
        ?>        
</section>
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
    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Back Order</h6>
        <a class="collapse-item active" href="backorderstatus.php">Order status</a>
        <a class="collapse-item" href="cards.html">Order history</a>
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
        <a class="collapse-item" href="utilities-color.html">Order status</a>
        <a class="collapse-item" href="utilities-border.html">Order history</a>
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
    <div id="content" style="margin-top:130px; width:100%;">

    <!-- Begin Page Content -->
        <div class="container-fluid" style="width:100%;">

          <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Order status</h1>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                </div>
                <!-- backorder collapse starts -->
                                      
                <div class="container">                                         
                          <div class="card">
                        <button type="button" class="btn btn-primary listcol" id="col1" data-toggle="collapse" data-target="#demo">Latest back order</button>
                        <div id="demo" class="collapse show">
                            <p></p>
                            <button type="button" class="btn btn-primary">Abrir</button>
                        <button type="button" class="btn btn-primary">Alterar</button>
                          <button type="button" class="btn btn-primary">Encerrar</button>
                          <p></p>
                            <button type="button" class="btn btn-primary">Consultar Processos</button>
                        <button type="button" class="btn btn-primary">Renovação de Licenças</button>
                          <button type="button" class="btn btn-primary">Outros</button>
                          
                        </div>
                        <p></p>
                        </div>
                          <div class="card">
                          <button type="button" class="btn btn-primary listcol" id="col2" data-toggle="collapse" data-target="#demo2">Other back orders on shipping</button>
                        <div id="demo2" class="collapse">
                            <p></p>
                            <button type="button" class="btn btn-primary">Abrir</button>
                        <button type="button" class="btn btn-primary">Alterar</button>
                          <button type="button" class="btn btn-primary">Encerrar</button>
                          <p></p>
                            <button type="button" class="btn btn-primary">Consultar Processos</button>
                        <button type="button" class="btn btn-primary">Renovação de Licenças</button>
                          <button type="button" class="btn btn-primary">Outros</button>
                        </div>
                        </div>
                        <!-- last collapse -->
                        <p></p>
                        <div class="card">
                          <button type="button" class="btn btn-primary listcol" id="col3" data-toggle="collapse" data-target="#demo2">paid back orders</button>
                        <div id="demo2" class="collapse">
                            <p></p>
                            <button type="button" class="btn btn-primary">Abrir</button>
                        <button type="button" class="btn btn-primary">Alterar</button>
                          <button type="button" class="btn btn-primary">Encerrar</button>
                          <p></p>
                            <button type="button" class="btn btn-primary">Consultar Processos</button>
                        <button type="button" class="btn btn-primary">Renovação de Licenças</button>
                          <button type="button" class="btn btn-primary">Outros</button>
                        </div>
                        </div>
                        <!-- collase ends -->
                      </div>
                
                <!-- backorder collapse ends -->



        </div>
    </div>
</div>
<!-- --------------------------------------------------------------------------------------------------------- -->
<?php
    include_once ("partials/foot.php");
  ?>  
  <script type="text/javascript" src="js/sub.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
<!---------------------------------------------------------------------------------------------------------------->

</body>
</html>
<style>
  .listcol{
    
  }
  #col1{
    background-color: rgba(224, 184, 65, 1);
    border: 1px solid rgba(224, 184, 65, 1);
  }
  </style>