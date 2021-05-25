@extends('layouts.base')
@section('contenido')

Vista para habilitar un periodo academico.
<div>
    <form action="/dashboard/enable_period/" method="GET">
        <h4>Codigo de semestre</h4>
        <input placeholder="Ej: 202110" id="code" name="code" type="text">

    </form>



    <table class="table table-dark table-striped mt-4">
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
