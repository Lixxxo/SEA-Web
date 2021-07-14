@extends('layouts.base')
@section('contenido')
    <div>
        <a href="/dashboard">Menu principal</a>
    </div>
    <div class = "container">
        <h3  align = "center">Cargar ayudantes</h3>
        <br>
        <form method = "post" enctype = "multipart/form-data" action = '/dashboard/import_data_assistants/importAssistants'>
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

        <br/>
        <div class = "panel-default">
            <div class = "panel-body">
                <div class = "table-responsive">
                    <table class = "table table-bordered table-striped">
                    <tr>
                        <th>NRC</th>
                        <th>Rut del ayudante</th>
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