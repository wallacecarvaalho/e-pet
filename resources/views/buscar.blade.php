@extends('principal')

@section('conteudo')

    <div class="row">
        <div class="container fundo">
            <!--Coluna de categorias-->
            <section class="categorias">
                <div class="col-md-3 col-categoria">

                    <h3>Categorias</h3>
                     <ul>
                        <li class="lista-categorias"><a href="">Cachorros</a></li>
                        <li class="lista-categorias"><a href="">Gatos</a></li>
                        <li class="lista-categorias"><a href="">Papagaio</a></li>
                    </ul>

                </div>
            </section>
            <!--Coluna de produtos-->
            <section class="produtos">
            
                <div class="col-md-9 col-produto">
                    <h3>Produtos</h3>
                        <div class="row">
                        @if(empty($p) || $p == '[]')
                        <div class="alert alert-danger">
                            Nenhum produto cadastrado.
                        </div>
                        @else
            
                                <div class="col-sm-6 col-md-4 col-itens">
                                    <a href="/produtos">
                                        <div class="thumbnail">
                                            <img src="{{$p->imagem}}" class="img-rounded" alt="...">
                                            <div class="caption">
                                                <h3>{{$p->name}}</h3>
                                                <p class="preco">R$ {{$p->preco}}</p>
                                                <p><a href="#" class="btn btn-success btn-comprar" role="button">Comprar</a></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
        
                            
                            
                        @endif
                        </div>
                </div>
             </section>
            
        </div>
    </div>
@stop