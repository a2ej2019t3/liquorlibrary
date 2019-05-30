var jsonObject = {
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

window.onpopstate = checkState;
window.onload = function () {
    // console.log(history.state);
    var search = window.location.search,
        searchParas = new URLSearchParams(window.location.search),
        locationPara = searchParas.get('location');
    switch (locationPara) {
        case 'category':
            var fileName = 'typesearch.php',
                onloadfileName = 'categorysearch.php';
                pricesortDropdown.style.display = "none";
            break;
        case 'brandlist':
            var fileName = 'brandlist.php',
                onloadfileName = 'categorysearch.php';
                pricesortDropdown.style.display = "none";
            break;
        case 'brandproduct':
            var fileName = 'partials/saleproductprint.php',
                onloadfileName = 'categorysearch.php';
                pricesortDropdown.style.display = "none";
            break;
        case 'salelist':
            var fileName = 'partials/onsalelist.php',
                onloadfileName = 'categorysearch.php';
                pricesortDropdown.style.display = "block";
            break;
        case 'lowprice':
            var fileName = 'partials/saleproductprint.php',
                onloadfileName = 'categorysearch.php';
                pricesortDropdown.style.display = "block";
            break;
        default:
            alert("can't identify the page");
            break;
    }
    jsonObject.searchPara = fileName + search;
    jsonObject.onloadPara = onloadfileName + search;
    jsonObject.location = locationPara;
    
    history.replaceState(jsonObject, null, jsonObject.onloadPara);
    // alert('onload function');
    // console.log(history.state);
    // console.log(jsonObject);
    showProduct(jsonObject);
}

function showProduct (Json) {
    console.log(Json);
    // console.log(history.state);
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
        console.log(search);
        var pricesortDropdown = document.getElementById('pricesortDropdown')
    switch (locationPara) {
        case 'category':
            var fileName = 'typesearch.php',
                onloadfileName = 'categorysearch.php';
                pricesortDropdown.style.display = "none";
            break;
        case 'brandlist':
            var fileName = 'brandlist.php',
                onloadfileName = 'categorysearch.php';
                pricesortDropdown.style.display = "none";
            break;
        case 'brandproduct':
            var fileName = 'partials/saleproductprint.php',
                onloadfileName = 'categorysearch.php';
                pricesortDropdown.style.display = "none";
            break;
        case 'salelist':
            var fileName = 'partials/onsalelist.php',
                onloadfileName = 'categorysearch.php';
                pricesortDropdown.style.display = "block";
            break;
        case 'lowprice':
            var fileName = 'partials/saleproductprint.php',
                onloadfileName = 'categorysearch.php';
                pricesortDropdown.style.display = "block";
            break;
        default:
            alert("can't identify the page");
            break;
    }
    jsonObject.searchPara = fileName + search;
    jsonObject.onloadPara = onloadfileName + search;
    jsonObject.location = locationPara;
    console.log(jsonObject);
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // console.log(xmlhttp);
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
                showProduct(state);
                break;
            case 'brandproduct':
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

addLoadEvent(function(){
    // Set trigger and container variables
    var trigger = $('.sortselect'),
        container = $('#productArea');
        
    // Fire on click
    trigger.on('click', function(){
      // Set $this for re-use. Set target from data attribute
    var $this = $(this),
        target = $this.find(':selected').data('target');       
        if (target == 'pricesort') {
            var psObject = {
                searchPara: '?ob=ASC&location=lowprice',
                onloadPara: '?ob=ASC&location=lowprice',
                location: 'lowprice'
            }
            showProduct(psObject);
        }
        // Stop normal link behavior
        return false;
    });
});

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