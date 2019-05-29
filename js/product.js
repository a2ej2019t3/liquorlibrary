var jsonObject = {
    searchPara: '',
    onloadPara: '',
    location: ''
}

window.onpopstate = checkState;
window.onload = function () {
    console.log(history.state);
    var search = window.location.search,
        searchParas = new URLSearchParams(window.location.search),
        locationPara = searchParas.get('location');
    if (locationPara == 'category')  {
        var fileName = 'typesearch.php',
            onloadfileName = 'categorysearch.php';
    }
    jsonObject.searchPara = fileName + search;
    jsonObject.onloadPara = onloadfileName + search;
    jsonObject.location = locationPara;
    
    history.replaceState(jsonObject, null, jsonObject.onloadPara);
    // alert('onload function');
    console.log(history.state);
    // console.log(jsonObject);
    showProduct(jsonObject);
}

function showProduct (Json) {
    console.log(Json);
    console.log(history.state);
    // convert json into object
    if (typeof Json === 'object') {
        var parajsonObject = Json;
    } else {
        var parajsonObject = JSON.parse(Json);
    }
    // update object
    var locationPara = parajsonObject.location,
        searchPara = parajsonObject.searchPara,
        search = searchPara.split('.php');
        console.log(search);
    if (locationPara == 'category') {
        var fileName = 'typesearch.php',
            onloadfileName = 'categorysearch.php';
    }
    jsonObject.searchPara = fileName + search[1];
    jsonObject.onloadPara = onloadfileName + search[1];
    jsonObject.location = locationPara;
    console.log(jsonObject);
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // console.log(xmlhttp);
                document.getElementById("productArea").innerHTML = xmlhttp.responseText;
            }
        };
    xmlhttp.open("GET", searchPara, true);
    xmlhttp.send();
    pushHistoryState();
}

function pushHistoryState () {
    if (history.state.searchPara) {
        var historyState = history.state.searchPara;
    } else {
        var historyState = "";
    }
    if (jsonObject.searchPara != historyState) {
        history.pushState({
            location: jsonObject.location,
            onloadPara: jsonObject.onloadPara,
            searchPara: jsonObject.searchPara
        }, null, onloadPara);
        alert('pushState executed');
    } else {
        alert('pushState did not execute');
    }
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
                // console.log(state);
                showProduct(state);
                break;
            default:
                alert('something wrong with state.location');
                break;
        }
    }
}