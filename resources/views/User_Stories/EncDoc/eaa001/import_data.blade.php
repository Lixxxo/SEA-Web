
@extends('layouts.base')
@section('contenido')
    <div>
        <a href="/dashboard">Dashboard</a>
    </div>
    <div class = "container">
        <h3  align = "center">Cargar estudiantes</h3>
        <br>
        @if (count($errors) > 0)
            <div class = "alert alert-danger">
                Problema al cargar archivo<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
        @endif

        @if($message = Session::get('success'))
            <div class = "alert alert-success alert-block">
                <button type = "button" class = "close" data-dismiss = "alert">x</button>
                <strong> {{ $message }}</strong>
            </div>
        @endif
        <form method = "post" enctype = "multipart/form-data" action = "{{ url('/import_data/import') }}">
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
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Correo Electronico</th>
                    </tr>
                    @foreach ($data as $row)
                        <tr>
                            <td>{{ $row->rut }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection