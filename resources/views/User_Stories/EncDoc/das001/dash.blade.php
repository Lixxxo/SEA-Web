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
            <p>Encuestas respondidas</p>
            <progress id="progress_all" value="32" max="100">   </progress>
            <label for="progress_all">32%</label>
            <p>Encuestas respondidas</p>
            <progress id="progress_some" value="32" max="100">   </progress>
            <label for="progress_some">32%</label>
            <p>Encuestas respondidas</p>
            <progress id="progress_none" value="32" max="100">   </progress>
            <label for="progress_none">32%</label>


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
