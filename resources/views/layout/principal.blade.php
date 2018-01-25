 <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="/css/bootstrap.min.css">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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
      </style>
    </head>
    <body>
      <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

    <div class="container  animated fadeIn">
        @yield('content')
    </div>
    

      <script type="text/javascript" src="/js/jquery.min.js"></script>
      <script type="text/javascript" src="/js/popper.min.js"></script>
      <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    </body>
  </html>