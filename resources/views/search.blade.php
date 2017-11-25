@extends('principal')

@section('conteudo')

    <div class="row">
        <div class="container fundo">
            <!--Coluna de categorias-->
            <section class="categorias">
                {{--  <div class="col-md-3 col-categoria">

                    <h3>Categorias</h3>
                     <ul>
                        <li class="lista-categorias"><a href="">Cachorros</a></li>
                        <li class="lista-categorias"><a href="">Gatos</a></li>
                        <li class="lista-categorias"><a href="">Papagaio</a></li>
                    </ul>

                </div>  --}}
            </section>
            <!--Coluna de produtos-->
            <section class="produtos">
            
                <div class="col-md-12 col-produto">
                    <h3>Produtos</h3>
                        <div class="row">
                        @if(empty($produtos_pesq) || $produtos_pesq == '[]')
                        <div class="alert alert-danger">
                            Nenhum produto encontrado.
                        </div>
                        @else
                            @foreach($produtos_pesq as $p)
                                <div class="col-sm-6 col-md-3 col-itens">
                                    <a href="/produtos/{{$p->id}}>">
                                        <div class="thumbnail">
                                            <img src="{{$p->imagem}}" class="img-rounded" alt="...">
                                            <div class="caption">
                                                <h3>{{$p->name}}</h3>
                                                <p class="preco">R$ {{$p->preco}}</p>

                                                <form method="POST" action="{{ route('carrinho.adicionar') }}">
                                                    
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{ $p->id }}">
                                                    <button class="btn btn-success btn-comprar">Comprar</button>
                                                    {{--  <p><a href="#" class="btn btn-success btn-comprar" role="button">Comprar</a></p>  --}}
                                                </form>
                                                {{--  <p><a href="#" class="btn btn-success btn-comprar" role="button">Comprar</a></p>  --}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                            
                            
                        @endif
                        </div>
                </div>
             </section>
            
        </div>
    </div>
@stop