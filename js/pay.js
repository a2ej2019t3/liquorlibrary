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

}

var totalSum =function(data) {
    var id= $(data).data('attribute');
    $('tr.items').each(function( ) {    
        
        var previousval =document.getElementById('prevtotal['+id+']').value;
        var changedvalue =document.getElementById('initialtotal['+id+']').value;
        
        previousval = parseFloat(previousval),
        changedvalue = parseFloat(newtochangedvaluetal),
        change = changedvalue - previousval || 0;
        alert(change);


});
};