
var CaclulateCostTotal = function(data) {
    // var $this = $(this);
    var id= $(data).data('attribute');
    // var id= $this.data('attribute');
    // $('p.listprice['+id+']').append(id);
            // alert(cost);   
       
    $('tr.items').each(function( ) {           
            var cost= document.getElementById('ticket_price['+id+']').getAttribute('data-value');
            var quant= document.getElementById('quantity['+id+']').value;
            c = parseFloat(cost),
            q = parseInt(quant, 10),
            total = c * q || 0;

        document.getElementById('total['+id+']').innerHTML = 'NZ $'+total+'';
        // $('#total['+id+']').html(total);
        // $('#total['+id+']').data('value') =total;
        $('#total['+id+']').$(data).attr('data-value', total);
    });
};

var totalSum =function(data) {
    var id= $(data).data('attribute');
    $('tr.items').each(function( ) {           
        var prevtotal= document.getElementById('prevtotal['+id+']').getAttribute('data-value');
        var newtotal= document.getElementById('total['+id+']').value;
        prevtotal = parseFloat(prevtotal),
        newtotal = parseFloat(newtotal),
        change = newtotal - prevtotal || 0;
        alert(change);
    document.getElementById('total['+id+']').innerHTML = 'NZ $'+total+'';
   

});
};