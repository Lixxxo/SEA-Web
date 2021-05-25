@extends('layouts.base')
@section('contenido')
<div>

    <head></head>
    <body>
       <div style="width: 100%; display: table;">
           <div style="display: table-row; height: 100px;">
               <div style="width: 50%; display: table-cell; ">
                <div class="small">
                    <form action="/dashboard/enable_period/" method="GET">
                        <h4>Habilitar</h4>
                        <input placeholder="Ej: 202110" id="code" name="code" type="text">

                    </form>
                </div>

                <div>
                    <form action="/dashboard/enable_period/" method="GET">
                        <h4>Descripcion</h4>
                        <input placeholder="Ej: primer semestre año 2020">
                    </form>
                    <a href="">Habilitar</a>
                </div>
               </div>
               <div style="display: table-cell;">
                <div>
                    <form action="/dashboard/enable_period/" method="GET">
                        <h4>Deshabilitar</h4>
                        <input placeholder="Ej: 202110" id="code" name="code" type="text">
                    </form>
                    <a href="">Deshabilitar</a>
                </div>
               </div>
           </div>
       </div>
    </body>

    <div>

    </div>
    <br>

    <table class="table table-dark table-striped mt-4 " >
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($period_list as $period)
            <tr>
                <td>{{$period->Codigo}}</td>
                <td>{{$period->Descripcion}}</td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>

<br>
<a href="/dashboard">Volver</a>
@endsection
