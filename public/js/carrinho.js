function carrinhoRemoverProduto(idcarrinho, idproduto, item, e) {
    $('#form-remover-produto input[name="carrinho_id"]').val(idcarrinho);
    $('#form-remover-produto input[name="produto_id"]').val(idproduto);
    $('#form-remover-produto input[name="item"]').val(item);
    $('#form-remover-produto').submit();
}

function carrinhoAdicionarProduto(idproduto, e) {
    $('#form-adicionar-produto input[name="id"]').val(idproduto);
    $('#form-adicionar-produto').submit();
}