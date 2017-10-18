@extends('principal')

@section('conteudo')

    <div class="container">
        <div class="row">
            <div class="container">
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

                @if($carrinhos->count())
                    @php
                        $total_pedido = 0;
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

                                    <tr>
                                        <td >
                                            <img width="100" height="100" src="{{ $carrinho_produto->produto->imagem }}">
                                        </td>
                                        <td class="text-center">
                                            <div class="text-center">
                                                <a class="col-sm-4 col-md-4 col-lg-4" href="#">
                                                    <span class="glyphicon glyphicon-minus-sign" data-toggle="tooltip" data-placement="right"
                                            title="Não funciona ainda!"></span>
                                                </a>
                                                <span class="item-carrinho col-sm-4 col-md-4 col-lg-4">
                                                    {{ $carrinho_produto->qtd }}
                                                </span>
                                                <a class="col-sm-4 col-md-4 col-lg-4" href="">
                                                    <span class="glyphicon glyphicon-plus-sign" data-toggle="tooltip" data-placement="right"
                                            title="Não funciona ainda!"></span>
                                                </a>
                                            </div>
                                            <a href="#" class="btn btn-link" data-toggle="tooltip" data-placement="right"
                                            title="Não funciona ainda!">Retirar produto</a>
                                        </td>
                                        <td > {{ $carrinho_produto->produto->name }}</td>
                                        <td >R$ {{ number_format($carrinho_produto->produto->preco, 2, ',', '.') }}</td>
                                        @php
                                            $total_produto = $carrinho_produto->valores;
                                            $total_pedido += $total_produto;
                                        @endphp
                                        <td >R$ {{ number_format($total_produto, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            
                @empty
                    <div class="container">
                        <div class="page-header">
                            <h1>Seu carrinho está vazio! :(</h1>
                        </div>
                        <p>Para adicionar produtos em seu carrinho, clique no botão "Comprar" no produto desejado.</p>
                        <a href="/" class="btn btn-success">Voltar</a>
                    </div>
                @endforelse

                @if($carrinhos->count())
                        </tbody>
                    </table>
                    <div class="row">
                        <strong class="col-sm-offset-4 col-md-offset-4 col-lg-offset-4 col-lg-4 col-md-4 col-4 carrinho-total-texto">
                            Total do pedido:
                        </strong>
                        <span class="col-sm-offset-8 col-md-offset-8 col-4 col-md-4 col-lg-4 text-center carrinho-total">R$ {{ number_format($total_pedido, 2, ',', '.') }}</span>

                        <a class="btn col-4 col-md-4 col-lg-4 btn-continuar-comprando" data-toggle="tooltip"
                        data-placement="right" title="Voltar a página inicial para selecionar mais itens!" href="/">
                            Continuar comprando!
                        </a>
                        <a class="btn btn-success col-4 col-md-4 col-lg-4 btn-pagar" data-toggle="tooltip"
                        data-placement="left" title="Efetuar o pagamento" href="/">
                            Pagamento
                        </a>
                    </div>
                @endif

                
            </div>
        </div>
    </div>
@stop