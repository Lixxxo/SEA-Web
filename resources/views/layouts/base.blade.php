<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <title>SEA WEB APP</title>
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">

</head>


<body class="dark">
    <br>
    <div class="container-fluid">
        @yield('contenido')

    </div>

    <br>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @yield('script')

</body>


</html>
