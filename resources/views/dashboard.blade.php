@extends('principal')

@section('conteudo')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                        <h2>ÁREA ADMINISTRATIVA</h2>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="btn-group-justified">
                        <a href="/produtos/adicionar" class="btn btn-success botao-geral col-md-3">Adicionar produto</a>
                        <a href="#" class="btn btn-warning botao-geral col-md-3">Editar produto</a>
                        <a href="#" class="btn btn-danger botao-geral col-md-3">Remover produto</a>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
