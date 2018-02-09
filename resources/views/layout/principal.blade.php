   <!DOCTYPE html>
   <html lang="{{ app()->getLocale() }}">
    <html>
      <head>
         <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Compiled and minified CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <!--Let browser know website is optimized for mobile-->
        <title>Cautela</title>
        <style>
          /* Animacoes */
          .animated {
            animation-duration: 0.8s;
            animation-fill-mode: both;
          }

          @keyframes fadeIn {
            from {
              opacity: 0;
            }

            to {
              opacity: 1;
            }
          }

          .fadeIn {
            animation-name: fadeIn;
          }

          /*Autocomplete JqueryUI*/
          .ui-autocomplete {
          position: absolute;
          top: 100%;
          left: 0;
          z-index: 1000;
          display: none;
          float: left;
          min-width: 160px;
          padding: 5px 0;
          margin: 2px 0 0;
          list-style: none;
          font-size: 14px;
          text-align: left;
          background-color: #ffffff;
          border: 1px solid #cccccc;
          border: 1px solid rgba(0, 0, 0, 0.15);
          border-radius: 4px;
          -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
          box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
          background-clip: padding-box;
        }

        .ui-autocomplete > li > div {
          display: block;
          padding: 3px 20px;
          clear: both;
          font-weight: normal;
          line-height: 1.42857143;
          color: #333333;
          white-space: nowrap;
        }

        .ui-state-hover,
        .ui-state-active,
        .ui-state-focus {
          text-decoration: none;
          color: #262626;
          background-color: #f5f5f5;
          cursor: pointer;
        }

        .ui-helper-hidden-accessible {
          border: 0;
          clip: rect(0 0 0 0);
          height: 1px;
          margin: -1px;
          overflow: hidden;
          padding: 0;
          position: absolute;
          width: 1px;
        }

      </style>
      </head>
      <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">Cautela</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        @auth
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Materiais
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/materiais">Lista de Materiais</a>
            @if(Auth::user()->perfil == 1)
            <a class="dropdown-item" href="/materiais/novo">Adicionar Material</a>
            @endif
        </div>
      </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Cautelas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/cautelas">Lista de Cautelas</a>
            <a class="dropdown-item" href="/cautelas/novo">Adicionar Cautela</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Pelotões
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
           <a class="dropdown-item" href="/pelotoes">Lista de Pelotões</a>
           <a class="dropdown-item" href="/pelotoes/novo">Adicionar Pelotão</a>
        </div>
      </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Militares
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/militares">Lista de Militares</a>
          <a class="dropdown-item" href="/militares/novo">Adicionar Militar</a>
        </div>
      </li>
      @if(Auth::user()->perfil == 1)
      <li>
        <a class="nav-link" href="/registrar">Registrar Usuário</a>
      </li>
      @endif
      </ul>
       <ul class="navbar-nav ">
      <li class="nav-item dropdown my-2 my-lg-0">
        <a class="nav-link dropdown-toggle my-2 my-sm-0" href="#" id="navbarDropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          {{ Auth::user()->name }} <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </li>
        </ul>
        </li>
        @else
          <li>
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
          </ul>
        @endauth
  </div>
</nav>



      <div class="container  animated fadeIn">
          @yield('content')
      </div>
      

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset ('/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/script.js') }}"></script>
      </body>
    </html>