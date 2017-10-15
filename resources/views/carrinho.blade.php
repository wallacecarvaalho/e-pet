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
                    {{--  <div class="jumbotron">
                        <h2>Seu carrinho está vazio!</h2>
                        <p>Para adicionar produtos em seu carrinho, clique no botão "Comprar" no produto desejado.</p>
                        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
                    </div>  --}}
                    
                    <div class="container">
                        <div class="page-header">
                            <h1>Seu carrinho está vazio! :(</h1>
                        </div>
                        <p>Para adicionar produtos em seu carrinho, clique no botão "Comprar" no produto desejado.</p>
                        <a href="/" class="btn btn-success">Voltar</a>
                    </div>
                </div>
            </section>
            
        </div>
    </div>
@stop