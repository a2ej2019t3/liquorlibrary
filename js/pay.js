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