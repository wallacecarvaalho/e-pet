@extends('principal')

@section('conteudo')
<div class="container">
    <h1>Editar produto</h1>

    <div class="row">
    <hr>
        <div class="col-md-6">
            <h3>Dados atuais: </h3>
            <hr>
            <form action="{{ route('produtos.atualizar', $produto->id) }}" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="name">Nome do produto: </label>
                    <input class="form-control" type="text" id="name" name="name" value="{{ isset($produto->name) ? $produto->name : ''}}" disabled>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição: </label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="3" disabled>{{ isset($produto->descricao) ? $produto->descricao : ''}}</textarea>
                </div>

                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="categoria">Categoria: </label>
                        <input class="form-control" type="text" id="categoria" name="categoria" value="{{ isset($produto->categoria) ? $produto->categoria : ''}}" disabled>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="qtd">Quantidade: </label>
                        <input class="form-control" type="number" min="0" id="qtd" name="qtd" value="{{ isset($produto->qtd) ? $produto->qtd : ''}}" disabled>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="preco">Preço: </label>
                        <input class="form-control" type="number" step=".50" placeholder="0,00" id="preco" name="preco" value="{{ isset($produto->preco) ? $produto->preco : ''}}" disabled>
                    </div>
                </div>

                @if(isset($produto->imagem))
                <div class="input-field">
                    <img width="150" src="{{ asset($produto->imagem) }}">
                </div>
                @endif
            </div>
            <div class="col-md-6">

                <h3>Novos dados: </h3>
                <hr>
                    
                {{ csrf_field() }} 
                <input type="hidden" name="_method" value="PUT">
                @include('_form') {{-- Formulário --}}

        </div>
                <button type="submit" class="btn btn-primary btn-block botao-geral">Atualizar dados do produto</button>
                <a href="{{ route ('produtos.listar') }}" class="btn btn-warning btn-block botao-geral">Voltar</a>

            </form>
    </div>
</div>
@stop
