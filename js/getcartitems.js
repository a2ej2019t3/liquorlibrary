// show shopping cart AJAX
window.onload = function () {
    var cl = new XMLHttpRequest();
    cl.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(cl);
        document.getElementById("showItems").innerHTML = cl.responseText;
      }
    };
    cl.open("GET", "./Cart/getItems.php", true);
    cl.send();
  }