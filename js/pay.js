

var CaclulateCostTotal = function(data) {
    // var $this = $(this);
    var id= $(data).data('attribute');
            var cost= document.getElementById('ticket_price['+id+']').getAttribute('data-value');
            var quant= document.getElementById('quantity['+id+']').value;
            c = parseFloat(cost),
            q = parseInt(quant, 10),
            total = c * q || 0;
        //select the total item sum
        var resulttoal= document.getElementById('total['+id+']');
        var hiddentotal= document.getElementById('hiddentotal['+id+']');
        //display it 
        resulttoal.innerHTML = 'NZ $'+total+'';
        //set
        resulttoal.setAttribute('value',''+total+''); 
        // 
        finalPrice();
       
};

function finalPrice(params) {
    var price = document.getElementsByClassName('asdfa');
    // console.log(price);
    var finalprice = 0;
   for(i=0; i< price.length; i++){
        finalprice+=parseFloat(price[i].getAttribute('value'));
        // console.log(finalprice);
   }
   document.getElementById('cartTotalPrice').innerHTML = finalprice;
   document.getElementById('cartTotalPrice').setAttribute('value',''+finalprice+''); 
   finalquantity();
};
function finalquantity(params){
    var quantity =document.getElementsByClassName('cart-item-quantity-display');
    var finalquantity = 0;
    for(i=0; i< quantity.length; i++){
        finalquantity+=parseInt(quantity[i].value);
        // console.log(finalprice);
        // alert(finalquantity);
   }
   document.getElementById('cartTotalQuantity').innerHTML = ''+finalquantity+' items';
   document.getElementById('cartTotalQuantity').setAttribute('value',''+finalquantity+''); 

};
function quantityUpdate(data){
    
    //itemID
    var itemid= $(data).data('attribute');
   
    // orderId
    var orderid=document.getElementById('order'+itemid+'').value;
    updateorderid = parseInt(orderid, 10);

    var quant= document.getElementById('quantity['+itemid+']').value;
    updatequantity = parseInt(quant, 10);

    var totalitem= document.getElementById('total['+itemid+']').getAttribute('value');
    updatetotal = parseFloat(totalitem);
    // alert(itemid);
    // alert(updateorderid);
    // alert(updatequantity);
    // alert(updatetotal);

    
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                // document.getElementById("content").innerHTML = xmlhttp.responseText;
            }
        };
    xmlhttp.open("GET", "./payment/confirmpay.php?orderid="+updateorderid+"&itemid="+itemid+"&quantity="+updatequantity+"&updatetotal="+updatetotal, true);
    xmlhttp.send();
;}

var confirmorderdetail = function() {
   var ordertotalcost= document.getElementById('cartTotalPrice').value; 
   var ordertotalquantity= document.getElementById('cartTotalQuantity').value; 
   var note= document.getElementById('notetext').value; 

   ordertotalcost = parseFloat(ordertotalcost);
   ordertotalquantity = parseInt(ordertotalquantity,10);
   
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function () {
       if (this.readyState == 4 && this.status == 200) {
           console.log(xmlhttp);
           document.getElementById("content").innerHTML = xmlhttp.responseText;
       }
   };
xmlhttp.open("GET", "./payment/confirmdetail.php?ordertotalcost="+ordertotalcost+"&ordertotalquantity="+ordertotalquantity+"&note="+note, true);
xmlhttp.send();
$('#second').ready(function(){
    $('#step1').removeClass('selected');
    $('#step2').addClass('selected');
   });
};