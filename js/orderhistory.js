$(document).ready(function () {
    // Set trigger and container variables
    var trigger = $('.sortselecttest');
    // container = $('#contain');

    // Fire on click
    trigger.on('click', function () {
        // Set $this for re-use. Set target from data attribute
        var $this = $(this),
            target = $this.find(':selected').attr('value');
        console.log(target);
        // Load target page into container
        $('#contain').load(target + '.php');
        // Stop normal link behavior
        return false;
    });
});

