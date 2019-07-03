<?php
session_start();
$_SESSION['location'] = 'updatestoreinfo1';
include_once('connection.php');
include_once('database/DBsql.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
  <?php
  include_once("partials/head.php");
  ?>
  <title>Branch Admin Dashboard</title>
  <link rel="stylesheet" href="css/branchreport.css">

  <style>
    .nav>li>a:hover,
    .nav>li>a:focus {
      text-decoration: none;
      background-color: gold !important;
    }
  </style>
</head>

<body>




  <section>
    <?php
    include_once("partials/header.php");
    ?>
  </section>
  <div style="height:100px;">
  </div>
  <div class="card">
    <ul class="nav nav-tabs">
      <li class="nav-item"><a href="#home" data-toggle="tab" class="mytabs">Store Information</a></li>
      <li class="nav-item"><a href="#update" data-toggle="tab" class="mytabs">Manager Info</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane fade show" id="home">
        <form id="tab">

          <div class="row">
            <div class="col-sm-3">

              <h4>StoreID:</h4>
              <h4>StoreName:</h4>
              <h4>Contact Info:</h4>
              <h4>Email:</h4>
              <h4>Address:</h4>
            </div>


            <div class="col-sm-3">
              <?php

              if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];
                echo $_SESSION['warehouse']['whID'];
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
									
                  
											<h4>' . $orderRow[$i]["whName"] . '</h4>
											<h6>' . $orderRow[$i]["phone"] . '	</h6>
											<h6>' . $orderRow[$i]["email"] . '</h6>
                      <h6>' . $orderRow[$i]["address"] . ' </h6>  
                                       
									';
                  } ?>
                  <span class="pull-right">
                    <button type="button" data-toggle="modal" data-target="#edit1" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i> Edit</button>
                  </span>
                </div>
              </div>


              <!-- manager list -->
              <p>
                Store Manager List:
              </p>
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
									
                        <h4><th>' . $orderRow[$i]["userID"] . '</th></h4>
                        <h4><th>' . $orderRow[$i]["firstName"] . $orderRow[$i]["lastName"] . '</th></h4>
											<h4><th>' . $orderRow[$i]["phone"] . '</th></h4>
											<h4><th>' . $orderRow[$i]["email"] . '</th></h4>
                      <h4><th>' . $orderRow[$i]["address"] . '</th></h4>  
                                       
									';
                    } ?>
                  </table>

                </form>
              </div>

              <!-- user Profile -->
              <div class="tab-pane in" id="update">
                <form id="tab2">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <h4>Your Profile</h4>
                        <hr>

                      </div>
                    </div>

                    <div class="tab-pane active in">
                      <form id="tab">
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
                            </div>

                          </form>
                        </div>
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
    <?php
    include_once("profile_modal.php");
    include_once("store_modal1.php");
    ?>

    <?php
    include_once("partials/foot.php");
    ?>
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    <script type="text/javascript" src="js/sub.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/search.js"></script>
</body>

</html>