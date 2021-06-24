@extends('layouts.base')
@section('contenido')
    <div align="center">
        <h3>Solicitud de reseteo de contraseña</h3>
    </div>
    <br>
    <div align="center">
        <p>Contacte al administrador al siguiente correo para reestablecer su contraseña.</p>
        <a href = "mailto: {{$admin_email}}">{{$admin_email}}</a>
    </div>
    <br>
    <div>
        <a href="/">Volver</a>
    </div>
@endsection