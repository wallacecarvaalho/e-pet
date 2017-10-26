@extends('principal')

@section('conteudo')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    AREA ADMINISTRATIVA
                    <div class="row">
                        <a href="#" class="btn btn-success">Adicionar produto</a>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
