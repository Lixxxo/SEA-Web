@extends('layouts.base')
@section('contenido')
    <div>
        <a href="/dashboard">Menu principal</a>
    </div>
    <div class = "container">
        <h3 align = "center">Asociar estudiantes</h3>
        <br>
        <form method = "post" enctype = "multipart/form-data" action = '/dashboard/import_data_associate/importAssociate'>
            {{ csrf_field() }}
            <div class = "form-group">
                <table class = "table">
                    <tr>
                        <td width = "40%" align = "right">
                            <label>Agregar archivo</label>
                        </td>
                        <td width = "30">
                            <input type = "file" name = "select_file">
                        </td>
                        <td width = "30%" align = "left">
                            <input type = "submit" name = "upload" class = "btn btn-primary" value = "Cargar">
                        </td>
                    </tr>
                    <tr>
                        <td width = "40%" align = "right"></td>
                        <td width = "30">
                            <span class = "text-muted">.xls .xlsx .csv .dat </span>
                        </td>
                        <td width = "30%" align = "left"></td>
                    </tr>
                </table>
            </div>
        </form>
        @if (session("courses_list"))
            <div class = "alert alert-danger">
                <h3 class = "text-center">Los cursos con los siguientes nrc no se encuentran dentro del semestre habilitado</h3>
                <table class = "table table-bordered table-striped">
                    <tr>
                        <th>NRC</th>    
                        @foreach (explode(";",session("courses_list")) as $nrc)
                            <th>{{$nrc}}</th>
                        @endforeach
                    </tr>
                </table>
                <br>
            </div> 
        @endif
        @if (session("students_list"))
            <div class = "alert alert-danger">
                <h3 class = "text-center">Los estudiantes con los siguientes rut no se encuentran dentro del sistema</h3>
                <table class = "table table-bordered table-striped">
                    <tr>
                        <th>Rut</th>    
                        @foreach (explode(";",session("students_list")) as $rut)
                            <th>{{$rut}}</th>
                        @endforeach
                    </tr>
                </table>
                <br>
            </div> 
        @endif
        @if (session("students_C_list") && session("courses_C_list"))
            <div class = "alert alert-danger">
                <h3 class = "text-center">El estudiante con el siguiente rut ya es estudiante del curso con el siguientes nrc</h3>
                <table class = "table table-bordered table-striped">
                    <tr>
                        <th>Rut</th>
                        <th>NRC</th>
                        @for ($i = 0; $i < count(explode(";",session("students_C_list"))); $i++)
                            @php
                                $courses_nrc = explode(";",session("courses_C_list"));
                                $students_rut = explode(";",session("students_C_list"));
                            @endphp
                            <tr>
                                <td>{{$students_rut[$i]}}</td>
                                <td>{{$courses_nrc[$i]}}</td>
                            </tr>
                        @endfor
                    </tr>
                </table>
                <br>
            </div> 
        @endif
        @if (session("courses_verify"))
            <div class = "alert alert-danger">
                <h3 class = "text-center">Los cursos con los siguientes nrc no se encuentran en el sistema</h3>
                <table class = "table table-bordered table-striped">
                    <tr>
                        <th>NRC</th>    
                        @foreach (explode(";",session("courses_verify")) as $nrc)
                            <th>{{$nrc}}</th>
                        @endforeach
                    </tr>
                </table>
                <br>
            </div> 
        @endif
    <br/> 
        <div class = "panel-default">
            <div class = "panel-body">
                <div class = "table-responsive">
                    <table class = "table table-bordered table-striped">
                    <tr>
                        <th>NRC</th>
                        <th>Rut del estudiante</th>
                    </tr>
                    @if ($data == null)
                    
                    @else
                        @foreach ($data as $row)
                            <tr>
                                <td>{{ $row->nrc }}</td>
                                <td>{{ $row->Usersrut }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
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