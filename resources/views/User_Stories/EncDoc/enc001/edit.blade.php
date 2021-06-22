@extends('layouts.base')
@section('contenido')

<div>
    <a href="/dashboard">Dashboard</a>
    <br>
    <a href="/dashboard/surveys">Encuestas</a>
</div>
<h3 align = "center">Editar Encuesta {{$survey->nombre}}</h3>


<br>
<form action="/dashboard/surveys/{{$survey->id}}}/createQuestion" method="POST">
@csrf

<input type="submit" class="btn btn-success" value="Crear Pregunta">
</form>

<br>
<table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
            <th scope="col">Frase</th>
            <th scope="col"></th>
            <th scope="col">Indicador</th>
            <th scope="col"></th>
            <th scope="col">Cantidad de respuestas</th>
        </tr>

    </thead>
    @foreach($question_list as $question)
    <tbody>
            <tr>
                <td>{{$question->frase}}</td>
                <td><input type="text"></td>
                <td>{{$question->indicador}}</td>
                <td><input type="text"></td>
                <td>{{$question->cantRespuestas}}</td>
                <td><input type="text"></td>
                <br>
            </tr>
    </tbody>
    @endforeach


</table>
@endsection