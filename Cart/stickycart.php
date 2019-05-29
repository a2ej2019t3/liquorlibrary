<div class="sticky-container">
    <ul id="stickyCartBt" class="sticky" >
            <button id="stickyCart" class="cartbutton" data-toggle="modal" data-target="#cart">
            <div><i class="fas fa-dolly"></i></div>
            
             </button>
    </ul>
</div>
<!-- modal cart ---------------------------------------------------------------------------------------->
<div class="modal fade"  id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-md" role="document" style="position: absolute; top: 300px; right: 80px; width:400px;">
    <div class="modal-content"style="background-color: rgba(215, 232, 186, 1);">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-shopping-basket" style="font-size: 30px;"></i> Shopping Cart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- class="show-cart table" -->
        <div id="showItems" class="container">
            
        </div>
        <div>Total price: $<span class="total-cart"></span></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="checkoutbutton" onclick="location.href='paymentprocess.php';">Check Out</button>
        
      </div>
    </div>
  </div>
</div> 
<!--  cart modal ends-------------------------------------------------------------------------------- -->
<style>
    .sticky-container{
    padding:0px;
    margin:0px;
    position:fixed;
    right:-130px;
    top:430px;
    width:180px;
    z-index: 1100;
}
.sticky{
    background-color: black;
    width: 160px;
    /* height: 50px; */
    border-top-left-radius: 25px;
    border-bottom-left-radius: 25px;
}
.cartbutton{
    width: 100%;
    margin-left:-50px;
    background-color: transparent;
    border:none;
}
.sticky div{
    list-style-type:none;
    color:#efefef;
    height:43px;
    padding:0px;
    margin:0px 0px 1px 0px;
    -webkit-transition:all 0.25s ease-in-out;
    -moz-transition:all 0.25s ease-in-out;
    -o-transition:all 0.25s ease-in-out;
    transition:all 0.25s ease-in-out;
    cursor:pointer;
    
}

.sticky div{
    padding-top:5px;
    /* margin:0px; */
    line-height:16px;
    font-size:11px;

}
.sticky div i{
    text-decoration:none;
    color: white;
    margin-left: -45px;
    margin-top: 8px;
    font-size: 25px;
}
.sticky div i:hover{
    color: white!important;
}

.sticky:hover{
    margin-left:-20px;
}
ul.sticky:hover > span{
    margin-left:-20px;
}

#checkoutbutton{
    background-color: #8B0000;
    border: 1px solid #8B0000;
}
#checkoutbutton:hover{
    background-color: white;
    border: 1px solid #8B0000;
    color: #8B0000;
}
#stickyCart span {
    font-size: 8px;
    line-height: 14px;
    background: rgb(241, 208, 22);
    padding: 2px;
    border: 1px solid #fff;
    border-radius: 25%;
    position: absolute;
    top: -1px;
    left: 13px;
    color: #fff;
    width: 14px;
    height: 13px;
    text-align: center;
    }

    </style>