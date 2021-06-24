@extends('layouts.base')
@section('contenido')

<div>
    <a href="/dashboard">Menu principal</a>
    <br>
    <a href="/dashboard/surveys">Encuestas</a>
</div>

<h3 align = "center">

    <form action="{{route('updateSurvey')}}" method="POST">
        @csrf
        <input type="text" name="survey_id" value="{{$survey->id}}" hidden>
        <label for="nombre"> Editar Encuesta</label>
        <input type="text" value="{{$survey->nombre}}"  name="nombre" />
        <br>
        <label for="habilitado"> Habilitado</label>
        @if ($survey->estado)
            <input class="form-check-input" type="checkbox"
                id="enabled" name = "enabled" checked>
        @else
            <input class="form-check-input" type="checkbox"
                id="enabled" name = "enabled" >
        @endif

        <input type="submit" class="btn btn-info" value="Guardar">
    </form>
</h3>


<br>
<form action="{{route('createQuestion')}}" method="POST">
    @csrf
    <input type="text" name="id" id="id" value="{{$survey->id}}" hidden>
    <input type="submit" class="btn btn-success" value="Crear Pregunta">
</form>

<br>

    @foreach($question_list as $question)
        <form action="{{route('updateQuestion')}}" method="POST">
            @csrf

            <input type="hidden" value="{{$survey->id}}" name="survey_id"/>
            <input type="hidden" value="{{$question->id}}"  name="question_id">
            <label for="frase"> Frase</label>
            <input type="text" size = "100" value="{{$question->frase}}" id="frase" name="frase" />
            <br>
            <label for="indicador"> Indicador</label>
            <input type="number" min="1" max="2" value="{{$question->indicador}}" id="indicador" name="indicador" />
            <br>
            <label >Cantidad respuestas</label>
            {{$question->cantRespuestas}}
            <br>
            <button type="submit" class="btn btn-warning">Editar</button>
        </form>
        <form action="{{route('deleteQuestion')}}" method="POST">
            @csrf
            <input type="hidden" value="{{$survey->id}}" name="survey_id"/>
            <input type="hidden" value="{{$question->id}}"  name="question_id">
            <button type="submit" class="btn btn-danger">Eliminar Pregunta</button>
        </form>
        <br>
    @endforeach

    <script>
        var stateValue = $("enabled").is("checked") ? true : false;
    </script>
@endsection
