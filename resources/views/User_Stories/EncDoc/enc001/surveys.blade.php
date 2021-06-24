@extends('layouts.base')
@section('contenido')

<div>

    <a href="/dashboard">Menu principal</a>

</div>
<h3 align = "center">Listado de Encuestas</h3>
<div>
    <h4>
        Crear Encuesta
    </h4>
</div>
<div>
    <form action="{{route('createSurvey')}}" method="POST">
        @csrf

        <span>Seleccione el NRC de una asignatura para crear una nueva encuesta</span>
        <br>
        <select name="data" id="data" >
            @foreach($course_list as $course)
                <option value="{{$course->id}},{{$course->codigo_asignatura}},">{{$course->codigo_asignatura}}</option>
            @endforeach
        </select>
        <br>
        <br>
        <input class="btn btn-success" type="submit" value="Crear encuesta"><br>

        <br>
    </form>
</div>
<br>
<table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Cantidad de preguntas</th>
            <th scope="col">Cantidad de respuestas</th>
            <th scope="col">Estado</th>
            <th scope="col">NRC del Curso</td>

            <th scope="col">Acción</th>
        </tr>

    </thead>
    <tbody>
        @for($i = 0; $i < count($survey_list); $i++)
            <tr>
                <td>{{$survey_list[$i]->nombre}}</td>
                <td>{{$question_qtty_list[$i][0]->cantidadPreguntas}}</td>
                <td>{{$survey_list[$i]->totalRespuestas}}</td>
                @if ($survey_list[$i]->estado === 1)
                    <td>Habilitado</td>
                @else
                    <td>Deshabilitado</td>
                @endif
                <td>{{$survey_list[$i]->course_nrc}}</td>


                <td>
                    <a href='/dashboard/surveys/{{$survey_list[$i]->id}}' class="btn btn-warning">Editar</a>

                </td>
            </tr>
        @endfor
    </tbody>

</table>


@endsection
