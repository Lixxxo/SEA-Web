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
                border-radius: 10px;
            }
            input[type=txtNumber] {
                padding: 12px 20px;
                margin: 8px 0;
                text-align: center;
                box-sizing: border-box;
            }
            /* -- Tablas -- */
            table{
                font-family: 'Arial';
                margin: 25px auto;
                border-collapse: collapse;
                border: 1px solid #00cccc;
                border-bottom: 2px solid #00cccc;
                box-shadow: 0px 0px 20px rgba(0,0,0,0.10),
                            0px 10px 20px rgba(0,0,0,0.05),
                            0px 20px 20px rgba(0,0,0,0.05),
                            0px 30px 20px rgba(0,0,0,0.05);
            }
            table tr:hover{
                background: #f4f4f4;
            }
            table tr:hover td{
                color: #555;
            }
            table th, table td{
                color: #999;
                border: 1px solid #eee;
                padding: 12px 35px;
                border-collapse: collapse;
            }
            table th {
                background: #00cccc;
                color: #fff;
                text-transform: uppercase;
                font-size: 12px;
            }
            table th.last{
                border-right: none;
            }
            /* -- FIN Tablas -- */

            /* -- Direccionamiento URL "a" -- */
            /*
            a:link, a:visited{
                background-color: #00cccc;
                padding: 14px 25px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-family: Arial, Helvetica, sans-serif;
                text-transform: uppercase;
            }
            a:hover, a:active{
                background-color: #50dbdb
            }
            */
            #edit{

                background-color: lightsalmon;
                text-transform: uppercase;
            }
            #edit:hover{
                background-color: rgb(252, 192, 168);
            }
            #restore-password{
                background-color: lightcoral;
                text-transform: uppercase;
            }
            #restore-password:hover{
                background-color: rgb(243, 166, 166);
            }

        </style>
      </div>

      <br>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     @yield('script')

    </body>


</html>

