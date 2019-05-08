
  $(window).scroll(function() {
    if($(this).scrollTop() > 80)  /*height in pixels when the navbar becomes non opaque*/ 
    {
        $('.opaque-navbar').addClass('opaque');
    } else {
        $('.opaque-navbar').removeClass('opaque');
    }
});

$(window).scroll(function() {
    if($(this).scrollTop() > 80)  /*height in pixels when the navbar becomes non opaque*/ 
    {
        $('.aboutmain').addClass('opaque');
    } else {
        $('.fourth-text').removeClass('opaque');
    }
});

// modal js+ jquery
$("#b2").hover(function () {
    $('#modal2').modal({
        show: true,
        backdrop: false
    })
});

$('#myModal').on('shown.bs.modal', function() {
    $(document).off('focusin.modal');
});

// findus.php js
// function initMap(){
//     var location = {lat: -25.363, lng: 133.044};
//     var map = new google.maps.Map(document.getElementById("map"),{
//         zoom: 4,
//         center: location
//     });
//     var marker = new google.maps.Marker({
//         position: location,
//         map:map
//     });
// }
function fetchPage(name){
    fetch(name).then(function(response){
      response.text().then(function(text){
        document.querySelector('article').innerHTML = text;
      })
    });
  }
  if(location.hash){
    fetchPage(location.hash.substr(2));
  } else {
   //  fetchPage('welcome');
  }

// page transition
  window.transitionToPage = function(href) {
    document.querySelector('body').style.opacity = 0
    setTimeout(function() { 
        window.location.href = href
    }, 500)
}

document.addEventListener('DOMContentLoaded', function(event) {
    document.querySelector('body').style.opacity = 1
})

$( document ).ready(function() {
    $('body').show();
 });
 