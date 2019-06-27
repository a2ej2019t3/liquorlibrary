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
    xmlhttp.open("GET", "./search/search.php?sc=" + val, true);
    xmlhttp.send();
};

// Login AJAX
document.getElementById("loginSubmit").onclick = function () {
    var xmlhttp = new XMLHttpRequest();
    var email = document.getElementsByName("email")[0].value;
    var password = document.getElementsByName("password")[0].value;
    var classname = jQuery('.userlogin');
    if (classname.hasClass('adminlogin')) {
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                if (xmlhttp.responseText == 1) {
                    alert("Invalid admin information");
                } else if (xmlhttp.responseText == 0) {
                    alert("Invalid admin information");
                } else if (xmlhttp.responseText == 3) {
                    document.location.reload(true);
                    sessionStorage.setItem('status', 'loggedIn');
                    alert('Welcome Admin');
                }
            }
        };
        xmlhttp.open("GET", "./signInUp/process_get_admin.php?email=" + email + "&password=" + password, true);
        // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send();
    }
    else if (classname.hasClass('branchlogin')) {
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                if (xmlhttp.responseText == 1) {
                    alert("Invalid login information");
                } else if (xmlhttp.responseText == 0) {
                    alert("Invalid password information");
                } else if (xmlhttp.responseText == 3) {
                    document.location.reload(true);
                    sessionStorage.setItem('status', 'loggedIn');
                    alert('Welcome, you are successfully logged in.');

                }
            }
        };
        xmlhttp.open("GET", "./signInUp/process_get_branch.php?email=" + email + "&password=" + password, true);
        // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send();
    }
    else {
        // user login
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                if (xmlhttp.responseText == 1) {
                    alert("User name is not exist");
                } else if (xmlhttp.responseText == 0) {
                    alert("Wrong password");
                } else if (xmlhttp.responseText == 3) {
                    document.location.reload(true);
                    sessionStorage.setItem('status', 'loggedIn');
                }
            }
        };
        xmlhttp.open("GET", "./signInUp/process_get_user.php?email=" + email + "&password=" + password, true);
        // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send();
    }

}

document.getElementById("logoutButton").onclick = function () {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xmlhttp);
            if (xmlhttp.responseText == 1) {
                document.location.reload(true);
            }
        }
    };
    xmlhttp.open("GET", "./signInUp/logout.php", true);
    // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();
}
// modal admin login& branch login js

function adminmode() {
    if (jQuery('.userlogin').hasClass('branchlogin')) {
        jQuery('.userlogin').removeClass('branchlogin');
        jQuery('.userlogin').toggleClass('adminlogin');
        if (jQuery('.userlogin').hasClass('adminlogin')) {
            jQuery('.logbutton').attr('id', 'adminlogbutton');
        }
        else {
            jQuery('.logbutton').attr('id', 'loginSubmit');
        }
    }
    else {
        jQuery('.userlogin').toggleClass('adminlogin');
        if (jQuery('.userlogin').hasClass('adminlogin')) {
            jQuery('.logbutton').attr('id', 'adminlogbutton');
        }
        else {
            jQuery('.logbutton').attr('id', 'loginSubmit');
        }
    }
}

function branchmode() {
    if (jQuery('.userlogin').hasClass('adminlogin')) {
        jQuery('.userlogin').removeClass('adminlogin');
        jQuery('.userlogin').toggleClass('branchlogin');
        if (jQuery('.userlogin').hasClass('branchlogin')) {
            jQuery('.logbutton').attr('id', 'branchlogbutton');
        }
        else {
            jQuery('.logbutton').attr('id', 'loginSubmit');
        }


    }
    else {
        jQuery('.userlogin').toggleClass('branchlogin');
        if (jQuery('.userlogin').hasClass('branchlogin')) {
            jQuery('.logbutton').attr('id', 'branchlogbutton');
        }
        else {
            jQuery('.logbutton').attr('id', 'loginSubmit');
        }
    }

}

$(document).ready(function () {
    // Set trigger and container variables
    var trigger = $('.sortselect');
    // Fire on click
    trigger.on('click', function () {
        // Set $this for re-use. Set target from data attribute
        var $this = $(this),
            val = $this.find(':selected').val();
        // var val = document.getElementById("pricelow").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                if (xmlhttp.responseText == 1) {
                    // document.location.reload(true);

                }
            }
        };
        xmlhttp.open("GET", "./pricesort.php?sc=" + val, true);
        xmlhttp.send();

        return false;
    });

    collapseShowEl();
});

function collapseShowEl() {
    $('.collapsesub').on('show.bs.collapse', function () {
        var obj = $(this);
        var orderid = obj.siblings('.orders').data("orderid");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                obj.children('div').html(xmlhttp.response);
                obj.children('div').css('display', 'block');
            }
        }
        xmlhttp.open("GET", "orderHistoryDetail.php?oi=" + orderid, true);
        xmlhttp.send();
    });
};

// report js
document.getElementById("searchinput").onkeyup = function () {
    var val = document.getElementById("searchinput").value;
    var searchtype = document.getElementById("searchinput").getAttribute('search-id');
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xmlhttp);
            var res = xmlhttp.response;

            var resText = xmlhttp.responseText;
            document.getElementById("newcontent").innerHTML = resText;
            collapseShowEl();

            var res = resText.slice(0, 2);
            if (res == 000) {
                if(searchtype=="ready"){
                $("#newcontent").load("pickuporderstatus.php #newcontent",function(responseTxt , statusTxt, xhr){
                    if(statusTxt=="success")
                    // alert("External content loaded successfully!");
                    collapseShowEl();
                })
                }
                else if(searchtype=="complete"){
                    $("#newcontent").load("pickuporderhistory.php #newcontent",function(responseTxt , statusTxt, xhr){
                        if(statusTxt=="success")
                        // alert("External content loaded successfully!");
                        collapseShowEl();
                    })
                }
             }
        }
    };
    if(searchtype=="ready"){
        xmlhttp.open("GET", "./reportsearch.php?sc=" + val, true);
        xmlhttp.send();
    }
    else if(searchtype=="complete"){
        xmlhttp.open("GET", "./reportsearchcomplete.php?sc=" + val, true);
        xmlhttp.send(); 
    }
};
