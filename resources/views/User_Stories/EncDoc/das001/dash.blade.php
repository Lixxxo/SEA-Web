@extends('layouts.base')

<title>Estadísticas globales</title>
@section('contenido')

    <div>
        <a href="/dashboard">Menú principal</a>
    </div>
    <fieldset>
        <legend>Visualizar indicadores</legend>
    </fieldset>
    <div class="row">
        <div class="col-sm-3">

            @if ($total_students == 0)
            <p>No hay estudiantes inscritos este período</p>
            @else
            <p>Estudiantes que respondieron todas las encuestas</p>
            <progress id="progress_all" value="{{$answered_all}}" max="{{$total_students}}">   </progress>
            <label for="progress_all">{{($answered_all * 100) / $total_students}}%</label>
            <p>Estudiantes que respondieron algunas encuestas</p>
            <progress id="progress_some" value="{{$answered_some}}"" max=>"{{$total_students}}"   </progress>
            <label for="progress_some">{{($answered_some * 100) / $total_students}}%</label>
            <p>Estudiantes que no respondieron ninguna encuesta</p>
            <progress id="progress_none" value="{{$answered_none}}" max="{{$total_students}}">   </progress>
            <label for="progress_none">{{($answered_none * 100) / $total_students}}%</label>
            @endif

        </div>
        <div class="col-sm-3">
            <p>Asignaturas sin encuestas activas</p>
            <table>
                <thead>
                    <th class="header">nrc</th>
                    <th class="header">código</th>
                </thead>
            </table>
            <p>Asignaturas con encuestas activas sin respuestas</p>
            <table>
                <thead>
                    <th class="header">nrc</th>
                    <th class="header">código</th>
                </thead>
            </table>
        </div>
        <div class="col-sm-3">
            <p>Indicadores por asignaturas</p>
        </div>
        <div class="col-sm-3">
            <p>Indicadores por ayudantes</p>
        </div>
    </div>
    <div class="row">
        <p>Consolidado por ayudante</p>
    </div>

    <div class="row"></div>

@endsection
@section('script')

@endsection
