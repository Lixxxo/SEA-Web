@extends('layouts.base')
@section('contenido')
    <div>
        <a href="/dashboard">Menu Principal</a>
    </div>
    <h2 class = "text-center">
        Listado de encuestas
    </h2>
    <br>
    <table class="table table-dark table-striped mt-4">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Cantidad de preguntas</th>
                <th scope="col">Cantidad de respuestas</th>
                <th scope="col">Estado</th>
                <th scope="col">Acción</th>
            </tr>
    
        </thead>
        <tbody>
            @for($i = 0; $i < count($survey_list); $i++)
                <tr>
                    <td>{{$survey_list[$i]->nombre}}</td>
                    <td>{{$question_qtty_list[$i][0]->cantidadPreguntas}}</td>
                    <td>{{$survey_list[$i]->totalRespuestas}}</td>
                    @if ($survey_list[$i]->estado === 1)
                        <td>Habilitado</td>
                    @else
                        <td>Deshabilitado</td>
                    @endif
    
                    <td>
                        <a href='/dashboard/manage' class="btn btn-primary">Vincular</a>
    
                    </td>
                </tr>
            @endfor
        </tbody>
    
    </table>
    
@endsection