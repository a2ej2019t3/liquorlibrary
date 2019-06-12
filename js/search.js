// search function (Ajax - search.php)

document.getElementById("searchbox").onkeyup = function () {
    var val = document.getElementById("searchbox").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                    console.log(xmlhttp);
                    var res = xmlhttp.response;
                    var resText = xmlhttp.responseText;
                    document.getElementById("dropdownarea").innerHTML = resText;
                if (resText == 0) {
                    document.getElementById("dropdownarea").style.display = "none";
                } else {
                    document.getElementById("dropdownarea").style.display = "inline-block";
                }
            }
        };
        xmlhttp.open("GET", "./search/search.php?sc="+val, true);
        xmlhttp.send();
};

// Login AJAX
document.getElementById("loginSubmit").onclick = function () {
    var xmlhttp = new XMLHttpRequest();
    var email = document.getElementsByName("email")[0].value;
    var password = document.getElementsByName("password")[0].value;
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xmlhttp);
            if(xmlhttp.responseText == 1){
                alert("User name is not exist");
            } else if (xmlhttp.responseText == 0) {
                alert("Wrong password");
            } else if (xmlhttp.responseText == 3){
                document.location.reload(true);
                sessionStorage.setItem('status','loggedIn'); 
            }
        }
    };
    xmlhttp.open("GET", "./signInUp/process_get_user.php?email="+email+"&password="+password, true);
    // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();
}

document.getElementById("logoutButton").onclick = function () {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xmlhttp);
            if(xmlhttp.responseText == 1){
                document.location.reload(true);
            }
        }
    };
    xmlhttp.open("GET", "./signInUp/logout.php", true);
    // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();
}

$(document).ready(function(){
    // Set trigger and container variables
    var trigger = $('.sortselect');        
    // Fire on click
    trigger.on('click', function(){
      // Set $this for re-use. Set target from data attribute
        var $this = $(this),
        val = $this.find(':selected').val();       
        // var val = document.getElementById("pricelow").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                if(xmlhttp.responseText == 1){
                    // document.location.reload(true);
                   
                }
            }
        };
        xmlhttp.open("GET", "./pricesort.php?sc="+val, true);
        xmlhttp.send();
      
      return false;
    });
  });

