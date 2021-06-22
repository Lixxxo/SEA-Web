@extends('layouts.base')
@section('contenido')

<div>
    <h2>
        Crear Encuestas
    </h2>
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
        <input type="submit">
    </form>
</div>

<div>
    @foreach($survey_list as $survey)
        <div>
            <tr>
                <td>
                    {{$survey->nombre}}
                </td>
                <td>
                    <a href="" type="button">{{$survey->id}}</a>

                </td>
            </tr>
        </div>
    @endforeach
</div>


@endsection