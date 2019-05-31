// show shopping cart AJAX
// window.onload = function () {
//     var cl = new XMLHttpRequest();
//         cl.onreadystatechange = function () {
//             if (this.readyState == 4 && this.status == 200) {
//               console.log(cl);
//               document.getElementById("showItems").innerHTML = cl.responseText;
//             }
//         };
//     cl.open("GET", "./Cart/getItems.php", true);
//     cl.send();
// }
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

addLoadEvent(getItems);

function addToCart (id) {
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                // alert(xmlhttp.responseText);
                if (xmlhttp.responseText == 1 || xmlhttp.responseText == 3) {
                    alert('The product is already in your cart.');
                    $('#cart').modal();
                } else {
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
                console.log(xmlhttp);
                document.getElementById("showItems").innerHTML = xmlhttp.responseText;
            }
        };
    xmlhttp.open("GET", "./Cart/showCart.php", true);
    xmlhttp.send();
}

function getItems () {
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                showCart();
                document.getElementById("debug").innerHTML = xmlhttp.responseText;
            }
        };
    xmlhttp.open("GET", "Cart/getItems.php", true);
    xmlhttp.send();
}
