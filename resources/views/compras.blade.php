@extends('principal')

@section('conteudo')

    <div class="container">
        <div class="row">
            <div class="container">
                <h3>Compras concluídas</h3>
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
                
                @forelse ($compras as $carrinho)
                        @php
                            $total_carrinho = 0;
                        @endphp
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="item-carrinho"></th>
                                <th class="item-carrinho">Produto</th>
                                <th class="item-carrinho"></th>
                                <th class="item-carrinho"></th>
                                <th class="item-carrinho">Total</th>
                            </tr>
                    <h3 class="col-sm-12 col-md-6 col-lg-6">Pedido: {{ $carrinho->id }} </h3>
                    <h3 class="col-sm-12 col-md-6 col-lg-6">Criado em: {{ $carrinho->created_at->format('d/m/Y H:i') }} </h3>
                        </thead>
                        <tbody>

                    @foreach ($carrinho->carrinho_produtos_itens as $carrinho_produto)
                        @php
                            $total_carrinho += $carrinho_produto->produto->preco;
                        @endphp
                        <tr>
                            <td class="linha-carrinho"><img class="img-rounded" width="100" height="100" src="{{ $carrinho_produto->produto->imagem }}"></td>
                            <td class="linha-carrinho">{{ $carrinho_produto->produto->name }}</td>
                            <td></td>
                            <td></td>
                            <td class="linha-carrinho">R$ {{ number_format($carrinho_produto->produto->preco, 2, ',', '.')}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td class="item-carrinho"><strong>Total do pedido: </strong></td>
                            <td class="linha-carrinho">R$ {{ number_format($total_carrinho, 2, ',', '.')}}</td>
                        </tr>
                    </tfoot>
                    </table>
                      
                @empty
                    <div class="container">
                        <div class="page-header">
                            <h1>Você não fez nenhuma compra!</h1>
                        </div>
                        <p>Para finalizar uma compra, clique no botão "Pagamento" localizado no seu carrinho!</p>
                        <a href="{{route('carrinho.index')}}" class="btn btn-success">Carrinho</a>
                    </div>
                @endforelse
                
            </div>
        </div>
    </div>

@stop
