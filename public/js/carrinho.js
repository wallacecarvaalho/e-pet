
verificaVazio(null, "verificar");

function carrinhoRemoverProduto(element, idcarrinho, idproduto, item, e) {
    $.ajax({
        url: "/carrinho/remover",
        type: "delete",
        datatype: "JSON",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: {
            "carrinho_id": idcarrinho,
            "produto_id": idproduto,
            "item": item,
            "_method": "DELETE"
        },
        success: function(produto){
            var qtd = produto[0].qtd;
            if(qtd > 0){
                //Atualiza a quantidade
                var td = $(element).closest('td'); //Pega o 'td' Pai
                var spanQtd = $(td).find('.carrinho-qtd');
                $(spanQtd).html(qtd); 

                //Atualiza o subtotal
                var subTotal = qtd * produto[0][0].valor;
                var subTotalForm = subTotal.toLocaleString('PT-BR', { style: 'currency', currency: 'BRL' });
                var tr = $(element).closest('tr');
                var spanSubTotal = $(tr).find('.subtotal-carrinho');
                $(spanSubTotal).html( subTotalForm );

                //Atualiza o total (.carrinho-total)
                atualizaTotal();
                $(".alert-success").html(produto.message).fadeIn(800, mostraAlert());
            } else { //Se a última unidade de um produto for removida, precisa verificar se o carrinho ainda tem outros produtos
                verificaVazio(element, "remover");
            }
        }
    })
}

function carrinhoAdicionarProduto(element, idproduto, e) {
    $.ajax({
        url: "/carrinho/adicionar",
        type: "post",
        datatype: "JSON",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: {
            "id": idproduto,
            "url": window.location.pathname,
            "_method": "post"
        },
        success: function(produto) {
            var qtd = produto[0].qtd;
            //Atualiza a quantidade
            var td = $(element).closest('td');
            var spanQtd = $(td).find('.carrinho-qtd');
            $(spanQtd).html(qtd); 

            //Atualiza o subtotal
            var subTotal = qtd * produto[0][0].valor;
            var subTotalForm = subTotal.toLocaleString('PT-BR', { style: 'currency', currency: 'BRL' });
            var tr = $(element).closest('tr');
            var spanSubTotal = $(tr).find('.subtotal-carrinho');
            $(spanSubTotal).html( subTotalForm );

            //Atualiza o total (.carrinho-total)
            atualizaTotal();
            $(".alert-success").html(produto.message).fadeIn(800, mostraAlert());
            
        },
        error: function(req, textStatus, errorThrown) {
            // != 200 OK HTTP
            alert('Ooops, algo deu errado: ' + textStatus + ' ' + errorThrown);
        }
    })
}

function verificaVazio(element, acao){
    //Verifica se ainda tem produtos no carrinho
    $.ajax({
        url: "/carrinho/verificar",
        type: "GET",
        datatype: "JSON",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: {
            "_method": "GET"
        },
        success: function(retorno){
            if(retorno == 1){
                //Se o carrinho está vazio, mostra mensagem de ' Carrinho Vazio :( '
                $( ".carrinho-vazio" ).toggle();
                $( ".carrinho-geral" ).detach();
            } else { //Se ainda houver produtos no carrinho, remove apenas a linha
                if(acao == "remover"){
                    $(element).closest('tr').fadeOut(250, function(){
                        $(element).closest('tr').remove();
                        var numItens = Number($("#carrinho-itens").html());
                        numItens -= 1;
                        $("#carrinho-itens").html(numItens);
                        atualizaTotal();
                    });
                }
            }
        }
    })
}

function atualizaTotal(){
    var txtTotal = $('#carrinho-total');
    var total = 0;
    $("tr.carrinho-row").each(function(){
        $this = $(this);
        total += calculaTotal(total, $this);
    });
    total = total * 1000; //Para transformar em milhar, devido a confusão entre ponto e vírgula
    var totalForm = total.toLocaleString('PT-BR', { style: 'currency', currency: 'BRL' });
    $( txtTotal ).html( totalForm );
}

function calculaTotal(total, $this) {
    var qtdLinha = $this.find('.carrinho-qtd').html(); 
    var subTotalString = $this.find('.vlr-unit-carrinho').html();

    var valor = Number(subTotalString.replace(/[^0-9\.]+/g,""));

    //Verifica se tem ponto na string (indicando que o valor é maior que mil)
    //Por algum motivo, a variável 'subTotalString', quando menor que 1000, apenas retira os caracteres 'R$,'
    //Logo, se .vlr-unit-carrinho = R$100,00, 'valor' será igual a 10000 (ao invés do correto, 0.1)
    //Já se .vlr-unit-carrinho = R$1.500,00, 'valor' será igual a 1.5
    console.log(valor);
    if(subTotalString.indexOf(".") < 0) { 
        valor = valor/100000;
    }

    var totalLinha = qtdLinha * valor;
    return totalLinha;
}

function mostraAlert(){
    setTimeout(function(){
        $(".alert").fadeOut(800);
    }, 3500);
}

// function carrinhoRemoverProduto(idcarrinho, idproduto, item, e) {
//     $('#form-remover-produto input[name="carrinho_id"]').val(idcarrinho);
//     $('#form-remover-produto input[name="produto_id"]').val(idproduto);
//     $('#form-remover-produto input[name="item"]').val(item);
//     $('#form-remover-produto').submit();
// }

// function carrinhoAdicionarProduto(idproduto, e) {
//     $('#form-adicionar-produto input[name="id"]').val(idproduto);
//     $('#form-adicionar-produto').submit();
// }