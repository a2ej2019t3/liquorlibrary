<style>
  .close {
    padding-top: 3px !important;
    padding-right: 5px !important;
  }

  #btContainer {
    position: fixed;
    top: 60%;
    right: 0;
    width: 60px;
    height: 60px;
    z-index: 1000;
  }

  @keyframes onhovermovement {
    from {}

    to {
      box-shadow: 0 0px 20px rgba(0, 0, 0, 0.5);
    }
  }

  .sticky {
    position: relative;
    background-color: black;
    border-radius: 50%;
    height: 100%;
    width: 100%;
    padding: 0px;
    margin: 0px;
    box-shadow: 0 0px 10px rgba(0, 0, 0, 0.3);
  }

  .sticky:hover {
    animation-name: onhovermovement;
    animation-duration: .5s;
    animation-fill-mode: forwards;
  }

  .sticky div i {
    text-decoration: none;
    color: white;
    text-align: center;
    /* margin-left: ;
    margin-top: 8px; */
    font-size: 25px;
  }

  .sticky div i:hover {
    color: white !important;
  }

  #checkoutbutton {
    background-color: #8B0000;
    border: 1px solid #8B0000;
  }

  #checkoutbutton:hover {
    background-color: white;
    border: 1px solid #8B0000;
    color: #8B0000;
  }

  .totalquantity {
    margin-left: 20px;
    text-align: left;
    font-weight: 700;
    float: left;
  }

  .totalcost {
    margin-right: 20px;
    font-size: 19px;
    font-weight: 700;
    float: right;
  }

  .hideCart {
    display: none;
  }

  .fadeOutCart {
    animation: fadeOut 0.5s;
    animation-fill-mode: forwards;
  }

  .showCart {
    display: block;
    animation: fadeIn 0.5s;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
  }

  @keyframes fadeOut {
    from {
      opacity: 1;
    }

    to {
      opacity: 0;
    }
  }
</style>

<div id="btContainer">
  <!-- click event func of the button located in search.js line 26 -->
  <button id="stickyCartBtn" class="cartbutton sticky">
    <div>
      <div>
        <i class="fas fa-dolly"></i>
      </div>
    </div>
  </button>
</div>
<div class="card" id="stickyCart" style="box-shadow: 2px 3px rgba(124, 99, 84, 1);
    position: fixed;
    right: 80px;
    top: 200px;
    z-index: 1000;
    width: 400px;
    display: none;">

  <div class="" style="padding:0;">
    <button type="button" id="stickyCartClose" class="close">
      <span>&times;</span>
    </button>
    <div id="showItems" class="container" style=" overflow:scroll; max-height:70vh; text-align: center;">
    </div>
    <span class="totalquantity">Total ( <span id="cartTotalQuantity" class="total-cart"></span> ITEMS)</span> <span class="totalcost">price: $<span id="cartTotalPrice" class="total-cart"></span></span>
  </div>
  <div style="text-align: center; margin: 20px auto 10px; width: 100%;">
    <?php
    if (isset($_SESSION['user'])) {
      $idJson = 'loggedIn';
    } else {
      $idJson = 'guest';
    }
    ?>
    <div style="width: 300px; display:inline-block;">
      <button type="button" class="btn btn-primary" id="checkoutbutton" onclick='removeItem("<?php echo $idJson ?>", "all")'>EMPTY CART</button>
      <?php
      if (isset($_SESSION['user'])) {
        echo '
          <a href="paymentprocess.php" class="btn btn-primary" id="checkoutbutton">CHECKOUT</a>
          ';
      } else {
        echo '
          <button type="button" class="btn btn-primary" id="checkoutbutton" onclick="openLoginModal()">CHECKOUT</button>
        ';
      }
      ?>
    </div>
  </div>
</div>
