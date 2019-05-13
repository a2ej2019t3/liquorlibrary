
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


// show register from for different user type
document.getElementById("businessOptionLable").onclick = function () {
    document.getElementById("forBusiness").style.display = "";
    document.getElementById("company_name").value = "";
}
document.getElementById("individualOptionLable").onclick = function () {
    document.getElementById("forBusiness").style.display = "none";
    document.getElementsByName("typeID")[0].value = 3;
}

function getBusinessType (id) {
    document.getElementsByName("typeID")[0].value = id;
}

