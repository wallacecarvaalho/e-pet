@extends('principal')

@section ('conteudo')

<h1 class="titulo">Tela de Login</h1>
<div class="container">
<div class="row">
    <form class="form-group">
        <div class="form-group">
            <label>Login</label>
            <input type="text" class="form-control">
        </div>
        <div class="form-group">
            <label>Senha</label>
            <input type="password" class="form-control">
        </div>
        <button class="btn btn-primary btn-logar">Logar</button>
    </form>
</div>
</div>
@stop 