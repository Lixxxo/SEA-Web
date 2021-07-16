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
            input[type=button], input[type=submit], input[type=reset] {
                border: none;
                color: white;
                padding: 16px 32px;
                text-decoration: none;
                margin: 4px 2px;
                cursor: pointer;
                border-radius: 25px;
            }
            input[type=txtNumber] {
                padding: 12px 20px;
                margin: 8px 0;
                text-align: center;
                box-sizing: border-box;
            }


            table, th, td{
                border: 1px solid black;
                padding: 10px;

            }
            table{
                text-align: center;
                align-content: center;
                margin-left: auto;
                margin-right: auto;
            }
            #header{
                background-color: lightgray;
                text-align: center;
            }
        </style>
      </div>

      <br>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     @yield('script')

    </body>


</html>

