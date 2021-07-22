@extends('layouts.base')
@section('contenido')

    <div>
        <a href="/dashboard">Menú principal</a>
        <br>
        <a href="/dashboard/surveys">Encuestas</a>
    </div>

    <h3>

        <form action="{{ route('updateSurvey') }}" method="POST">
            @csrf
            <input type="text" name="survey_id" value="{{ $survey->id }}" hidden>
            <label for="nombre"> Editar Encuesta</label>
            <input type="text" value="{{ $survey->nombre }}" name="nombre" />
            <br>
            <label for="habilitado"> Habilitado</label>
            @if ($survey->estado)
                <input class="form-check-input" type="checkbox" id="enabled" name="enabled" checked>
            @else
                <input class="form-check-input" type="checkbox" id="enabled" name="enabled">
            @endif

            <input type="submit" class="btn btn-info" value="Guardar">
        </form>
    </h3>


    <br>
    <form action="{{ route('createQuestion') }}" method="POST">
        @csrf
        <input type="text" name="id" id="id" value="{{ $survey->id }}" hidden>
        <input type="submit" class="btn btn-success" value="Crear Pregunta">
    </form>

    <br>

    @for ($i = 0; $i < count($question_list); $i++)
        @if ($i % 2 == 0) <div style="background-color: azure; padding: 8px"
        class="text-left">
    @else
        <div style="background-color: rgba(221, 221, 221, 0.418); padding: 8px"
        class="text-left"> @endif

        <form action="{{ route('updateQuestion') }}" method="POST">
            @csrf

            <input type="hidden" value="{{ $survey->id }}" name="survey_id" />
            <input type="hidden" value="{{ $question_list[$i]->id }}" name="question_id">
            <label for="frase"> Frase</label>
            <input type="text" size="100" value="{{ $question_list[$i]->frase }}" id="frase" name="frase" />
            <br>
            <label> Indicador</label>
            <br>
            @if ($question_list[$i]->indicador == 1)
                <input type="radio" checked id="indicador1_{{ $i }}" onclick="document.getElementById('indicador2_{{ $i }}').checked = false;
                                document.getElementById('indicador1_{{ $i }}').checked = true;
                                document.getElementById('indicador_{{ $i }}').value = '1';">
                <label for="indicador1_{{ $i }}">
                    1 (Totalmente de acuerdo, De acuerdo, Ni de acuerdo ni en desacuerdo, En desacuerdo, Totalmente en
                    desacuerdo)
                </label>
                <br>
                <input type="radio" id="indicador2_{{ $i }}" onclick="document.getElementById('indicador1_{{ $i }}').checked = false;
                            document.getElementById('indicador2_{{ $i }}').checked = true;
                            document.getElementById('indicador_{{ $i }}').value = '2';">
                <label for="indicador2_{{ $i }}">
                    2 (Sí, No)
                </label>
            @else
                <input type="radio" id="indicador1_{{ $i }}" onclick="document.getElementById('indicador2_{{ $i }}').checked = false;
                            document.getElementById('indicador1_{{ $i }}').checked = true;
                            document.getElementById('indicador_{{ $i }}').value = '1';">
                <label for="indicador1_{{ $i }}">
                    1 (Totalmente de acuerdo, De acuerdo, Ni de acuerdo ni en desacuerdo, En desacuerdo, Totalmente en
                    desacuerdo)
                </label>
                <br>
                <input type="radio" checked id="indicador2_{{ $i }}" onclick="document.getElementById('indicador1_{{ $i }}').checked = false;
                        document.getElementById('indicador2_{{ $i }}').checked = true;
                        document.getElementById('indicador_{{ $i }}').value = '2';">
                <label for="indicador2_{{ $i }}">
                    2 (Sí, No)
                </label>
            @endif
            <input type="number" hidden name="indicador" id="indicador_{{ $i }}"
                value="{{ $question_list[$i]->indicador }}">
            <br>
            <label>Cantidad de respuestas: </label>
            <strong>{{ $question_list[$i]->cantRespuestas }}</strong>
            <br>
            <button type="submit" class="btn btn-info">Guardar pregunta</button>
        </form>
        <div class="text-right">
            <form action="{{ route('deleteQuestion') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $survey->id }}" name="survey_id" />
                <input type="hidden" value="{{ $question_list[$i]->id }}" name="question_id">
                <button type="submit" class="btn btn-danger">Eliminar Pregunta</button>
            </form>
        </div>

        </div>
        <br>
    @endfor


@endsection
@section('script')

    <script>
        var stateValue = $("enabled").is("checked") ? true : false;
    </script>

    <script src="{{ asset('js/notify.min.js') }}"></script>
    <script>
        var status = '{{ session('status') }}';
        if (status) {
            $.notify(status, "error");
        }
    </script>

@endsection
