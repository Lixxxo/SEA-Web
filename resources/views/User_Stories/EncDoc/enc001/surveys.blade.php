@extends('layouts.base')
@section('contenido')

<div>
    <a href="/dashboard">Dashboard</a>
    
</div>
<h3 align = "center">Listado de Encuestas</h3>
<div>
    <h4>
        Crear Encuesta
    </h4>
</div>
<div>
    <form action="/dashboard/surveys" method="POST">
        @csrf
        
        <h5>Sleccione una asignatura para crear una nueva encuesta</h5>
        <select name="data" id="data" >
            @foreach($course_list as $course)
                <option value="{{$course->nrc}},{{$course->codigo_asignatura}}">{{$course->codigo_asignatura}}</option>
            @endforeach
        </select>
        <br>
        <br>
        <input class="btn btn-success" type="submit"><br>
        
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
        @foreach($survey_list as $survey)
            <tr>
                <td>{{$survey->nombre}}</td>
                <td>{{$survey->cantidad_preguntas}}</td>
                <td>{{$survey->totalRespuestas}}</td>
                @if ($survey->estado === 1)
                    <td>Habilitado</td>
                @else
                    <td>Deshabilitado</td>
                @endif
                <td>{{$survey->Coursesnrc}}</td>
                
                
                <td>
                    <a href='/dashboard/surveys/{{$survey->id}}/edit' class="btn btn-warning">Editar</a>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>


@endsection