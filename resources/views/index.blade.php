@extends('principal')

@section('conteudo')

<section id="header">
    <div class="row">
   
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <section class="item active">
                    <img src="img/pets1.jpg" alt="...">
                    <div class="carousel-caption">
                        <h1></h1>
                    </div>
                </section>

                <section class="item">
                    <img src="img/pets1.jpg" alt="...">
                    <div class="carousel-caption">
                       <h1>E-Pet</h1>
                    </div>
                </section>

            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            </div>
        </div>
</section>

    {{-- ========== SEARCH ========== --}}
    <div class="container">
        <form action="/search" method="GET" >
            <div class="form-group">
                <label class="form-control-label" for="pesquisar">Buscar: </label>
                {{--  <input type="text" class="form-control" value="{{ isset($termoPesq) ? $termoPesq : '' }}" placeholder="Digite aqui o que deseja buscar">  --}}
                <input type="text" class="form-control" id="pesquisar" name="termo" placeholder="Digite aqui o que deseja buscar">
            </div>
        </form>
    </div>
    {{-- ========== SEARCH ========== --}}

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
                        @if(empty($produtos) || $produtos == '[]')
                        <div class="alert alert-danger">
                            Nenhum produto cadastrado.
                        </div>
                        @else
                            @foreach($produtos as $p)
                                <div class="col-sm-6 col-md-4 col-itens">
                                    <a href="/produtos/{{$p->produto_id}}>">
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
                            @endforeach
                            
                            
                        @endif
                        </div>
                </div>
             </section>
            
        </div>
    </div>
@stop