function directPayment() {

    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                document.getElementById("content").innerHTML = xmlhttp.responseText;
            }
        };
    xmlhttp.open("GET", "payment/paymentprocess.php", true);
    xmlhttp.send();
}
// $(document).on('click', '.set-quantity', function(){
//     var current_value = $('#quantity').val() > 0 ? $('#quantity').val() : 0

//     if($(this).hasClass('increase')){
//       var new_value = ++current_value
//     }

//     if($(this).hasClass('decrease')){
//       var new_value = current_value == 0 ? 0 : --current_value
//     }

//     console.log(new_value)
//     $('#quantity').val(new_value)  
//     return false;
// })
