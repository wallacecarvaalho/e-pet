@extends('principal')

@section('conteudo')
    <h2>Checkout</h2>

    <ul class="nav nav-tabs nav-justified">
        <li role="presentation" class="active"><a data-toggle="tab" href="#step1" role="tab">Suas Informações</a></li>
        <li role="presentation"><a data-toggle="tab" href="#step2" role="tab">Entrega</a></li>
        <li role="presentation"><a data-toggle="tab" href="#step3" role="tab">Pagamento</a></li>
    </ul>
    <form action="/checkout/{{ $id }}" method="post" id="form">

      {{ csrf_field() }}

        <input type="hidden" name="itemId1" value="0001">
        <input type="hidden" name="itemDescrition1" value="Produto PagSeguro1">
        <input type="hidden" name="itemAmount1" value="250.00">
        <input type="hidden" name="itemQuantity1" value="2"> 

        <div class="tab-content">
            <div class="tab-pane active" role="tabpanel" id="step1" >
                <p>Preencha suas informaçoes</p>
                <div class="form-group col-md-12">
                    <div class="row">
                         <div class="form-group col-md-12">
                            <label for="senderName">Nome Completo</label>
                            <input type="text" class="form-control" name="senderName">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="senderCPF">CPF</label>
                            <input type="text" class="form-control" name="senderCPF">
                        </div>
                         <div class="form-group col-md-6">
                            <label for="senderEmail">E-mail</label>
                            <input type="text" class="form-control" name="senderEmail">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-md-offset-3">
                            <label for="senderPhone">Telefone</label>
                            <input type="text" class="form-control" name="senderPhone">
                        </div>
                    </div>
                </div>
                            
            </div>
            <div class="tab-pane" id="step2" role="tabpanel">
                <p>Informe os Dados para Entrega</p>
                    <div class="form-group col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="shippingAddressPostalCode">Cep</label>
                                <input type="text" class="form-control" id="shippingAddressPostalCode" name="shippingAddressPostalCode">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="shippingAddressStreet">Rua</label>
                                <input type="text" class="form-control" id="shippingAddressStreet" name="shippingAddressStreet">
                            </div>
                        </div>
                         <div class="row">
                            <div class="form-group col-md-6">
                                <label for="shippingAddressNumber">N°</label>
                                <input type="text" class="form-control" name="shippingAddressNumber">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="shippingAddressComplement">Complemento</label>
                                <input type="text" class="form-control" name="shippingAddressComplement">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="shippingAddressDistrict">Bairro</label>
                                <input type="text" class="form-control" id="shippingAddressDistrict" name="shippingAddressDistrict">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="shippingAddressCity">Cidade</label>
                                <input type="text" class="form-control" id="shippingAddressCity" name="shippingAddressCity">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="shippingAddressState">Estado</label>
                                <input type="text" class="form-control" id="shippingAddressState" name="shippingAddressState">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="hidden" name="shippingCost" value="21.50">
                                <label for="shippingType">Forma de Entrega</label>
                                <select name="shippingType" id="shippingType" class="form-control">
                                    <option disabled selected>Forma de Entrega</option>
                                    <option value="1">Encomenda normal(PAC)</option>
                                    <option value="2">Sedex</option>
                                    <option value="3">Tipo de frete não especificado</option>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="tab-pane" id="step3" role="tabpanel">
                <p>Preencha os Dados para o Pagamento</p>
                    <div class="form-group col-md-12">
                        <div class="row">
                            <div class="form-group col-md-9">
                                <label for="cardNumber">Numero do Cartao</label>
                                <input type="text" id="cardNumber" class="form-control">
                                <div id="card_brad"></div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="cvv">Código de Seguração</label>
                                <input type="text" id="cvv" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="expirationMonth">Mês de Expiração</label>
                                <input type="text" id="expirationMonth" class="form-control">
                            </div>
                             <div class="form-group col-md-4">
                                <label for="expirationYear">Ano de Expiração</label>
                                <input type="text" id="expirationYear" class="form-control">
                            </div>
                             <div class="form-group col-md-4">
                                <label for="expirationYear">Numero do Cartao</label>
                                <select name="installmentQuantity"  class="form-control" id="installmentQuantity">
                                    <option disabled selected>Parcelamento</option>
                                </select>
                            </div>
                            
                            <input type="submit" class="btn btn-success" value="pagar">
                        </div>
                        
                    </div>
            </div>   
        </div>
    </form>
    <div id="payment_methods" class="text-center">
    
    </div>

@endsection

@section('script')
 <script type="text/javascript" src=
    "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js">
    </script>
<script src="/js/pagseguro.js"></script>
 <script>
          const paymentData = {
            brand: '',
            amount: '{{ $amount }}',
         }
         PagSeguroDirectPayment.setSessionId('{!! $session !!}');
                
        pagSeguro.getPaymentMethods(paymentData.amount)
        .then(function(urls){
            let html = '';
            urls.forEach(function(url){
                html += '<img src="'+url + '" class="credit_card">' 
            });

            $('#payment_methods').html(html);
        });

    $('#cardNumber ').on('keyup', function() {
        if ($(this).val().length >= 6) {
            let bin = $(this).val();
            pagSeguro.getBrand(bin)
                .then(function(res) {
                    paymentData.brand = res.result.brand.name;
                    $('#card_brad').html('<img src="'+res.url+'" >')
                })
        }
    });

    $('#form').submit(function(e) {
        e.preventDefault();
        let params = {
            cardNumber: $('#cardNumber ').val(),
            cvv: $('#cvv').val('#cvv'),
            cardNumber: $('#cardNumber').val(),
            expirationMonth: $('#expirationMonth').val(),
            expirationYear: $('#expirationYear').val(),
            brand: paymentData.brand,
        }
        console.log(params);
    });
        

</script>

@endsection
