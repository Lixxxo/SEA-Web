@extends('layouts.base')

@section('contenido')
<div>
    <a href="/dashboard">Dashboard</a>
</div>
<h3 align = "center">Listado de asignaturas</h3>

<table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
            <th scope="col">NRC</th>
            <th scope="col">Código de asignatura</th>
            <th scope="col">Profesor</th>
            <th scope="col">Rut</td>
        </tr>
    </thead>
    <tbody>

    </tbody>

</table>
<br>
<a href="" class="btn btn-success" href="">Crear asignatura</a>
<br>


@endsection
