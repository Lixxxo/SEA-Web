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
            <h3>Porcentajes encuestas</>
                <hr>
            @if ($total_students == 0)
            <p>No hay estudiantes inscritos este período</p>
            @else
            <p>Estudiantes que respondieron todas las encuestas</p>
            
            <div class="progress" style="height: 24px; background: green ">
                <div class="progress-bar bg-success" role="progressbar" 
                style="width: {{round(($answered_all * 100) / $total_students, 0)+ 2}}%;"
                >
                <p style="color: black"> {{round(($answered_all * 100) / $total_students, 1)}}% </p>
                </div>
            </div>
            <label for="progress_all"></label>
            <p>Estudiantes que respondieron algunas encuestas</p>

            <div class="progress" style="height: 24x; background:gold">
                <div class="progress-bar bg-success" role="progressbar" 
                style="width: {{round(($answered_some * 100) / $total_students, 0) + 2}}%;"
                >
               <p style="color: black"> {{round(($answered_some * 100) / $total_students, 1)}}%</p>
                </div>
            </div>
            <p>Estudiantes que no respondieron ninguna encuesta</p>
           
            <div class="progress" style="height: 24px; background:rgb(228, 52, 52)">
                <div class="progress-bar bg-success" role="progressbar" 
                style="width: {{round(($answered_none * 100) / $total_students, 0) + 2}}%;"
                >
                <p style="color: black"> {{round(($answered_none * 100) / $total_students, 1) }}% </p>
                </div>
            </div>

            @endif

        </div>
        <div class="col-sm-3">
            <p>Asignaturas sin encuestas activas</p>
            <table>
                <thead>
                    <th class="header">nrc</th>
                    <th class="header">código</th>
                </thead>
                <tbody>
                @foreach ($courses_without_surveys as $item)
                    <tr>
                        <td>{{$item->nrc}}</td>
                        <td>{{$item->codigo_asignatura}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <p>Asignaturas con encuestas activas sin respuestas</p>
            <table>
                <thead>
                    <th class="header">nrc</th>
                    <th class="header">código</th>
                </thead>
                <tbody>
                    @foreach ($courses_with_surveys_without_answers as $item)
                        <tr>
                            <td>{{$item->nrc}}</td>
                            <td>{{$item->codigo_asignatura}}</td>
                        </tr>
                    @endforeach
                </tbody>
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
