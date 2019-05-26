window.onload = getItems;

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
                // document.getElementById("debug").innerHTML = xmlhttp.responseText;
            }
        };
    xmlhttp.open("GET", "Cart/getItems.php", true);
    xmlhttp.send();
}

function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
  }
  
  /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
  function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
  }