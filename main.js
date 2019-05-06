
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
  setTimeout(carousel, 3000); // Change image every 2 seconds
}


// search function (Ajax - search.php)

document.getElementById("searchbox").onkeyup = function () {
    var val = document.getElementById("searchbox").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xmlhttp);
            document.getElementById("dropdownarea").innerHTML = xmlhttp.response;
        }
    };
    xmlhttp.open("GET", "search.php?sc="+val, true);
    xmlhttp.send();
}