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
            <label> Indicador</label>
            @if ($question->indicador == 1)
                <input type="radio" checked
                id="indicador1"
                onclick="document.getElementById('indicador2').checked = false;
                        document.getElementById('indicador1').checked = true;
                        document.getElementById('indicador').value = '1';"> 1
                <input type="radio"
                id="indicador2"
                onclick="document.getElementById('indicador1').checked = false;
                    document.getElementById('indicador2').checked = true;
                    document.getElementById('indicador').value = '2';"> 2
                <input type="number" hidden name="indicador" id="indicador" value="{{$question->indicador}}">
            
            @else
                <input type="radio" 
                id="indicador1"
                onclick="document.getElementById('indicador2').checked = false;
                        document.getElementById('indicador1').checked = true;
                        document.getElementById('indicador').value = '1';"> 1
                <input type="radio" checked
                id="indicador2"
                onclick="document.getElementById('indicador1').checked = false;
                    document.getElementById('indicador2').checked = true;
                    document.getElementById('indicador').value = '2';"> 2
                <input type="number" hidden name="indicador" id="indicador" value="{{$question->indicador}}">
            
            @endif
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


@endsection
@section('script')

    <script>
        var stateValue = $("enabled").is("checked") ? true : false;
    </script>

    <script src="{{asset("js/notify.min.js")}}"></script>
    <script>
        var status = '{{session("status")}}';
        if (status){
            $.notify(status, "error");
        }
    </script>
    
@endsection
