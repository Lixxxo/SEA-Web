@extends('layouts.base')

@section('contenido')
<div>
    <a href="/dashboard">Dashboard</a>
</div>
<h3 align = "center">Listado de Asignaturas</h3>

<table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
            <th scope="col">NRC</th>
            <th scope="col">Código de Asignatura</th>
            <th scope="col">Profesor</th>
            <th scope="col">Rut</td>
            <th scope="col">Rut Ayudantes</td>
        </tr>
    </thead>
    <tbody>
        @foreach($course_list as $course)
            <tr>
                <td>{{$course->nrc}}</td>
                <td>{{$course->codigo_asignatura}}</td>
                <td>{{$course->nombre_profesor}}</td>
                <td>{{$course->rut_profesor}}</td>
                <td>
                @foreach($assistant_list as $assistant)
                    <ul>{{$assistant->Usersrut}}</ul>
                @endforeach
                <td>
                    <a href='/dashboard/courses/{{$course->id}}/edit' class="btn btn-warning">Editar</a>
                </td>
            </tr>
        @endforeach

    </tbody>

</table>


@endsection
