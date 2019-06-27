<style>
  .close {
    padding-top: 3px !important;
    padding-right: 5px !important;
  }

  .modal {
    bottom: initial !important;

  }

  .modal-backdrop {
    display: none !important;
  }

  #btContainer {
    position: fixed;
    right: 10px;
    top: 60%;
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
    display:none;
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
  <!-- click event of the button below is in search.js line 26 -->
  <button id="stickyCartBtn" class="cartbutton sticky">
    <div>
      <div>
        <i class="fas fa-dolly"></i>
      </div>
    </div>
  </button>
</div>
<!-- modal cart ---------------------------------------------------------------------------------------->
<div class="card" id="stickyCart" style="z-index:1000; border:none; display:none;">
  <div class="modal-dialog modal-md" role="document" style="position: absolute; right: 80px; width:400px;">
    <div class="modal-content" style="box-shadow: 2px 3px rgba(124, 99, 84, 1); height: 100%;">

      <div class="modal-body" style="padding:0;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span>&times;</span>
        </button>
        <div id="showItems" class="container" style=" overflow:scroll; max-height:70vh;">

        </div>
        <span class="totalquantity">Total ( <span id="cartTotalQuantity" class="total-cart"></span> ITEMS)</span> <span class="totalcost">price: $<span id="cartTotalPrice" class="total-cart"></span></span>
      </div>
      <div class="modal-footer" style="text-align:center; margin: 0 auto;">
        <?php
        if (isset($_SESSION['user'])) {
          $idJson = 'loggedIn';
        } else {
          $idJson = 'guest';
        }
        ?>
        <button type="button" class="btn btn-primary" id="checkoutbutton" onclick='removeItem("<?php echo $idJson ?>", "all")'>EMPTY CART</button>
        <button type="button" class="btn btn-primary" id="checkoutbutton" onclick="location.href='paymentprocess.php?';">CHECKOUT</button>
      </div>
    </div>
  </div>
</div>

<!-- <div class="modal fade" id="cart" tabindex="-1" style="">
  <div class="modal-dialog modal-md" role="document" style="position: absolute; right: 80px; width:400px;">
    <div class="modal-content"style="box-shadow: 2px 3px rgba(124, 99, 84, 1); height: 100%;">

      <div class="modal-body" style="padding:0;">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span>&times;</span>
        </button>
        <div id="showItems" class="container" style=" overflow:scroll; max-height:70vh;">

        </div>
        <span class="totalquantity">Total ( <span id="cartTotalQuantity" class="total-cart"></span> ITEMS)</span>  <span class="totalcost">price: $<span id="cartTotalPrice" class="total-cart"></span></span>
      </div>
      <div class="modal-footer" style="text-align:center; margin: 0 auto;">
      <?php
      if (isset($_SESSION['user'])) {
        $idJson = 'loggedIn';
      } else {
        $idJson = 'guest';
      }
      ?>
        <button type="button" class="btn btn-primary" id="checkoutbutton" onclick='removeItem("<?php echo $idJson ?>", "all")'>EMPTY CART</button>
        <button type="button" class="btn btn-primary" id="checkoutbutton" onclick="location.href='paymentprocess.php?';">CHECKOUT</button>
      </div>
    </div>
  </div>
</div>  -->


<!--  cart modal ends-------------------------------------------------------------------------------- -->

<!-- collapse sidebar
<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">About</a>
  <a href="#">Services</a>
  <a href="#">Clients</a>
  <a href="#">Contact</a>
</div> -->
<script>
  function checkgetitem() {
    if (sessionStorage.getItem('status') != null) {
      location.href = 'paymentprocess.php';
    } else {
      //show validation message
      alert("Please log in to proceed");
      $("#cart .close").click();
      //  jQuery.noConflict(); 
      //   $('#myModal').modal('show');
      $('#myModal').modal();
      exit();
    }
  }
</script>

<style>
  .close {
    padding-top: 3px !important;
    padding-right: 5px !important;
  }

  .modal {
    bottom: initial !important;

  }

  .modal-backdrop {
    display: none !important;
  }

  #btContainer {
    position: fixed;
    right: 10px;
    top: 60%;
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
</style>