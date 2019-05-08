// search function (Ajax - search.php)

document.getElementById("searchbox").onkeyup = function () {
    var val = document.getElementById("searchbox").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                    console.log(xmlhttp);
                    var res = xmlhttp.response;
                    var resText = xmlhttp.responseText;
                    document.getElementById("dropdownarea").innerHTML = res;
                if (resText == "    false") {
                    document.getElementById("dropdownarea").style.display = "none";
                } else {
                    document.getElementById("dropdownarea").style.display = "block";
                }
            }
        };
        xmlhttp.open("GET", "search.php?sc="+val, true);
        xmlhttp.send();
};