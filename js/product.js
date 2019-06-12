var pricesortDropdown = document.getElementById('pricesortDropdown'),
    fileName = '',
    onloadfileName = 'categorysearch.php',
    jsonObject = {
        searchPara: '',
        onloadPara: '',
        location: ''
    };

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
};

window.onpopstate = function () {
    var state = history.state;
    if (state) {
        showProduct(state);
        console.log(state);
    }
};

addLoadEvent(onLoadCheck);
function onLoadCheck () {
    // console.log(history.state);
    var search = window.location.search,
        searchParas = new URLSearchParams(search),
        locationPara = searchParas.get('location');
        checkLocationPara(locationPara);
    updateObj(search, locationPara);
    history.replaceState(jsonObject, null, jsonObject.onloadPara);
    // alert('onload function');
    showProductAjax(jsonObject);
};

function updateObj (search, location) {
    jsonObject.searchPara = fileName + search;
    jsonObject.onloadPara = onloadfileName + search;
    jsonObject.location = location;
};

function showProductAjax (Obj) {
    if (Obj === null) {
        var object = jsonObject;
    } else if (typeof Obj === 'object') {
        var object = Obj;
    } else {
        var object = JSON.parse(Obj);
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("productArea").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", object.searchPara, true);
    xmlhttp.send();
}

function showProduct (Json) {
    // convert json into object
    if (typeof Json === 'object') {
        var parajsonObject = Json;
    } else {
        var parajsonObject = JSON.parse(Json);
    }
    // extract info from parajsonObject
    var locationPara = parajsonObject.location,
        searchPara = parajsonObject.searchPara,
        search = searchPara.split('.php');
    if (search.length == 1) {
        search = search[0];
    } else {
        search = search[1];
    }
    // get page location
    checkLocationPara(locationPara);

    // update jsonObject
    updateObj(search, locationPara);
    // jsonObject.searchPara = fileName + search;
    // jsonObject.onloadPara = onloadfileName + search;
    // jsonObject.location = locationPara;

    showProductAjax(jsonObject);
    pushHistoryState();
}

function pushHistoryState () {
    // console.log(history.state);
    if (history.state.searchPara) {
        var historyState = history.state.onloadPara;
    } else {
        var historyState = "";
    }
    if (jsonObject.onloadPara != historyState) {
        history.pushState(jsonObject, null, jsonObject.onloadPara);
        // alert('pushState executed');
    } else {
        // alert('pushState did not execute');
    }
    // console.log(history.state);
}

function checkLocationPara (locationPara) {
    switch (locationPara) {
        case 'category':
            fileName = 'partials/discountrate.php',
            // onloadfileName = 'categorysearch.php';
            pricesortDropdown.style.display = "none";
            break;
        case 'brandlist':
            fileName = 'brandlist.php',
            // onloadfileName = 'categorysearch.php';
            pricesortDropdown.style.display = "none";
            break;
        case 'brandproduct':
            fileName = 'partials/discountrate.php';
            // onloadfileName = 'categorysearch.php';
            pricesortDropdown.style.display = "none";
            break;
        case 'salelist':
            document.getElementById('selectsort').selectedIndex = 0;
            fileName = 'partials/onsalelist.php';
            // onloadfileName = 'categorysearch.php';
            pricesortDropdown.style.display = "block";
            break;
        default:
            alert("can't identify the page");
            break;
    }
};

function checkIfSelected () {
    var obj = document.getElementById('selectsort');
    var condition;
    if (condition = obj.options[obj.selectedIndex].getAttribute('value')) {
        var Json = {
            searchPara: 'partials/saleproductprint.php?condition=' + condition + '&location=salelist'
        }
    } else {
        var filename = obj.options[obj.selectedIndex].getAttribute('data-target');
        if (filename == 'discountrate') {
            var Json = {
                searchPara: 'partials/' + filename + '?location=salelist&p=dc'
            }
        }
    }
    showProductAjax(Json);
};


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

// function selectBrand (brandlistJson) {
//     if (typeof brandlistJson === 'object') {
//         brandlistObject = brandlistJson;
//     } else {
//         brandlistObject = JSON.parse(brandlistJson);
//     }
//     bid = brandlistObject.brandName;
//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function () {
//         if (this.readyState == 4 && this.status == 200) {
//                 // console.log(xmlhttp);
//                 document.getElementById("productArea").innerHTML = xmlhttp.responseText;
//             }
//         };
//     xmlhttp.open("GET", "partials/saleproductprint.php?brandname=" + bid, true);
//     xmlhttp.send();
//     history.pushState({
//         location: 'product_brand',
//         brandName: bid
//     }, "", "?brandname=" + bid);
//     // console.log(history.state);
// }