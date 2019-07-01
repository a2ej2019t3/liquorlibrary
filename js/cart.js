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
  }

function addToCart (obj) {
    var id = obj.getAttribute('data-productID');
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                // alert(xmlhttp.responseText);
                if (xmlhttp.responseText == 1 || xmlhttp.responseText == 3) {
                    showCart();
                    $('#stickyCart').css('display', 'block');
                    $('#stickyCart').addClass('showCart');
                } else {
                    // document.getElementById('productArea').innerHTML = xmlhttp.response;
                    // alert(xmlhttp.response);
                    getItems();
                    showCart();
                }
            }
        };
    xmlhttp.open("GET", "./Cart/addToCart.php?i="+id, true);
    xmlhttp.send();
}

function showCart () {
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log('showCart function');
                console.log(xmlhttp);
                document.getElementById("showItems").innerHTML = xmlhttp.responseText;
                finalPrice();
            }
        };
    xmlhttp.open("GET", "./Cart/showCart.php", true);
    xmlhttp.send();
}

function getItems (roid = 'Na') {
    if (roid == 'Na') {
        var url = "Cart/getItems.php";
    } else {
        var url = "Cart/getItems.php?roid=" + roid;
    }
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log('getItem function:');
                console.log(xmlhttp);
                showCart();
                // document.getElementById('content_wrapper').innerHTML = xmlhttp.response;
                // document.getElementById("debug").innerHTML = xmlhttp.responseText;
            }
        };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function removeItem (json, opt = 'spec') {
    if (opt == 'all') {
        if (json == 'loggedIn') {
            var orderID = 'loggedIn',
            productID = null,
            opt = 'all';
        } else if (json == 'guest') {
            var orderID = 'guest',
            productID = null,
            opt = 'all';
        }
    } else if (opt == 'spec') {
        var obj = JSON.parse(json);
        if (obj.orderID == 'guest') {
            var orderID = 'guest',
            productID = obj.productID,
            opt = 'spec';
        } else {
            var orderID = obj.orderID,
            productID = obj.productID,
            opt = 'spec';
        }
    }
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log('remove function:')
                console.log(xmlhttp);
                if (xmlhttp.response == 1) {
                    getItems();
                    showCart();
                }
                // document.getElementById("debug").innerHTML = xmlhttp.responseText;
            }
        };
    xmlhttp.open("GET", "Cart/removeItem.php?oi=" + orderID + "&pi=" + productID + "&opt=" + opt, true);
    xmlhttp.send();
}

function quantityCtrl (id, obj) {
    if (obj !== null) {
        var quantity = parseInt(document.getElementById('quantity['+id+']').value);
        var orderid = obj.getAttribute('data-orderid');
        var operation = obj.getAttribute('data-operation');
        if (operation == 'd') {
            if (quantity > 1) {
                quantity -= 1;
                document.getElementById('quantity['+id+']').value = quantity;
            }
        } else if (operation == 'i') {
            quantity += 1;
            document.getElementById('quantity['+id+']').value = quantity;
        }
        CaclulateCostTotal(id);
        var str = document.getElementById('total['+id+']').innerHTML;
        var arr = str.split('$');
        var updatetotal = parseInt(arr[1]);
        if (orderid == 'Na') {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(xmlhttp);
                        // alert(xmlhttp.response);
                    // document.getElementById("debug").innerHTML = xmlhttp.responseText;
                }
            };
            xmlhttp.open("GET", "./Cart/addToCart.php?i="+id+"&q="+quantity+"&t="+updatetotal, true);
            xmlhttp.send();
        } else {
            quantityUpdateToDB(id, orderid, quantity, updatetotal);
        }
    }
}