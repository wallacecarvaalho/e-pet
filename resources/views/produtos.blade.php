@extends('principal')

@section('conteudo')
        {{--  <div class="container fundo">
            <section class="produtos">  --}}
            
        {{--  </section>  --}}
    {{--  </div>  --}}

    <div class="container">
        <div class="row">
            <h3>Produtos cadastrados</h3>
            <hr>
                {{-- Se não tiver nenhum produto --}}
                @unless($produtos->count())
                    <div class="alert alert-danger">
                        Nenhum produto cadastrado.
                    </div>
                @else  {{-- Se tiver produtos --}}
                    {{--  <div class="panel panel-default">  --}}
                    {{--  <div class="panel-body">  --}}
                    <table class="table-hover table-produtos" width="100%">
                        <thead>
                            <th class="item-carrinho-produtos">Imagem</th>
                            <th class="item-carrinho-produtos">Produto</th>
                            <th class="item-carrinho-produtos">Quantidade</th>
                            {{--  <th class="item-carrinho">Categoria</th>  --}}
                            <th class="item-carrinho-produtos">Valor</th>
                            <th class="item-carrinho-produtos glyphicon glyphicon-cog"></th>
                        </thead>
                        <tbody>
                            @foreach ($produtos as $p)

                                <tr>
                                    <td class="linha-carrinho" width="15%">
                                        <div class="produto-descricao">
                                            <img class="img-rounded" width="100" height="100" src="/{{ $p->imagem }}">
                                        </div>
                                    </td>

                                    <td class="linha-carrinho" width="40%">
                                        {{ $p->name }}
                                    </td>
                                    <td class="linha-carrinho" width="10%">
                                        {{ $p->qtd }}
                                    </td>
                                    {{--  <td>
                                        {{ $p->categoria }}
                                    </td>  --}}
                                    <td class="linha-carrinho" width="15%">
                                        R$ {{ $p->preco }}
                                    </td>
                                    <td class="linha-carrinho botoes-carrinho" width="20%">
                                        <a class="btn btn-default glyphicon glyphicon-edit btn-editar" href="{{ route('produtos.editar', $p->id) }}"></a>
                                        <a class="btn btn-danger glyphicon glyphicon-trash btn-deletar" href="#"></a>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                    {{--  </div>  --}}
                    {{--  </div>   --}}
                @endunless

        </div>
    </div>
@stop