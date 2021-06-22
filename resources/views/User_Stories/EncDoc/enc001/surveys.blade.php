@extends('layouts.base')
@section('contenido')

<div>
    <h2>
        Crear Encuestas
    </h2>
</div>
<div>
    <h4>
        <a href="/dashboard/surveys/create">
            Nueva Encuesta
        </a>
    </h4>
</div>

<div>
    @foreach($survey_list as $survey)
        <div>
            <h5>
                <a href="">{{$survey}}</a>
            </h5>
        </div>
    @endforeach
</div>

@endsection