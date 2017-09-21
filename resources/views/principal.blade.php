<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>E-Pet</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/estilo.css">
        <link rel="stylesheet" href="css/app.css">
        
        </style>
    </head>
    <body>



  <nav class="navbar barra-navegacao navbar-default">
    
    <div class="container-fluid">

    <div class="navbar-header">      
      <a class="navbar-brand" href="/produtos">E-Pet</a>
    </div>

      <ul class="nav navbar-nav navbar-right">
        @if (!Auth::guest())
          <li>Usuario: <span class="user"> {{ Auth::user()->name }} </span> </li>
          <li><a href="/produtos">Listagem</a></li>
          <li><a href="/produtos/novo">Novo</a></li>
          <li><a href="/logout">Logout</a></li>
        @endif
        
    </ul>
  


  </nav>
    
    @yield('conteudo')

  <footer id="footer">
 
    <div class="row">
    <div class="col-md-6">
        <ul>
            <li>Sobre nos</li>
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
    <script src="js/app.js"></script>
</html>
