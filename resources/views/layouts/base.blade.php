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
        <style>
            body{
                background-color: whitesmoke;
            }
            table, th {

                border-collapse: collapse;
                text-align: center;
                border: 2px solid darkgrey;
                background-color: white;

            }
            td{
                width: auto;
                border: 2px solid darkgrey;
                padding: 5px;
            }
        </style>
      </div>

      <br>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     @yield('script')

    </body>


</html>

