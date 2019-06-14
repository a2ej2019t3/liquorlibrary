
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
// addLoadEvent(warehouseidentify);
// addLoadEvent(finalquantity);

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

// delivery method js
function warehouseidentify(){
  var logintype=document.getElementById('usertypecontext').getAttribute('value');
  if(logintype==1){
    $('button[name=ckbtn]').hide();
    $('button[name=ckbtn2]').show();
    $('#extrainfo').css("display") == "none";
  }

}

// --------------------------------------
function deliveryinput() {

  var sel = $('#deliverymothod :selected').val();
  var deliveryhidden =document.getElementById('delivercontext');

  if (sel == 'pickup') 
  {
    $('select[name=paymentmothod]').show();
    $('select[name=locationselect]').show();
    var deliveryoptionbox=document.getElementById('deliveryoption');
    deliveryoptionbox.innerHTML=sel;
    deliveryoptionbox.setAttribute('value',sel);
    
    deliveryhidden.setAttribute('value',sel);
  }
  else if(sel=='delivery')
  {
    $('select[name=paymentmothod]').hide();
    $('select[name=locationselect]').hide();
    var deliveryoptionbox=document.getElementById('deliveryoption');
    deliveryoptionbox.innerHTML=sel;
    deliveryoptionbox.setAttribute('value',sel);

    var paymentbox=document.getElementById('paymentoption');
    paymentbox.innerHTML='card';
    paymentbox.setAttribute('value','card');
    deliveryhidden.setAttribute('value',sel);

  }
};

function paymentinput(){
  var sel = $('#paymentmothod :selected').val();
  var paymenthidden =document.getElementById('paymentcontext');

  if (sel == 1) 
  {
    var paymentoptionbox=document.getElementById('paymentoption');
    paymentoptionbox.innerHTML= 'card';
    paymentoptionbox.setAttribute('value','card');
    paymenthidden.setAttribute('value','card');
    $('button[name=ckbtn2]').hide();
    $('button[name=ckbtn]').show();
  }
  else if(sel == 2)
  {
       var paymentoptionbox=document.getElementById('paymentoption');
    paymentoptionbox.innerHTML='cash';
    paymentoptionbox.setAttribute('value','cash'); 
    paymenthidden.setAttribute('value','cash');
    $('button[name=ckbtn]').hide();
    $('button[name=ckbtn2]').show();

  }
};

function locationinput(){
  // location warehous ID
  var sel = $('#locationselect :selected').val();
  // location name
  var selname = $('#locationselect :selected').text();
  var locationhidden =document.getElementById('pickupcontext');

  var locationbox=document.getElementById('pickuparea');
  var locationname=document.getElementById('locationbox');

  locationbox.innerHTML=selname;
  locationbox.setAttribute('value',sel); 
  locationhidden.setAttribute('value',sel);
  locationname.setAttribute('value',selname);
}
// ---------------------------------------
function payproceed(){
  // warehouse validation
  var username_val=$('#usernamebox').val();
  var email_val =$('#emailadd').val();
  var number_val=$('#numberadd').val();

  if( username_val!=="" && email_val!=="" && number_val!=="" ){
    
    var logintype=document.getElementById('usertypecontext').getAttribute('value');
    if(logintype==1){
              // alert('warehouse order');
              loader5();
              setTimeout(function(){ invoicedirect(); }, 1000);       
              
              
    }
    else if(logintype==3 || logintype==2 ){
      var paymentpath=$('#paymentmothod :selected').val();
        if(paymentpath==2){
          var deliverymothod=$('#deliverymothod :selected').val();  
            if(deliverymothod=='pickup'){
              var locationselect=$('#locationselect :selected').val();
              if(locationselect== ""){
                alert('please select the pick up location')
              }
              else{
                // alert('individual or partner cash order');
                loader5();
                setTimeout(function(){ invoicedirect(); }, 2000);    
              }     
            }
          }
        else{
          paymentModal();
        }
    }
  }
 else{
   alert('please check the empty input to proceed.');
 }

};

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

     var finalprice=document.getElementById('finalprice').value;
     var finalquantity=document.getElementById('finalquantity').value;
     var note=document.getElementById('notecontext').value;
     var email=document.getElementById('emailcontext').value;
     var orderId=document.getElementById('idcontext').value;
     var username=document.getElementById('usernamecontext').value;
     var paymentmethod=document.getElementById('paymentoption').getAttribute('value');
     var deliverymethod=document.getElementById('delivercontext').getAttribute('value');
     var pickupwarehouseId=document.getElementById('pickuparea').getAttribute('value');
      // Submit the form
      var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                // alert(xmlhttp.responseText);
                // if (xmlhttp.response !== null) {
                //   var response = JSON.parse(xmlhttp.response);
                // } else {
                //   console.log(xmlhttp.response);
                // }
                if (xmlhttp.responseText == 3) {
                    alert('result empty');                 
                } else if(xmlhttp.responseText == 2) {
                  alert('email sending failed');                 
                }
                else if(xmlhttp.responseText == 1){
                  // alert(response.id);
                  alert('Success!!!!');
                 
                  $("#payModal .close").click()
                  invoicedirect();
                }
            }
        };
    xmlhttp.open("GET", "stripeIPN.php?stripeToken="+token.id+"&finalprice="+finalprice+"&finalquantity="+finalquantity+"&notecontext="+note+"&emailcontext="+email+"&usernamecontext="+username+"&idcontext="+orderId+"&paymentmethod="+paymentmethod+"&deliverymethod="+deliverymethod+"&pickupwarehouseId="+pickupwarehouseId, true);
    xmlhttp.send();
    }
}

function invoicedirect(params) {

var xmlhttp = new XMLHttpRequest();
// login type
var logintype=document.getElementById('usertypecontext').getAttribute('value');
// warehouse
var orderId=document.getElementById('idcontext').value;
var username=document.getElementById('usernamebox').value;
var email=$('#emailadd').val();
// var email=document.getElementById('emailadd').value;
var contactnumber=document.getElementById('numberadd').getAttribute('value');

// for individual &business partner
var address=document.getElementById('addresschangearea').getAttribute('value');
var note=document.getElementById('notebox').getAttribute('value');
var paymentmethod=document.getElementById('paymentoption').getAttribute('value');
var deliverymethod=document.getElementById('deliveryoption').getAttribute('value');
var pickupwarehouseId=document.getElementById('pickuparea').getAttribute('value');
var pickuplocation=document.getElementById('locationbox').getAttribute('value');

// order info
var cost=document.getElementById('totalcostbox').getAttribute('value');
var quantity=document.getElementById('totalquantbox').getAttribute('value');


        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                document.getElementById("content").innerHTML = xmlhttp.responseText;
                
            }
        };
    xmlhttp.open("GET", "payment/invoice.php?id="+orderId+"&username="+username+"&address="+address+"&email="+email+"&contactnumber="+contactnumber+"&paymentmethod="+paymentmethod+"&deliverymothod="+deliverymethod+"&pickuplocation="+pickuplocation+"&cost="+cost+"&quantity="+quantity+"&logintype="+logintype+"&pickupwarehouseId="+pickupwarehouseId+"&note="+note, true);
    xmlhttp.send();  

    $('#fourth').ready(function(){
      $('#step2').removeClass('selected');
      $('#step4').addClass('selected');
     });
}


function loader5(){
  // $("#loader5").css(display: block;).fadeIn('slow').delay(5000).fadeOut('slow');
  // jQuery(loader5).fadeIn('slow').css("display","block");
  jQuery("#loader5").show();
  // jQuery("#loader5").delay(4000).hide();
  setTimeout( "$('#loader5').hide();", 8000);
}

function loader10(){
  // $("#loader5").css(display: block;).fadeIn('slow').delay(5000).fadeOut('slow');
  // jQuery(loader5).fadeIn('slow').css("display","block");
  jQuery("#loader10").show();
  // jQuery("#loader5").delay(4000).hide();
  setTimeout( "$('#loader5').hide();", 10000);
}
