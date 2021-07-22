@extends('layouts.base')
@section('contenido')
    <div>
        <a href="/dashboard">Menu principal</a>
    </div>
    <div class = "container">
        <h3  align = "center">Cargar asignaturas</h3>
        <br>
        <form method = "post" enctype = "multipart/form-data" action = '/dashboard/import_data_courses/importCourses'>
            @csrf
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
        <br>
        @if (session("courses_list"))
            <div class = "alert alert-danger">
                <h3 class = "text-center">Los cursos con los siguientes nrc ya se encuentran dentro del semestre habilitado</h3>
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
        <br>
        @if (session("courses_duplicate"))
            <div class = "alert alert-danger">
                <h3 class = "text-center">Los siguientes codigos de asignatura ya se encuentran dentro del sistema</h3>
                <table class = "table table-bordered table-striped">
                    <tr>
                        <th>Codigo de asignatura</th>    
                        @foreach (explode(";",session("courses_duplicate")) as $ca)
                            <th>{{$ca}}</th>
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
                        <th>Codigo de Asignatura</th>
                        <th>Rut del profesor</th>
                        <th>Nombre del profesor</th>
                    </tr>
                    @if ($data == null)
                        
                    @else
                        @foreach ($data as $row)
                            <tr>
                                <td>{{ $row->nrc }}</td>
                                <td>{{ $row->codigo_asignatura }}</td>
                                <td>{{ $row->rut_profesor }}</td>
                                <td>{{ $row->nombre_profesor }}</td>
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