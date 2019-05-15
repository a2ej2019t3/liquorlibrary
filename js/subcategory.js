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