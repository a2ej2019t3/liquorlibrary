function addLoadEvent(func) {
    var oldonload = window.onload;
    if (typeof window.onload != 'function') {
        window.onload = func;
    } else {
        window.onload = function () {
            if (oldonload) {
                oldonload();
            }
            func();
        }
    }
};

function openLoginModal () {
    alert('Please login');
    $('#myModal').modal();
}

$(window).scroll(function () {
    if ($(this).scrollTop() > 80)  /*height in pixels when the navbar becomes non opaque*/ {
        $('.opaque-navbar').addClass('opaque');
    } else {
        $('.opaque-navbar').removeClass('opaque');
    }
});

$(window).scroll(function () {
    if ($(this).scrollTop() > 80)  /*height in pixels when the navbar becomes non opaque*/ {
        $('.aboutmain').addClass('opaque');
    } else {
        $('.fourth-text').removeClass('opaque');
    }
});

// modal js+ jquery
$("#b2").hover(function () {
    $('#searchModal').modal({
        show: true
    })
});

$('#myModal').on('shown.bs.modal', function () {
    $(document).off('focusin.modal');
});

$("#ourdrinks").hover(function () {
    $('#subnav').modal({
        show: true
    })
});

// tab link js

function openCity(id) {
    var i, tabcontent, tablinks;
    var cityName = document.getElementById(id).value;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("buttonIndex_0").click();




// images sliders js
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) { myIndex = 1 }
    x[myIndex - 1].style.display = "block";
    setTimeout(carousel, 3000); // Change image every 3 seconds
}

// find us js
function openLocation() {
    document.getElementById("myOverlay").style.display = "block";
}

function closeLocation() {
    document.getElementById("myOverlay").style.display = "none";
}
// page transition
window.transitionToPage = function (href) {
    document.querySelector('body').style.opacity = 0
    setTimeout(function () {
        window.location.href = href
    }, 500)
}

document.addEventListener('DOMContentLoaded', function (event) {
    document.querySelector('body').style.opacity = 1
})

$(document).ready(function () {
    $('body').show();
});

function addLoadEvent(func) {
    var oldonload = window.onload;
    if (typeof window.onload != 'function') {
        window.onload = func;
    } else {
        window.onload = function () {
            if (oldonload) {
                oldonload();
            }
            func();
        }
    }
};

addLoadEvent(function () {
    document.getElementsByName("typeID")[0].value = 1;
})
// show register from for different user type
document.getElementById("businessOptionLable").onclick = function () {
    document.getElementById("forBusiness").style.display = "";
    document.getElementById("company_name").value = "";
    document.getElementsByName("typeID")[0].value = 1;
}
document.getElementById("individualOptionLable").onclick = function () {
    document.getElementById("forBusiness").style.display = "none";
    document.getElementsByName("typeID")[0].value = 3;
}

function getBusinessType(obj) {
    var id = obj.options[obj.selectedIndex].getAttribute('value');
    document.getElementsByName("typeID")[0].value = id;
}

// shopping cart AJAX
document.getElementById("addToCart").onclick = function () {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xmlhttp);
            // <!-- 0 = not login; 1 = item exist; 2 = item added -->
            if (xmlhttp.responseText == 0) {
                document.getElementById("myModal").modal('show');
            } else if (xmlhttp.responseText == 1) {
                document.getElementById("cart").modal('show');
            } else if (xmlhttp.responseText == 2) {
                var getItems = new XMLHttpRequest();
                getItems.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(getItems);

                    }
                };
                getItems.open("GET", "./Cart/addToCart.php", true);
                getItems.send();
            }
        }
    };
    xmlhttp.open("GET", "./Cart/addToCart.php", true);
    // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();
}




//   brnachemail orderid js

function branchorderid() {
    var idlocation = document.getElementById("branchemailbutton");
    var orderid = idlocation.value;

    var hiddenorderid = document.getElementById('questionorder');
    hiddenorderid.setAttribute('value', orderid);
}
function confirmcancel() {

    if (confirm("Are you sure you want to cancel this backorder?")) {

        cancellatest();
        var canbtn = document.getElementById("cancelbuttonlatest")
        var json = canbtn.getAttribute('value');
        var obj = JSON.parse(json);
        var orderid = obj.orderID;
        var buyerid = obj.buyerID;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                if (xmlhttp.responseText == 1) {
                    alert('Now the order is cancelled');
                }
                else if (xmlhttp.responseText == 2) {
                    alert('System failed to cancel this order.');
                }

                window.location.reload();
            }
        };
        xmlhttp.open("GET", "partials/backordercancel.php?id=" + orderid + "&buyerid=" + buyerid, true);
        xmlhttp.send();

    }
    else {

    }
}
function cancellatest() {

    var spinner = '#spinnerlatest';
    var cancelsign = '#cancelsignlatest';
    $(spinner).css("display", "block");
    $(cancelsign).css("display", "none");
    // setTimeout( "$('#spinner').css('display','none');", 8000);
    window.setTimeout(function () {
        $(spinner).css('display', 'none');
        $(cancelsign).css("display", "block");
    }, 5000);

}


function updateorder(elem) {

    var id = $(elem).attr("data-id");

    var spinner = '#spinner' + id;
    var readysign = '#readysign' + id;

    $(spinner).css("display", "block");
    $(readysign).css("display", "none");
    // setTimeout( "$('#spinner').css('display','none');", 8000);
    window.setTimeout(function () {
        $(spinner).css('display', 'none');
        $(readysign).css("display", "block");
    }, 5000);


}

function completeorder(elem) {

    var id = $(elem).attr("data-id");

    var spinner = '#completespinner' + id;
    var readysign = '#completereadysign' + id;

    $(spinner).css("display", "block");
    $(readysign).css("display", "none");
    // setTimeout( "$('#spinner').css('display','none');", 8000);
    window.setTimeout(function () {
        $(spinner).css('display', 'none');
        $(readysign).css("display", "block");
    }, 5000);
}


function cancelorder(elem) {


    if (confirm("Are you sure you want to cancel this order?")) {
        var id = $(elem).attr("data-id");
        var spinner = '#cancelspinner' + id;
        var readysign = '#cancelsign' + id;

        $(spinner).css("display", "block");
        $(readysign).css("display", "none");
        // setTimeout( "$('#spinner').css('display','none');", 8000);
        window.setTimeout(function () {
            $(spinner).css('display', 'none');
            $(readysign).css("display", "block");
        }, 5000);

        // update database
        var buttonId = "cancelbutton" + id;
        var canbtn = document.getElementById(buttonId);
        var json = canbtn.getAttribute('value');
        var obj = JSON.parse(json);
        var orderid = obj.orderID;
        var buyerid = obj.buyerID;
        // alert(orderid);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                if (xmlhttp.responseText == 1) {
                    alert('Now the order is cancelled');
                }
                else if (xmlhttp.responseText == 2) {
                    alert('System failed to cancel this order.');
                }

                window.location.reload();
            }
        };
        xmlhttp.open("GET", "partials/backordercancel.php?id=" + orderid + "&buyerid=" + buyerid, true);
        xmlhttp.send();

    }
    else {

    }
}

function readypickup(json) {

    var obj = JSON.parse(json);
    var orderid = obj.orderID;
    var buyerid = obj.buyerID;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xmlhttp);
            if (xmlhttp.responseText == 1) {
                alert('Now the order is ready and system sent an notification email to this customer.');
            }
            else if (xmlhttp.responseText == 2) {
                alert('We failed to send an email to customer.');
            }

            window.location.reload();
        }
    };
    xmlhttp.open("GET", "partials/pickupready.php?id=" + orderid + "&buyerid=" + buyerid, true);
    xmlhttp.send();
}

function shippingbackorder(json){
    var obj = JSON.parse(json);
    var orderid = obj.orderID;
    var buyerid = obj.buyerID;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xmlhttp);
            if (xmlhttp.responseText == 1) {
                alert('Now the order is shipping and system sent an notification email.');
            }
            else if (xmlhttp.responseText == 2) {
                alert('We failed to send an email to the branch.');
            }

            window.location.reload();
        }
    };
    xmlhttp.open("GET", "partials/shippingorder.php?id=" + orderid + "&buyerid=" + buyerid, true);
    xmlhttp.send();
}
function completepickup(json) {

    var obj = JSON.parse(json);
    var orderid = obj.orderID;
    var buyerid = obj.buyerID;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xmlhttp);
            if (xmlhttp.responseText == 1) {
                alert('This order has been completed, Thank you!');
            }
            else if (xmlhttp.responseText == 2) {
                alert('We failed to send an email to customer.');
            }

            window.location.reload();
        }
    };
    xmlhttp.open("GET", "partials/completepickup.php?id=" + orderid + "&buyerid=" + buyerid, true);
    xmlhttp.send();
}

function completebackorder(json){
    var obj = JSON.parse(json);
    var orderid = obj.orderID;
    var buyerid = obj.buyerID;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xmlhttp);
            if (xmlhttp.responseText == 1) {
                alert('This order has been completed, Thank you!');
            }
            else if (xmlhttp.responseText == 2) {
                alert('We failed to send an email to this branch.');
            }

            window.location.reload();
        }
    };
    xmlhttp.open("GET", "partials/completebackorder.php?id=" + orderid + "&buyerid=" + buyerid, true);
    xmlhttp.send();
}
function openEmailModal(json) {
    var obj = JSON.parse(json);
    var orderid = obj.orderID;
    var buyerid = obj.buyerID;

    $('#branch_customeremail').modal('show');
    $('#questionorder').attr('value', orderid);
    $('#buyerid').attr('value', buyerid);
}
function sendspin() {

    var spinner = '#sendspinner';
    var sign = '#sendsign';

    $(spinner).css("display", "block");
    $(sign).css("display", "none");
    // setTimeout( "$('#spinner').css('display','none');", 8000);
    window.setTimeout(function () {
        $(spinner).css('display', 'none');
        $(sign).css("display", "block");
    }, 5000);
}

