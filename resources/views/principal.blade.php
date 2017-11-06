<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>E-Pet</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/css/estilo.css">
        <link rel="stylesheet" href="/css/app.css">
        
        </style>
    </head>
    <body>



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
            
          @endif
          
       </ul>
       
        </div>
            <div class="container text-center search">
                    <!-- Search -->
                    <form action="/search" method="GET" class="navbar-form form-inline">
                        <div class="form-group">
                                <div class="input-group input-group-search">

                                        <input type="text" class="form-control input-search" id="pesquisar" name="termo" placeholder="Digite aqui o que deseja buscar">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-default btn-search"><i class="glyphicon glyphicon-search"></i></button>
                                        </span>
                                 </div><!-- /input-group -->
                            
                    </form>

            </div>

  </nav>
    <main>
        
            @yield('conteudo')
        
    </main>
  <footer id="footer">
 
    <div class="row">
        <div class="col-md-6">
            <ul>
                <li>Sobre nós</li>
            </ul>
        </div> 
        <div class="col-md-6">
            <ul>
                <li>Empresa</li>
            </ul>
        </div>
    </div>

  </footer>

    </body>


    
    <script src="/js/app.js"></script> 
    @yield('script')
    <script src="/js/function.js"></script> 
    <script src="/js/carrinho.js"></script> 

</html>
