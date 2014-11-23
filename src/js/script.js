'use strict';

function post(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}

$(function() {
    resizeHeight();

    $( window ).resize(function() {
        resizeHeight();
    });

    function resizeHeight(){
        var doc_height = $( window ).height();
        $('#map_canvas').height((doc_height-80));
    }

    $('#myPlaceTextBox').keyup(function() {
        autoCompletePosition();
    });

    function autoCompletePosition(){
        var doc_height = $( window ).height();
        $('.pac-container').css('top',(doc_height-250)+'px');
    }

    // made active button with current link
    $('.btn.btn-primary').each(function(){
        if(this.href === window.location.href) {
            $(this).attr('disabled', true);
        }
    });

    $("time.timeago").timeago();
});