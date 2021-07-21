@extends('layouts.base')
@section('contenido')
    <div>
        <a href="/dashboard">Menu Principal</a>
    </div>
    <div>
        <a href="/dashboard/manage_surveys">Volver</a>
    </div>
    <h2 class = "text-center">
        Listado de cursos
    </h2>
    <form method= "POST" action="{{route('link_survey')}}">
        {{ csrf_field() }}
        <table class = "table">
            <tr>
                <th>NRC</th>
                <th>Codigo Asignatura</th>
                <th>ID encuesta asociada</th>
                <th>Chequeo</th>
            </tr>
            <input type="text" name = "survey_associate" value="{{ $survey_id }}" hidden>
            @if ($data == null)
                
            @else
                @for($i = 0; $i < count($data); $i++)
                    <tr>
                        <td>{{ $data[$i]->nrc }}</td>
                        <td>{{ $data[$i]->codigo_asignatura }}</td>
                        <td>{{ $data[$i]->Surveysid }}</td>
                        @if($data[$i]->Surveysid == null)
                        <td>
                            <input type="checkbox" name="check{{$data[$i]->nrc}}">  
                        </td>
                        @else
                            <td><p>Ya hay una encuesta asociada</p></td>
                        @endif
                    </tr> 
                @endfor
            @endif
        </table>
        <div class = "text-center">
            <input type="submit" value="Vincular">
        </div>
    </form>
@endsection
@section('script')
    <script src="{{asset("js/notify.min.js")}}"></script>
    <script>
        var success = '{{session("success")}}';
        var error = '{{session("error")}}';
        if (error){
            $.notify(error, "error");
        }
        if (success){
            $.notify(success, "success")
        }
    </script>
@endsection