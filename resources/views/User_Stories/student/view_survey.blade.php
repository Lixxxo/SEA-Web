@extends('layouts.base')

<title>Responder encuesta</title>

@section('contenido')

    <div>
        <a href="/dashboard">Menú principal</a>
    </div>
    <fieldset>
        <legend>Responder encuestas</legend>
    </fieldset>
    <form action="{{ route('answerSurvey') }}" method="POST">
        @csrf
        @for ($i = 0; $i < count($question_list); $i++)
            <div class="question-container">
                <p class="question">{{ $question_list[$i]->frase }}</p>
                @if ($question_list[$i]->indicador == 1)

                    <div class="radio-answer">

                        <input type="radio" name="answer{{ $i }}" value="4" required>
                        <input type="text" name="question{{ $i }}" hidden value="{{ $question_list[$i]->id }}">
                        <label for="answer{{ $i }}">Totalmente de acuerdo</label>
                        <br>

                        <input type="radio" name="answer{{ $i }}" value="3" required>
                        <input type="text" name="question{{ $i }}" hidden value="{{ $question_list[$i]->id }}">
                        <label for="answer{{ $i }}">De acuerdo</label>
                        <br>

                        <input type="radio" name="answer{{ $i }}" value="2" required>
                        <input type="text" name="question{{ $i }}" hidden value="{{ $question_list[$i]->id }}">
                        <label for="answer{{ $i }}">Ni de acuerdo ni en desacuerdo</label>
                        <br>

                        <input type="radio" name="answer{{ $i }}" value="1" required>
                        <input type="text" name="question{{ $i }}" hidden value="{{ $question_list[$i]->id }}">
                        <label for="answer{{ $i }}">En desacuerdo</label>
                        <br>

                        <input type="radio" name="answer{{ $i }}" value="0" required>
                        <input type="text" name="question{{ $i }}" hidden value="{{ $question_list[$i]->id }}">
                        <label for="answer{{ $i }}">Totalmente en desacuerdo</label>
                        <br>
                    </div>
                @else
                    <div class="radio-answer">
                        <input type="radio" name="answer{{ $i }}" value="1" required>
                        <input type="text" name="question{{ $i }}" hidden value="{{ $question_list[$i]->id }}">
                        <label for="answer{{ $i }}">Si</label>
                        <br>

                        <input type="radio" name="answer{{ $i }}" value="0" required>
                        <input type="text" name="question{{ $i }}" hidden value="{{ $question_list[$i]->id }}">
                        <label for="answer{{ $i }}">No</label>
                        <br>
                    </div>
                @endif
            </div>
        @endfor
        <input type="submit" value="Responder" onclick="return verification()">
        <input type="text" name="rut" hidden value="{{ $user->rut }}">
        <input type="text" name="courseid" hidden value="{{ $courseid }}">
        <input type="text" name="questions_number" hidden value="{{count($question_list)}}">
    </form>
@endsection

@section('script')
    <script>
        function verification() {
            if (!confirm("¿Responder encuesta? Solo puedes responder una vez")) {
                event.preventDefault();
            }
        }
    </script>
@endsection
