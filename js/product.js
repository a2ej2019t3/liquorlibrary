window.onload = checkState;

function showCategoryProduct (productInfoJson) {
    cid = productInfoJson.categoryID;
    cNa = productInfoJson.categoryName;
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                document.getElementById("type_content").innerHTML = xmlhttp.responseText;
            }
        };
    xmlhttp.open("GET", "typesearch.php?searchcategoryID=" + cid + "&searchcategoryName=" + cNa, true);
    xmlhttp.send();
    history.pushState({
        categoryID: cid,
        categoryName: cNa
    }, null, "?searchcategoryID=" + cid + "&searchcategoryName=" + cNa);
}

function checkState () {
    var state = document.state;
    if (state) {
        if (state.categoryID) {
            showCategoryProduct(state);
        }
    }
}