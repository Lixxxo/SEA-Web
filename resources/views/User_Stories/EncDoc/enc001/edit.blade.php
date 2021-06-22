@extends('layouts.base')
@section('contenido')

<div>
    <a href="/dashboard">Dashboard</a>
    <br>
    <a href="/dashboard/surveys">Encuestas</a>
</div>
<h3 align = "center">Editar Encuesta {{$survey->nombre}}</h3>


<br>
<form action="/dashboard/surveys/createQuestion" method="POST">
    @csrf
    <input type="text" name="id" id="id" value="{{$survey->id}}" hidden>
    <input type="submit" class="btn btn-success" value="Crear Pregunta">
</form>

<br>
<table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">Frase</th>
            
            <th scope="col">Indicador</th>
            
            <th scope="col">Cantidad de respuestas</th>
        </tr>

    </thead>
    @foreach($question_list as $question)
    <tbody>
        <tr>
            <td><form id="editForm" action="/dashboard/surveys/editQuestion" method="POST">         
                @csrf    
            <input type="hidden" value="{{$survey->id}}" name="survey_id"/></form></td>
            <td><input form="editForm" type="text" value="{{$question->frase}}" name="frase" /></td>
            <td><input form="editForm" type="number" min="1" max="2" value="{{$question->indicador}}"  name="indicador" /></td>
            <td>{{$question->cantRespuestas}}</td>
            <td><input form="editForm" type="submit" value="Guardar" /></td>

            <br>
        </tr>
    </tbody>
    @endforeach


</table>
@endsection