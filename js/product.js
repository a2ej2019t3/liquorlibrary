var pricesortDropdown = document.getElementById('pricesortDropdown'),
    fileName = '',
    onloadfileName = 'categorysearch.php',
    jsonObject = {
        searchPara: '',
        onloadPara: '',
        location: ''
    }

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
}

window.onpopstate = function () {
    var state = history.state;
    if (state) {
        showProduct(state);
    }
};;

window.onload = function () {
    // console.log(history.state);
    var search = window.location.search,
        searchParas = new URLSearchParams(search),
        locationPara = searchParas.get('location');
        checkLocationPara(locationPara);
    jsonObject.searchPara = fileName + search;
    jsonObject.onloadPara = onloadfileName + search;
    jsonObject.location = locationPara;
    
    history.replaceState(jsonObject, null, jsonObject.onloadPara);
    // alert('onload function');
    showProduct(jsonObject);
}

function showProduct (Json) {
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
        if (search.length == 1) {
            search = search[0];
        } else {
            search = search[1];
        }
    checkLocationPara(locationPara);
    jsonObject.searchPara = fileName + search;
    jsonObject.onloadPara = onloadfileName + search;
    jsonObject.location = locationPara;
    console.log(jsonObject);
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("productArea").innerHTML = xmlhttp.responseText;
            }
        };
    xmlhttp.open("GET", jsonObject.searchPara, true);
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
        }, null, jsonObject.onloadPara);
        alert('pushState executed');
    } else {
        alert('pushState did not execute');
    }
}

function checkLocationPara (locationPara) {
    switch (locationPara) {
        case 'category':
            fileName = 'typesearch.php',
            // onloadfileName = 'categorysearch.php';
            pricesortDropdown.style.display = "none";
            break;
        case 'brandlist':
            fileName = 'brandlist.php',
            // onloadfileName = 'categorysearch.php';
            pricesortDropdown.style.display = "none";
            break;
        case 'brandproduct':
            fileName = 'partials/saleproductprint.php';
            // onloadfileName = 'categorysearch.php';
            pricesortDropdown.style.display = "none";
            break;
        case 'salelist':
            if (checkIfSelected().condition)
            fileName = 'partials/' + checkIfSelected() + '.php';
            // onloadfileName = 'categorysearch.php';
            pricesortDropdown.style.display = "block";
            break;
        default:
            alert("can't identify the page");
            break;
}
}

function checkIfSelected () {
    var obj = document.getElementById('selectsort');
    var targetObj = {
        target: '',
        condition: ''
        };
    if (obj.options[obj.selectedIndex].getAttribute('data-target')) {
        targetObj.target = obj.options[obj.selectedIndex].getAttribute('data-target');
        if (obj.options[obj.selectedIndex].getAttribute('value')) {
            targetObj.condition = obj.options[obj.selectedIndex].getAttribute('value');
            return targetObj;
        }
        return targetObj;
    }
};

function checkChange () {
    var Json = {
        searchPara: '?location=salelist',
        location: 'salelist'
    }
    showProduct(Json);
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