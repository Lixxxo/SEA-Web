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
                padding: 10px 10px;
                text-decoration: none;
                margin: 4px 2px;
                cursor: pointer;
                border-radius: 10px;
                background-color: #00cccc;
            }
            input[type=txtNumber] {
                padding: 8px 12px;
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
            .container_1{
                max-width: 1200px;
                margin-top: 10px;
                margin: 15px;
            }
            .child{
                margin: 5px;
                text-align: center;
                text-transform: uppercase;
                background: #00cccc;
                border-radius: 10px;
                padding: 10px;
                border-collapse: collapse;
                border: 1px solid #eee;
                box-shadow: 0px 0px 20px rgba(0,0,0,0.10),
                            0px 10px 20px rgba(0,0,0,0.05),
                            0px 20px 20px rgba(0,0,0,0.05),
                            0px 30px 20px rgba(0,0,0,0.05);
            }
            .child input{

            }
            section div{
                float: left;
            }
            section div label{
                display: block;
            }

            input[type="text"]{
                padding: 5px;

            }
            body{
                height: 60vh;
                display: flex;

                align-items: center;
                flex-direction: column;
                font-family: sans-serif;
            }
            .form{
                width: 50%;
                position: relative;
                height: 50px;
                overflow: hidden;

            }
            .form input{
                width: 100%;
                height: 100%;
                color: #595f6e;
                padding-top: 20px;
                border: none;
                background-color: transparent;
                outline: none;
            }
            .form label{
                position: absolute;
                bottom: 0px;
                left: 0%;
                width: 100%;
                height: 100%;
                pointer-events: none;
                border-bottom: 1px solid black;
            }
            .form label::after{
                content: "";
                position: absolute;
                left: 0px;
                bottom: -1px;
                height: 100%;
                width: 100%;
                border-bottom: 3px solid #5fa8d3;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .content-data{
                position: absolute;
                bottom: 5px;
                left: 0px;
                transition: all 0.3s ease;
            }
            .form input:focus + .label-data .content-data, .form input:valid + .label-data .content-data{
                transform: translateY(-100%);
            }
            .form input:focus + .label-data::after, .form input:valid + .label-data::after{
                transform: translateX(0%);
            }

            .submit-data{
                background-color: green;
                width: 100px;
                height: 10px;
                align-items: center;
            }
        </style>
      </div>

      <br>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     @yield('script')

    </body>


</html>

