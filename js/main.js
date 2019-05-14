
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

$("#ourdrinks").hover(function () {
  $('#subnav').modal({
      show: true,
      backdrop: false
  })
});

// tab link js

function openCity(id) {
    var i, tabcontent, tablinks;
    var cityName = document.getElementById(id).value;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }
  
  // Get the element with id="defaultOpen" and click on it
        document.getElementById("buttonIndex_0").click();




// images sliders js
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 3000); // Change image every 3 seconds
}

// find us js
function openLocation() {
    document.getElementById("myOverlay").style.display = "block";
  }
  
  function closeLocation() {
    document.getElementById("myOverlay").style.display = "none";
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
 
 $('.cartbutton').click(function() {
  $('.modal')
      .prop('class', 'modal fade') // revert to default
      .addClass( $(this).data('direction') );
  $('.modal').modal('show');
});