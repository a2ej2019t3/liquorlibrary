window.onpopstate = checkState;
window.onload = function () {
    var search = window.location.search,
        searchParas = new URLSearchParams(window.location.search),
        locationPara = searchParas.get('location'),
        onloadfileName = 'categorysearch.php';
    if (locationPara == 'category')  {
        var fileName = 'typesearch.php'
    }
    var jsonObject = {
        searchPara: fileName + search,
        onloadPara: onloadfileName + search,
        location: locationPara
    }
    // console.log(jsonObject);
    showProduct(jsonObject);
}

function showProduct (Json) {
    if (typeof Json === 'object') {
        var jsonObject = Json;
    } else {
        var jsonObject = JSON.parse(Json);
    }
        var searchPara = jsonObject.searchPara,
            onloadPara = jsonObject.onloadPara
    // console.log(searchPara);
    var location = jsonObject.location;
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                document.getElementById("productArea").innerHTML = xmlhttp.responseText;
            }
        };
    xmlhttp.open("GET", searchPara, true);
    xmlhttp.send();
    console.log(searchPara);
    console.log(history.state.searchPara);
    if (history.state.searchPara) {
        searchPara
    }
    if (searchPara != history.state.searchPara) {
        history.pushState({
            location: location,
            onloadPara: onloadPara,
            searchPara: searchPara
        }, null, onloadPara);
    }
    // console.log(history.state);
}

// function getBrandlist () {
//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function () {
//         if (this.readyState == 4 && this.status == 200) {
//                 console.log(xmlhttp);
//                 document.getElementById("productArea").innerHTML = xmlhttp.responseText;
//             }
//         };
//         xmlhttp.open("GET", "brandlist.php", true);
//     xmlhttp.send();
//     history.pushState({
//         location: 'brandlist'
//     }, null, "?l=brandlist");
//     console.log(history.state);
// }

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
                showProduct(state);
                break;
            case 'brandlist':
                // alert('brandlist');
                showProduct();
                break;
            case 'product_brand':
                // alert('product_brand');
                console.log(state);
                showProduct(state);
                break;
            default:
                alert('something wrong with state.location');
                break;
        }
    }
}