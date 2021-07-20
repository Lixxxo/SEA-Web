@extends('layouts.base')

@section('contenido')
    <div>
        <a href="/dashboard">Dashboard</a>
    </div>
    <h3 align="center">Listado de Asignaturas</h3>

    <table>
        <thead>
            <tr>
                <th id="header" scope="col">NRC</th>
                <th id="header" scope="col">Código de Asignatura</th>
                <th id="header" scope="col">Profesor</th>
                <th id="header" scope="col">Rut</th>
                <th id="header" scope="col">Rut Ayudantes</th>
                <th id="header" scope="col">Acción</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < count($course_list); $i++)
                <tr>
                    <td>{{ $course_list[$i]->nrc }}</td>
                    <td>{{ $course_list[$i]->codigo_asignatura }}</td>
                    <td>{{ $course_list[$i]->nombre_profesor }}</td>
                    <td>{{ $course_list[$i]->rut_profesor }}</td>
                    <td>
                        @foreach ($assistant_matrix[$i] as $assistant)
                            <ul>{{ $assistant->name }}</ul>
                        @endforeach
                    <td>
                        <a href='/dashboard/courses/{{ $course_list[$i]->id }}/edit' class="btn btn-warning">Editar</a>
                        <a href="/dashboard/courses/" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
            @endfor

        </tbody>

    </table>


@endsection
