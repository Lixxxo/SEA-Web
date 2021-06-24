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
            <th scope="col">Rut Profesor</td>
            <th scope="col">Ayudantes</td>
        </tr>
    </thead>
    <tbody>
        @for($i= 0; $i< count($course_list); $i++)
            <tr>
                <td>{{$course_list[$i]->nrc}}</td>
                <td>{{$course_list[$i]->codigo_asignatura}}</td>
                <td>{{$course_list[$i]->nombre_profesor}}</td>
                <td>{{$course_list[$i]->rut_profesor}}</td>
                <td>
                @foreach($assistant_matrix[$i] as $assistant)
                    <ul>{{$assistant->name}}</ul>
                @endforeach
                <td>
                    <a href='/dashboard/courses/{{$course_list[$i]->id}}/edit' class="btn btn-warning">Editar</a>
                </td>
            </tr>
        @endfor

    </tbody>

</table>


@endsection
