$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    colorStatus();
});


function colorStatus() {
    var status = $('.status').text();
    if (status == 'Indisponivel') {
        $('.status').css('color', 'red');
    }
}