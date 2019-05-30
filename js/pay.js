// function directPayment() {

//     var xmlhttp = new XMLHttpRequest();
//         xmlhttp.onreadystatechange = function () {
//             if (this.readyState == 4 && this.status == 200) {
//                 console.log(xmlhttp);
//                 document.getElementById("content").innerHTML = xmlhttp.responseText;
//             }
//         };
//     xmlhttp.open("GET", "payment/paymentprocess.php", true);
//     xmlhttp.send();
// }
// function calc(i) 
// {
//   
//   var price = document.getElementById("ticket_price").innerHTML;
//   var noTickets = document.getElementById("quantity").value;
//   var total = parseFloat(price) * noTickets
//   if (!isNaN(total))
//     document.getElementById("total").innerHTML = total
// }
// $('tr.items').each(function(i,el) {
//     var $this = $(this),
//         $cost = $this.find('[name="ticket_price\\[\\]"]'),
//         $quant = $this.find('[name="quantity\\[\\]"]'),
//         c = parseFloat($cost.val()),
//         q = parseInt($quant.val(), 10), // always use a radix
//         total = c * q || 0; // default value in case of "NaN"
//     $this.find('[name="total\\[\\]"]').val(total.toFixed(2));
// });
var CaclulateCostTotal = function(data) {
    // var index= document.getElementsByName("")
    // var $this = $(this);
    var id= $(data).data('attribute');
    // var id= $this.data('attribute');
    // $('p.listprice['+id+']').append(id);
            // alert(cost);   
       
    $('tr.items').each(function( ) {
            //   $quant=document.getElementById(id).val();
            //   $cost=document.getElementsByClassName(id).val();
            // $cost= document.getElementById('ticket_price['+id+']').val();
           
            // $quant= document.getElementById('quantity['+id+']').val();
            var cost= document.getElementById('ticket_price['+id+']').getAttribute('data-value');
            var quant= document.getElementById('quantity['+id+']').getAttribute('value');
            $('p.listprice').append(quant); 
            // $quant = $('#quantity['+id+']').val();
            // $quant = $this.find('[name="quantity['+id+']"]'),
            c = parseFloat(cost),
            q = parseInt(quant, 10),
            total = c * q || 0;
            
            $('p.listprice').append($quant);
            // $('p.listprice').append(total);
   $('#total['+id+']').val(total.toFixed(2));
//    $('p.listprice').append($total);
        // document.getElementById('total['+id+']').innerHTML = $total;
    
    });
};
