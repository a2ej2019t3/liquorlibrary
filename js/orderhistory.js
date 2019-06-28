$(function () {
    $('#toast_wrapper').css('display','block');
    setTimeout(function () {
        $('.toast').toast('show');
    }, 1000);
    showMessage();
    $('.homeBtn').on('click', function () {
        loadHome();
    });
    goToOrder();
});
addLoadEvent(loadHome);
// addLoadEvent(showToasts);
// addLoadEvent(loadOrders);
function loadOrders(index = "all", keyword = "orderID", sort = "asc", operation = "filt", gto = null) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xmlhttp);
            document.getElementById('container').innerHTML = xmlhttp.response;
            loadDetails();
            $('.orderCollapse').on('shown.bs.collapse', function () {
                // $(this)[0].scrollIntoView();
                var offset = $(this).offset();
                offset.top -= 300;
                $('html, body').animate({
                    scrollTop: offset.top
                })
            })
            if (gto !== null) {
                var element = '#coid'+gto;
                $(element).collapse('show');
            }
        }
    }
    xmlhttp.open("GET", "orderHistoryOrder.php?si=" + index + "&key=" + keyword + "&sort=" + sort + "&op=" + operation, true);
    xmlhttp.send();
}

function showMessage () {
    $('.orderBadge').on('click', function () {
        $('.toast').toast('show');
    })
}

function goToOrder () {
    $('.goToOrder,.toastCheck').on('click', function () {
        var orderID = $(this).data('oid');
        loadCtrls();
        loadOrders(undefined,undefined,undefined,undefined,orderID);
    })
}

function loadHome () {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xmlhttp);
            document.getElementById('content_wrapper').innerHTML = xmlhttp.response;
            showMessage();
            getItems();
            goToOrder();
        }
    }
    xmlhttp.open("GET", "personalHome.php", true);
    xmlhttp.send();
}

function selectChecking(i) {
    var index = i;
    if (document.getElementById('historyCtrls') == null) {
        loadCtrls();
        loadOrders(index);
    } else {
        loadOrders(index);
    }
}

function loadDetails() {
    $('.orderCollapse').on('show.bs.collapse', function () {
        var obj = $(this);
        var orderid = obj.siblings('.orders').data("orderid");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                obj.children('div').html(xmlhttp.response);
                reorder();
            }
        }
        xmlhttp.open("GET", "orderHistoryDetail.php?oi=" + orderid, true);
        xmlhttp.send();
    });
};

function changesort() {
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
};

function loadCtrls() {
    if (document.getElementById('historyCtrls') == null) {
        var xmlhttp  = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                document.getElementById('content_wrapper').innerHTML = xmlhttp.response;
                changesort();
            }
        }
        xmlhttp.open("GET", "orderhistoryCtrl.php", true);
    xmlhttp.send();
    } else {
        loadOrders();
    }
}

function reorder () {
    $('.reorderBtn').on('click', function () {
       var roid =  $(this).data('roid');
       getItems(roid);
       window.location.replace("paymentprocess.php");
    })
}