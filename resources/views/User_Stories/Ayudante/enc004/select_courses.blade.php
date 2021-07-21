@extends('layouts.base')
@section('contenido')
<div>
    <a href="/dashboard">Menu Principal</a>
</div>
<h2 class = "text-center">
    Listado de cursos
</h2>
<br>
<table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
            <th scope="col">NRC</th>
            <th scope="col">Codigo de asignatura</th>
            <th scope="col">Nombre del profesor</th>
            <th scope="col">Rut del profesor</th>
            <th scope="col">Accion</th>
        </tr>
    </thead>

    <tbody>
        @for($i = 0; $i < count($courses_list); $i++)
            <tr>
                <td>{{$courses_list[$i]->nrc}}</td>
                <td>{{$courses_list[$i]->codigo_asignatura}}</td>
                <td>{{$courses_list[$i]->nombre_profesor}}</td>
                <td>{{$courses_list[$i]->rut_profesor}}</td>
                <td>
                    <form action="{{ route('reviewSurvey') }}">
                        <input name = "courses_nrc" type="text" value = "{{ $courses_list[$i]->nrc }}" hidden>
                        <input type="submit" value="Ver Grafico">
                    </form>
                </td>
            </tr>
        @endfor
    </tbody>

</table>


@endsection