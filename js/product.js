window.onpopstate = checkState;

function showCategoryProduct (productInfoJson) {
    if (typeof productInfoJson === 'object') {
        productInfoObject = productInfoJson;
    } else {
        productInfoObject = JSON.parse(productInfoJson);
    }
    cid = productInfoObject.categoryID;
    cNa = productInfoObject.categoryName;
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                document.getElementById("productArea").innerHTML = xmlhttp.responseText;
            }
        };
    xmlhttp.open("GET", "typesearch.php?searchcategoryID=" + cid + "&searchcategoryName=" + cNa, true);
    xmlhttp.send();
    history.pushState({
        location: 'category',
        categoryID: cid,
        categoryName: cNa
    }, null, "categorysearch.php?searchcategoryID=" + cid + "&searchcategoryName=" + cNa);
    console.log(history.state);
}

function getBrandlist () {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                document.getElementById("productArea").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "brandlist.php", true);
    xmlhttp.send();
    history.pushState({
        location: 'brandlist'
    }, null, "?l=brandlist");
    console.log(history.state);
}

function selectBrand (brandlistJson) {
    if (typeof brandlistJson === 'object') {
        brandlistObject = brandlistJson;
    } else {
        brandlistObject = JSON.parse(brandlistJson);
    }
    bid = brandlistObject.brandName;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                document.getElementById("productArea").innerHTML = xmlhttp.responseText;
            }
        };
    xmlhttp.open("GET", "partials/saleproductprint.php?brandname=" + bid, true);
    xmlhttp.send();
    history.pushState({
        location: 'product_brand',
        brandName: bid
    }, "", "?brandname=" + bid);
    console.log(history.state);
}

function checkState () {
    var state = history.state;
    if (state) {
        switch (state.location) {
            case 'category':
                // alert('category');
                showCategoryProduct(state);
                break;
            case 'brandlist':
                // alert('brandlist');
                getBrandlist();
                break;
            case 'product_brand':
                alert('product_brand');
                console.log(state);
                selectBrand(state);
                break;
            default:
                alert('something wrong with state.location');
                break;
        }
    }
}