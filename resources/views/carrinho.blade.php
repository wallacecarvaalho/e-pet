@extends('principal')

@section('conteudo')

<div class="container">
    <div class="row">
        <div class="container">
            
            {{ csrf_field() }}
            <h3>Produtos no carrinho</h3>
            <hr>
            @if (Session::has('mensagem-sucesso'))
                <div class="alert alert-success" role="alert">
                    <strong>{{ Session::get('mensagem-sucesso') }}</strong>
                </div>
            @endif
            @if (Session::has('mensagem-falha'))
                <div class="alert alert-danger" role="alert">
                    <strong>{{ Session::get('mensagem-falha') }}</strong>
                </div>
            @endif
            
            <section class="carrinho-geral">
                @if($carrinhos->count())
                    @php
                        $total_carrinho = 0;
                        $num_itens = 0;
                    @endphp
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="item-carrinho"></th>
                                <th class="item-carrinho">Qtd</th>
                                <th class="item-carrinho">Produto</th>
                                <th class="item-carrinho">Valor Unit.</th>
                                <th class="item-carrinho">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                @endif
                @forelse ($carrinhos as $carrinho)
                    {{--  <h5 class="col-sm-12 col-md-6 col-lg-6">Pedido: {{ $carrinho->id }} </h5>
                    <h5 class="col-sm-12 col-md-6 col-lg-6">Criado em: {{ $carrinho->created_at->format('d/m/Y H:i') }} </h5>  --}}
                    @foreach ($carrinho->carrinho_produtos as $carrinho_produto)
                        @php
                            $num_itens++;
                        @endphp
                        <tr class="row-carrinho">
                            <td class="linha-carrinho">
                                <img class="img-rounded" width="100" height="100" src="{{ $carrinho_produto->produto->imagem }}">
                            </td>
                            <td class="text-center linha-carrinho">
                                <div class="text-center">

                                    <a class="col-sm-4 col-md-4 col-lg-4 icone-carrinho">
                                        <span class="glyphicon glyphicon-minus-sign" onclick="carrinhoRemoverProduto( this, {{ $carrinho->id }}, {{ $carrinho_produto->produto_id }}, 1 )"></span> 
                                        <!-- 1 p/ remover 1 item, 0 p/ remover todos -->
                                    </a>

                                    <span class="item-carrinho qtd-carrinho col-sm-4 col-md-4 col-lg-4">
                                        {{ $carrinho_produto->qtd }}
                                    </span>

                                    <a class="col-sm-4 col-md-4 col-lg-4 icone-carrinho">
                                        <span class="glyphicon glyphicon-plus-sign" onclick="carrinhoAdicionarProduto( this, {{ $carrinho_produto->produto_id }} )"></span>
                                    </a>
                                    
                                </div>
                                <a class="btn btn-link" onclick="carrinhoRemoverProduto( this, {{ $carrinho->id }}, {{ $carrinho_produto->produto_id }}, 0 )">
                                    Retirar produto
                                </a>
                            </td>

                            <td class="linha-carrinho"> {{ $carrinho_produto->produto->name }}</td>
                            <td class="linha-carrinho vlr-unit-carrinho">R${{ number_format($carrinho_produto->produto->preco, 2, ',', '.') }}</td>
                            @php
                                $total_produto = $carrinho_produto->valores;
                                $total_carrinho += $total_produto;
                            @endphp
                            <td class="linha-carrinho subtotal-carrinho">R${{ number_format($total_produto, 2, ',', '.') }}</td>
                        </tr>

                        {{--  Se for o último ciclo do loop  --}}
                        @if ($loop->last) 
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="row">
                                    <strong class="text-left col-lg-2 col-md-2 col-2 carrinho-total-texto">
                                        Nº de itens: 
                                    </strong>
                                    <span class="col-2 col-md-2 col-lg-2 text-center carrinho-total">{{ $num_itens }}</span>
                                    <strong class=" col-lg-4 col-md-4 col-4 carrinho-total-texto">
                                        Total do pedido:
                                    </strong>
                                    <span class="col-sm-offset-8 col-md-offset-8 col-4 col-md-4 col-lg-4 text-center carrinho-total">R$ {{ number_format($total_carrinho, 2, ',', '.') }}</span>
                                </div>
                                    <a class="btn col-4 col-md-4 col-lg-4 btn-continuar-comprando" data-toggle="tooltip"
                                    data-placement="right" title="Voltar a página inicial para selecionar mais itens!" href="/">
                                        Continuar comprando!
                                    </a>
                                    <a class="btn btn-success col-4 col-md-4 col-lg-4 btn-pagar" data-toggle="tooltip"
                                    data-placement="left" title="Efetuar o pagamento" href="/checkout/dados/">
                                        Pagamento
                                    </a>
                            </div>

                            <!-- =================== \/ APAGAR ESTE BOTÃO! \/ =================== -->
                            <div class="row">
                                <form method="POST" action="{{ route('carrinho.concluir') }}">
                                    
                                    {{ csrf_field() }}
                                    <input type="hidden" name="carrinho_id" value="{{ $carrinho->id }}">
                                    <button class="btn btn-success btn-comprar">Testar pagamento</button>
                                </form>
                            </div>
                            <!-- =================== /\ APAGAR ESTE BOTÃO! /\ =================== -->
                        @endif
                    @endforeach
                @empty
                {{--  Depois de implementar o AJAX, acho que não precisa por nada aqui...  --}}
                @endforelse
            </section>
                <div class="container carrinho-vazio" style="display: none">
                    <div class="page-header">
                        <h1>Seu carrinho está vazio! :(</h1>
                    </div>
                    <p>Para adicionar produtos em seu carrinho, clique no botão "Comprar" no produto desejado.</p>
                    <a href="/" class="btn btn-success">Voltar</a>
                </div>
        </div>
    </div>
</div>

<form action="{{ route('carrinho.remover') }}" id="form-remover-produto" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}

    <input type="hidden" name="carrinho_id">
    <input type="hidden" name="produto_id">
    <input type="hidden" name="item">
</form>

<form action="{{ route('carrinho.adicionar') }}" id="form-adicionar-produto" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="id">
</form>

{{--  <script>
    $.ajax({
        method: "GET",
        url: {{ route('carrinho.remover')}}
    })
</script>  --}}
@stop
