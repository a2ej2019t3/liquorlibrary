<?php
session_start();
$_SESSION['location'] = 'customerorder';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Order_History</title>
  <?php
  include_once ("./partials/head.php");
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
      <div class="container mb-1 pl-3" style="font-size:20px;">
        <div class="row">
          <div class="col-9">
            <div class="row">
              <div class="col-2">
                <span>ID <button data-key="orderID" data-sort="des" class="sorter btn btn-light px-1 py-0"><i class="fas fa-sort"></i></button></span>
              </div>
              <div class="col-4 text-left">
              <span>Items in order</span>
              </div>
              <div class="col-3 text-left">
              <span>Total price <button data-key="cost" data-sort="des" class="sorter btn btn-light px-1 py-0"><i class="fas fa-sort"></i></button></span>
              </div>
              <div class="col-3 text-left">
              <span>Order date <button data-key="date" data-sort="des" class="sorter btn btn-light px-1 py-0"><i class="fas fa-sort"></i></button></span>
              </div>
            </div>
          </div>
          <div class="col-3">
            <div class="btn-group">
              <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                Status filter
              </button>
              <div class="dropdown-menu">
                <button class="dropdown-item" value="all" onclick="selectChecking(this.value)">All</button>
                <button class="dropdown-item" value="paid" onclick="selectChecking(this.value)">Paid</button>
                <button class="dropdown-item" value="completed" onclick="selectChecking(this.value)">Completed</button>
                <button class="dropdown-item" value="processing" onclick="selectChecking(this.value)">Processing</button>
                <button class="dropdown-item" value="cancelled" onclick="selectChecking(this.value)">Cancelled</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <article id="container" class="container mx-auto">
        <!-----orders go here----->
        
      </article>
      <footer>
        <div style="height:500px;">
        </div>
      </footer>
      <?php
      include_once ("partials/foot.php");
      ?>
      <script type="text/javascript" src="js/sub.js"></script>
      <script type="text/javascript" src="js/search.js"></script>
      <script type="text/javascript" src="js/main.js"></script>
      <script type="text/javascript" src="js/orderhistory.js"></script>
      <script>

      </script>
      
      <!-- <script type="text/javascript" src="js/orderhistory.js"></script> -->
</body>

</html>