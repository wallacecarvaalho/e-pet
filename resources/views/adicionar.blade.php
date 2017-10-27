@extends('principal')

@section('conteudo')
    <h1>Adicionar novo produto</h1>
    <hr>
<div class="container">

    <div class="row">
        <form action="{{ route('produtos.salvar') }}" method="POST" enctype="multipart/form-data">
            
            {{ csrf_field() }} 
            @include('_form') {{-- Formulário --}}

            <button type="submit" class="btn btn-primary btn-block botao-geral">Adicionar produto</button>
            <br>

        </form>
    </div>
</div>
@stop
