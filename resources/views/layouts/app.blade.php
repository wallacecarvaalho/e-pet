<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/estilo.css">
    <link rel="stylesheet" href="/css/app.css">
        
</head>
<body>
    <div id="app">
       <nav class="navbar barra-navegacao navbar-default">
    
    <div class="container">

    <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>      
      <a class="navbar-brand" href="/">E-Pet</a> 
    </div>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right text-center">
      
          @if (!Auth::guest())
            

            @if(isAdmin()) 
                 <li><a  class="navbar-opcao" href="{{ route('admin.logout') }}"
                                              onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                                              Sair</a>
              </li>
                  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                              {{ csrf_field() }}
                                          </form>
            @else
            
              <li><a class="navbar-opcao" href="{{ route('carrinho.compras') }}">Compras</a></li>
              <li><a class="navbar-opcao" href="/carrinho">Meu carrinho</a></li>
              <li><a  class="navbar-opcao" href="{{ route('admin.logout') }}"
                                              onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                                              Sair</a>
              </li>
                  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                              {{ csrf_field() }}
                                          </form>
              <li class="navbar-user"> Usuario: {{ Auth::user()->name }} </li>
          @endif
          @else
             <li><a href="{{ route('login') }}">Entrar</a></li>
            <li><a href="{{ route('register') }}">Registrar</a></li>
            <li><a href="/">Voltar ao Site</a></li>
            
          @endif
          
       </ul>
       
        </div>

  </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
