<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <title>SEA WEB APP</title>


  </head>
    
    <body>
      <br>
      <div class="container-fluid">
        @yield('contenido')
      </div>

      <br>
      <footer >
        <div class = "container">
          <div class="text-right">
            <img src="img/github-logo.png" alt="" width="30">
            <a href="https://github.com/Lixxxo/SEA-Web" >      SEA_WEB_APP - Rat-Code</a>
          </div>
          <br>
          <div class="text-center">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
          </div>
        </div>
      </footer>
    
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     @yield('script')
    
    </body>
  

</html>

