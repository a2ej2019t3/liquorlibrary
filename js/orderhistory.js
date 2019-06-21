addLoadEvent(loadOrders("all"));
function loadOrders (index = "all") {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xmlhttp);
            document.getElementById('container').innerHTML = xmlhttp.response;
            loadDetails();
        }
    }
    xmlhttp.open("GET", "orderHistoryOrder.php?si=" + index + "&key=" + keyword + "&opertaion=" + operation, true);
    xmlhttp.send();
}

function selectChecking(i) {
    var index = i;
    loadOrders(index);
}
function loadDetails () {
    $('.collapse').on('show.bs.collapse', function () {
        var obj = $(this);
        var orderid = obj.siblings('.orders').data("orderid");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                obj.children('div').html(xmlhttp.response);
            }
        }
        xmlhttp.open("GET", "orderHistoryDetail.php?oi=" + orderid, true);
        xmlhttp.send();
    });
};

$(function(){
    $('.sorter').on('click', function () {
        var keyword = $(this).data('key');
        var operation = $(this).data('operation');
        if (operation == 'asc') {
            $(this).data('operation', 'des');
        } else if (operation == 'des') {
            $(this).data('operation', 'asc');
        }
    });
})