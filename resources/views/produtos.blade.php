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
                    <div class="panel panel-default">
                    <div class="panel-body">
                    <table class="table-striped ">
                        <thead>
                            <th class="item-carrinho">Imagem</th>
                            <th class="item-carrinho">Produto</th>
                            <th class="item-carrinho">Qtd</th>
                            {{--  <th class="item-carrinho">Categoria</th>  --}}
                            <th class="item-carrinho">Valor Unitário</th>
                            <th class="item-carrinho"></th>
                        </thead>
                        <tbody>
                            @foreach ($produtos as $p)

                                <tr>
                                    <td class="linha-carrinho">
                                        <div class="thumbnail produto-descricao">
                                            <img class="img-rounded" width="100" height="100" src="{{ $p->imagem }}">
                                        </div>
                                    </td>

                                    <td class="linha-carrinho">
                                        {{ $p->name }}
                                    </td>
                                    <td class="linha-carrinho">
                                        {{ $p->qtd }}
                                    </td class="linha-carrinho">
                                    {{--  <td>
                                        {{ $p->categoria }}
                                    </td>  --}}
                                    <td class="linha-carrinho">
                                        {{ $p->preco }}
                                    </td>
                                    <td class="linha-carrinho">
                                        <a class="btn btn-warning" href="{{ route('produtos.editar', $p->id) }}">Editar</a>
                                        <a class="btn btn-danger" href="#">Excluir</a>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    </div> 
                @endunless

        </div>
    </div>
@stop