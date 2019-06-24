addLoadEvent(loadOrders("all"));
function loadOrders (index = "all", keyword = "orderID", sort = "asc", operation = "filt") {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xmlhttp);
            document.getElementById('container').innerHTML = xmlhttp.response;
            loadDetails();
        }
    }
    xmlhttp.open("GET", "orderHistoryOrder.php?si=" + index + "&key=" + keyword + "&sort=" + sort + "&op=" + operation, true);
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

$(function changesort (){
    $('.sorter').on('click', function () {
        var keyword = $(this).attr('data-key');
        var sort = $(this).attr('data-sort');
        loadOrders('', keyword, sort, 'sort');
        if (sort == 'asc') {
            $(this).attr('data-sort', 'des');
        } else if (sort == 'des') {
            $(this).attr('data-sort', 'asc');
        }
    });
});