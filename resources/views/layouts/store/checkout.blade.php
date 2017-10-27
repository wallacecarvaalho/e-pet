@extends('principal')

@section('conteudo')
    <h2>Checkout</h2>

    <ul class="nav nav-tabs nav-justified">
        <li role="presentation" class="active"><a data-toggle="tab" href="#step1" role="tab">Suas Informações</a></li>
        <li role="presentation"><a data-toggle="tab" href="#step2" role="tab">Entrega</a></li>
        <li role="presentation"><a data-toggle="tab" href="#step3" role="tab">Pagamento</a></li>
    </ul>
    <form action="/checkout/1" method="post" id="form">

      {{ csrf_field() }}

    
        <div class="tab-content">

            <div class="tab-pane active" role="tabpanel" id="step1" >

                <input type="hidden" name="senderHash" id="senderHash">

                <p>Preencha suas informaçoes</p>
                <div class="form-group col-md-12">
                    <div class="row">
                         <div class="form-group col-md-12">
                            <label for="senderName">Nome Completo</label>
                            <input type="text" class="form-control" id="senderName" name="senderName" value="{{Auth::user()->name}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="senderCPF">CPF</label>
                            <input type="text" class="form-control" id="senderCPF" name="senderCPF">
                        </div>
                         <div class="form-group col-md-6">
                            <label for="senderEmail">E-mail</label>
                            <input type="text" class="form-control" id="senderEmail" name="senderEmail" value="{{Auth::user()->email}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-md-offset-3">
                            <label for="senderPhone">Telefone</label>
                            <input type="text" class="form-control" id="senderPhone" name="senderPhone" value="{{Auth::user()->phone}}">
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
                                <input type="text" class="form-control" id="shippingAddressNumber" name="shippingAddressNumber">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="shippingAddressComplement">Complemento</label>
                                <input type="text" class="form-control" id="shippingAddressComplement" name="shippingAddressComplement">
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
                                <input type="hidden" name="shippingCost" id="shippingCost" value="21.50">
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
                
                <input type="hidden" name="creditCardToken" id="creditCardToken">
                <input type="hidden" name="installmentValue" id="installmentValue">

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
                                <select name="installmentQuantity"  class="form-control parcelamento-opt" id="installmentQuantity">
                                    <option disabled selected>Parcelamento</option>
                                </select>
                                
                            </div>
                            <p>Dados do dono do cartão</p>
                                <p>
                                    <input type="checkbox" id="copy_from_me">
                                    <label for="copy_from_me">Copiar seus dados do Cadastro</label>

                                </p>     
                            
                                <div id="holder_data">
                                            <div class="form-group col-md-12">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="creditCardHolderName">Nome Completo</label>
                                                        <input type="text" class="form-control" name="creditCardHolderName" id="creditCardHolderName" value="{{Auth::user()->name}}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="creditCardHolderCPF">CPF</label>
                                                        <input type="text" class="form-control" id="creditCardHolderCPF" name="creditCardHolderCPF">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="creditCardHolderPhone">Telefone</label>
                                                        <input type="text" class="form-control" id="creditCardHolderPhone" name="creditCardHolderPhone" value="{{Auth::user()->phone}}">
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                                                <div class="row">   
                                                    <div class="form-group col-md-2">
                                                        <label for="creditCardHolderBirthDate">Data de Nascimento</label>
                                                        <input type="date" class="form-control" id="creditCardHolderBirthDate" name="creditCardHolderBirthDate">
                                                    </div>
                                                </div>
                                <p>Endereço da fatura</p>
                                <p>
                                    <input type="checkbox" id="copy_from_shipping">
                                    <label for="copy_from_shipping">Copiar do Endereço de Entrega</label>
                                </p>     
                            
                                <div id="shipping_data">

                                    <div class="form-group col-md-12">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="billingAddressPostalCode">Cep</label>
                                                <input type="text" class="form-control" id="billingAddressPostalCode" name="billingAddressPostalCode">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="billingAddressStreet">Rua</label>
                                                <input type="text" class="form-control" id="billingAddressStreet" name="billingAddressStreet">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="billingAddressNumber">N°</label>
                                                <input type="text" class="form-control" id="billingAddressNumber" name="billingAddressNumber">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="billingAddressComplement">Complemento</label>
                                                <input type="text" class="form-control" id="billingAddressComplement" name="billingAdressComplement">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="billingAddressDistrict">Bairro</label>
                                                <input type="text" class="form-control" id="billingAddressDistrict" name="billingAddressDistrict">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="billingAddressCity">Cidade</label>
                                                <input type="text" class="form-control" id="billingAddressCity" name="billingAddressCity">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="billingAddressState">Estado</label>
                                                <input type="text" class="form-control" id="billingAddressState" name="billingAddressState">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                   <input type="submit" class="btn btn-success" id="pagemento" value="pagar">
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
            amount: 531.50,
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

        $('#senderName').on('change', function () {
            pagSeguro.getSenderHash().then(function(data) {
                $('#senderHash').val(data);
            })
        });

    $('#cardNumber ').on('keyup', function() {
        if ($(this).val().length >= 6) {
            let bin = $(this).val();
            pagSeguro.getBrand(bin)
                .then(function(res) {
                    paymentData.brand = res.result.brand.name;
                    $('#card_brad').html('<img src="'+res.url+'" >')
                    return pagSeguro.getInstallments(paymentData.amount, paymentData.brand)
                                                    
                }).then(function(res){
                                        let html = '';
                                        res.forEach(function(item){
                                            html += '<option value="'+item.quantity+'">'+item.quantity+' x R$ '+item.installmentAmount+' - total R$'+item.totalAmount+'</option>'
                                        });     
                                        $('#installmentQuantity').html(html);       
                                        $('#installmentValue').val(res[0].installmentAmount); 
                                        $('#installmentQuantity').on('change', function(){
                                            let value = res[$('#installmentQuantity').val() - 1].installmentAmount;
                                               $('#installmentValue').val(value);
                                        });               
                                    });
        }
    });

    $('#form').submit(function(e) {
        e.preventDefault();
        let params = {
            cardNumber: $('#cardNumber').val(),
            cvv: $('#cvv').val(),
            cardNumber: $('#cardNumber').val(),
            expirationMonth: $('#expirationMonth').val(),
            expirationYear: $('#expirationYear').val(),
            brand: paymentData.brand,
        }
       pagSeguro.createCardToken(params)
            .then(function(token){
                $('#creditCardToken').val(token);
                let url = $('#form').attr('action');
                let data = $('#form').serialize();
                $.post(url, data) 
            });
    });
        
        let toggle = function (element, verification,callbackShow, callbackHide){
            if(!verification.is(':checked')){
                $(element).show();
                callbackShow();
            }else{
                $(element).hide();
                callbackHide();
            }
        }

    let holderShow = function () {
        $('#creditCardHolderName').val('');
        $('#creditCardHolderCPF').val('');
        $('#creditCardHolderPhone').val('');
    }
    let holderHide = function () {
        $('#creditCardHolderName').val($('#senderName').val());
        $('#creditCardHolderCPF').val($('#senderCPF').val());
        $('#creditCardHolderPhone').val($('#senderPhone').val());
    }
    let shippingShow = function () {
        $('#billingAddresPostalCode').val('');
        $('#billingAddressStreet').val('');
        $('#billingAddressNumber').val('');
        $('#billingAddressComplement').val('');
        $('#billingAddressDistrict').val('');
        $('#billingAddressCity').val('');
        $('#billingAddressState').val('');
    }
    let shippingHide = function () {
        $('#billingAddressPostalCode').val($('#shippingAddressPostalCode').val());
        $('#billingAddressStreet').val($('#shippingAddressStreet').val());
        $('#billingAddressNumber').val($('#shippingAddressNumber').val());
        $('#billingAddressComplement').val($('#shippingAddressComplement').val());
        $('#billingAddressDistrict').val($('#shippingAddressDistrict').val());
        $('#billingAddressCity').val($('#shippingAddressCity').val());
        $('#billingAddressState').val($('#shippingAddressState').val());
    }

        toggle('#holder_data',$(this),holderShow,holderHide);
        toggle('#shipping_data',$(this),shippingShow,shippingHide);

        $('#copy_from_me').on('change', function(){
            toggle('#holder_data',$(this),holderShow,holderHide)
        });

         $('#copy_from_shipping').on('change', function(){
            toggle('#shipping_data',$(this),shippingShow,shippingHide)
        });

</script>

@endsection
