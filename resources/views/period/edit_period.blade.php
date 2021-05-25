@extends('layouts.base')
@section('contenido')
<div>
    <body>
       <div style="width: 100%; display: table;">
           <div style="display: table-row; height: 100px;">
               <div style="width: 50%; display: table-cell; ">
                <div class="small">
                    <form action="/dashboard/edit_period/" method="post">
                        @csrf
                        <h2>Habilitar periodo</h2>
                        <h6>Codigo</h6>
                        <input placeholder="Ej: 202110" id="Codigo" name="Codigo" type="text">
                        <h6>Descripcion</h6>
                        <input placeholder="Ej: primer semestre año 2020" id="Descripcion" name="Descripcion" type="text">
                        <br>
                        <input type="submit" value="Habilitar periodo">
                    </form>
                </div>
            </div>
            <div style="display: table-cell;">
                <div>
                    <form action='/dashboard/edit/' method="post">
                        @csrf

                        <h2>Deshabilitar periodo</h2>
                        <h6>Codigo</h6>
                        <input placeholder="Ej: 202110" id="Codigo" name="Codigo" type="text">
                        <br>
                        <input type="submit" value="Deshabilitar periodo">
                    </form>
                </div>
               </div>
           </div>
       </div>
    </body>
    <br>

    <table class="table table-dark table-striped mt-4">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Estado</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($period_list as $period)
            <tr>
                <td>{{$period->Codigo}}</td>
                <td>{{$period->Descripcion}}</td>
                <td>
                    @if ($period->Estado)
                        Habilitado
                    @else
                        Deshabilitado
                    @endif


                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>

<br>
<a href="/dashboard">Volver</a>
@endsection








##1ponerle
js y blade

if se encontró
carga
si no
    carga un mensaje


