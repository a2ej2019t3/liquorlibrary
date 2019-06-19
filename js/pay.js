function addLoadEvent(func) {
    var oldonload = window.onload;
    if (typeof window.onload != 'function') {
        window.onload = func;
    } else {
        window.onload = function() {
            if (oldonload) {
            oldonload();
            }
            func();
        }
    }
};

addLoadEvent(finalPrice);
// addLoadEvent(finalquantity);
$('#cart').on('shown.bs.modal', finalPrice);
var CaclulateCostTotal = function(data) {
    // var $this = $(this);
    var id= data;
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
function quantityUpdate(id){
    
    //itemID
    var itemid= id;
   
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
    quantityUpdateToDB(itemid, updateorderid, updatequantity, updatetotal);
    
    ;}
    
  function quantityUpdateToDB(itemid, updateorderid, updatequantity, updatetotal){
      var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function () {
              if (this.readyState == 4 && this.status == 200) {
                  console.log(xmlhttp);
                  // document.getElementById("content").innerHTML = xmlhttp.responseText;
              }
          };
      xmlhttp.open("GET", "./payment/confirmpay.php?orderid="+updateorderid+"&itemid="+itemid+"&quantity="+updatequantity+"&updatetotal="+updatetotal, true);
      xmlhttp.send();
}

var confirmorderdetail = function() {
   var ordertotalcost= document.getElementById('cartTotalPrice').getAttribute('value');
   var ordertotalquantity= document.getElementById('cartTotalQuantity').getAttribute('value');
   var note= document.getElementById('notetext').value; 
   var orderId=document.getElementById('orderidbox').value; 
   
var totalcost = parseFloat(ordertotalcost);
var totalquantity = parseInt(ordertotalquantity, 10);
   
//    alert(totalcost);
//    alert(ordertotalquantity);
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function () {
       if (this.readyState == 4 && this.status == 200) {
           console.log(xmlhttp);
           document.getElementById("content").innerHTML = xmlhttp.responseText;
       }
   };
xmlhttp.open("GET", "./confirmdetail.php?ordertotalcost="+totalcost+"&ordertotalquantity="+totalquantity+"&note="+note+"&orderId="+orderId, true);
xmlhttp.send();
$('#second').ready(function(){
    $('#step1').removeClass('selected');
    $('#step2').addClass('selected');
   });
};
var detailname =function(){
    var username= document.getElementById('usernamebox').value;
    // alert(companyname);
    namebox= document.getElementById('namebox');
    namebox.innerHTML= username;
    namebox.setAttribute('value',username);
    namemodalbox =document.getElementById('namemodal');
    namemodalbox.setAttribute('value',username);
    usernamecontext =document.getElementById('usernamecontext');
    usernamecontext.setAttribute('value',username);
}
var detailnumberupdate=function(){
    var phone= document.getElementById('numberadd').value;
    // alert(companyname);
    namebox= document.getElementById('numberbox');
    namebox.innerHTML= phone;
    namebox.setAttribute('value',phone);

}
var detailcompany =function(){
    var companyname= document.getElementById('comname').value;
    // alert(companyname);
    companydetailbox= document.getElementById('companybox');
    companydetailbox.innerHTML= "Company:   "+ companyname
    companydetailbox.setAttribute('value',companyname);
}
var detailemailupdate =function(){
    var emailaddress= document.getElementById('emailadd').value;
    // alert(companyname);
    emailbox= document.getElementById('emailbox');
    emailbox.innerHTML= emailaddress;
    emailbox.setAttribute('value',emailaddress);
    emailmodalbox =document.getElementById('emailmodal');
    emailmodalbox.setAttribute('value',emailaddress);
    emailreceipt =document.getElementById('emailcontext');
    emailreceipt.setAttribute('value',emailaddress);

}
var detailaddressupdate =function(){
    var address= document.getElementById('addressadd').value;
    // alert(companyname);
    addressbox= document.getElementById('addresschangearea');
    addressbox.innerHTML= address;
    addressbox.setAttribute('value',address);
    addressmodalbox= document.getElementById('addressmodal');
    addressmodalbox.setAttribute('value',address);
}

function paymentModal() {
    // Create a Stripe client.
    var stripe = Stripe('pk_test_LzVFBvv6py0EeG7ifdYNnfJv00dEJ5eiyo');
    
    // Create an instance of Elements.
    var elements = stripe.elements();
    
    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
      base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
          color: '#aab7c4'
        }
      },
      invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
      }
    };
    
    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});
    
    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');
    
    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    });
    
    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();
    
        var sourceData = {
          type: 'sepa_debit',
          currency: 'nzd',
          owner: {
            name: document.querySelector('input[name="name"]').value,
            email: document.querySelector('input[name="email"]').value,
            address: document.querySelector('input[name="address"]').value,
          },
          mandate: {
            // Automatically send a mandate notification email to your customer
            // once the source is charged.
            notification_method: 'email',
          }
        };
      stripe.createToken(card, sourceData).then(function(result) {
        if (result.error) {
          // Inform the user if there was an error.
          var errorElement = document.getElementById('card-errors');
          errorElement.textContent = result.error.message;
        } else {
          // Send the token to your server.
          stripeTokenHandler(result.token);
        }
      });
    });
    
    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
      // Insert the token ID into the form so it gets submitted to the server
      var form = document.getElementById('payment-form');
      // var hiddenInput = document.createElement('input');
      // var hiddenInput2 = document.createElement('input');
      // hiddenInput.setAttribute('type', 'hidden');
      // hiddenInput.setAttribute('name', 'stripeToken');
      // hiddenInput.setAttribute('value', token.id);
      // hiddenInput2.setAttribute('type', 'hidden');
      // hiddenInput2.setAttribute('name', 'stripeEmail');
      // hiddenInput2.setAttribute('value', token.email);      
      // form.appendChild(hiddenInput,hiddenInput2);
     var finalprice=document.getElementById('finalprice').value;
     var finalquantity=document.getElementById('finalquantity').value;
     var note=document.getElementById('notecontext').value;
     var email=document.getElementById('emailcontext').value;
     var orderId=document.getElementById('idcontext').value;
     var username=document.getElementById('usernamecontext').value;

      // Submit the form
      var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                // alert(xmlhttp.responseText);
                if (xmlhttp.responseText == 3) {
                    alert('result empty');                 
                } else if(xmlhttp.responseText == 2) {
                  alert('email sending failed');                 
                }
                else if(xmlhttp.responseText == 1){
                  alert('Success!!!!')
                 
                  $("#payModal .close").click()
                  invoicedirect();
                }
            }
        };
    xmlhttp.open("GET", "stripeIPN.php?stripeToken="+token.id+"&email="+token.email+"&finalprice="+finalprice+"&finalquantity="+finalquantity+"&notecontext="+note+"&emailcontext="+email+"&usernamecontext="+username+"&idcontext="+orderId, true);
    xmlhttp.send();
    }
}

function invoicedirect(params) {

var xmlhttp = new XMLHttpRequest();
var orderId=document.getElementById('idcontext').value;
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                document.getElementById("content").innerHTML = xmlhttp.responseText;
                
            }
        };
    xmlhttp.open("GET", "payment/invoice.php?id="+orderId, true);
    xmlhttp.send();  

    $('#fourth').ready(function(){
      $('#step2').removeClass('selected');
      $('#step4').addClass('selected');
     });
}


// $('#stripe-button').click(function(){
//   var pricevalue= document.getElementById('cartTotalPrice');
//   var amount= pricevalue.getAttribute('value'); 
//   var finalamount= amount*100;
//   StripeCheckout.open({
//     key:         'pk_test_LzVFBvv6py0EeG7ifdYNnfJv00dEJ5eiyo',
//     amount:      finalamount,
//     name:        'LIQUOR LIBRARY',
//     image:       'images/brandlogo.jpg',
//     description: "Please input the valid information",
//     panelLabel:  'CHECK OUT',
//     currency: 'nzd',
//     token:       function(res){
//         var id = $('<input type=hidden name=stripeToken />').val(res.id);
//         var email = $('<input type=hidden name=stripeEmail />').val(res.email);
//         var finalamount = $('<input type=hidden name=finalprice />').val(finalamount);
//         // var finalamount = $('<input type=hidden name=totalquantity />').val(finalamount);
//         // var finalamount = $('<input type=hidden name=id />').val(finalamount);

        
//         $('#payment_form').append(id).append(email).append(finalamount).submit();
//         //  finalprice();
//       }
//   });

// });

