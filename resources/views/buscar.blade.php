@extends('principal')

@section('conteudo')

    
        <div class="container fundo">
            <!--Coluna de categorias-->

            <!--Coluna de produtos-->
            <section class="produtos">
            
                <div class="col-md-12 col-produto">
                    <h3>Produtos</h3>
                        <div class="row">
                            @if(empty($p) || $p == '[]')
                                <div class="alert alert-danger">
                                    Nenhum produto cadastrado.
                                </div>
                            @else
                                <div class="col-md-6 col-itens">
                                    
                                        <div class="thumbnail produto-descricao">
                                            <img src="/{{$p->imagem}}" class="img-rounded img-descricao" alt="...">
                                            <div class="caption">
                                              
                                            </div>
                                        </div>
                                    
                                </div>
                                <div class="col-md-6 col-descricao">
                                  <h3 class="descricao">{{$p->name}}</h3>
                                    <p class="status">{{$p->status}}</p>
                                    <p class="preco">R$ {{$p->preco}}</p>
                                    <p class="caracteristicas">Caracteristicas <br> <p>{{$p->descricao}}</p></p>
                                    
                                    <form method="POST" action="{{ route('carrinho.adicionar') }}">
                                        
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $p->id }}">
                                        <button class="btn btn-success btn-comprar" {{ $p->status == 'Indisponivel' ? 'disabled' : '' }}>Comprar</button>
                                    </form>
                                  </div>
                               
                            
                            
                            @endif
                        </div>
                </div>
             </section>
            
        </div>
    </div>
@stop