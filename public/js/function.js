$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    colorStatus();
    requireCep();

});


function colorStatus() {
    var status = $('.status').text();
    if (status == 'Indisponivel') {
        $('.status').css('color', 'red');
    }
}

function requireCep() {
    $('#shippingAddressPostalCode').on('keyup', function() {
        let cep = $(this).val();

        if (cep.length == 8) {
            $.get('http://viacep.com.br/ws/' + cep + '/json/')
                .then(function(res) {
                    $('#shippingAddressDistrict').val(res.bairro);
                    $('#shippingAddressCity').val(res.localidade);
                    $('#shippingAddressStreet').val(res.logradouro);
                    $('#shippingAddressState').val(res.uf);
                })
                .catch(function(err) {
                    console.log(err);
                });

        }
    });
}