@extends('layouts.base')

<title>Responder encuesta</title>

@section('contenido')

    <div>
        <a href="/dashboard">Menú principal</a>
    </div>
    <fieldset>
        <legend>Responder encuestas</legend>
    </fieldset>
    <form action="">
        @for ($i = 0; $i < count($question_list); $i++)
            <div class="question-container">
                <p class="question">{{ $question_list[$i]->frase }}</p>
                @if ($question_list[$i]->indicador == 1)

                    <div class="radio-answer">

                        <input type="radio" name="answer{{ $i }}" value="4" required>
                        <label for="answer{{ $i }}">Totalmente de acuerdo</label>
                        <br>

                        <input type="radio" name="answer{{ $i }}" value="3" required>
                        <label for="answer{{ $i }}">De acuerdo</label>
                        <br>

                        <input type="radio" name="answer{{ $i }}" value="2" required>
                        <label for="answer{{ $i }}">Ni de acuerdo ni en desacuerdo</label>
                        <br>

                        <input type="radio" name="answer{{ $i }}" value="1" required>
                        <label for="answer{{ $i }}">En desacuerdo</label>
                        <br>

                        <input type="radio" name="answer{{ $i }}" value="0" required>
                        <label for="answer{{ $i }}">Totalmente en desacuerdo</label>
                        <br>
                    </div>
                @else
                    <div class="radio-answer">
                        <input type="radio" name="answer{{ $i }}" value="1" required>
                        <label for="answer{{ $i }}">Si</label>
                        <br>

                        <input type="radio" name="answer{{ $i }}" value="0" required>
                        <label for="answer{{ $i }}">No</label>
                        <br>
                    </div>
                @endif
            </div>
        @endfor
        <input type="submit" value="Responder">
    </form>
@endsection

@section('script')

@endsection
