@extends('layouts.base')
@section('contenido')
    <div>
        <a href="/dashboard">Dashboard</a>
    </div>
    <h3  align = "center">Cambiar contraseña</h3>

    <form action="{{url('password_confirm')}}" method="POST">
        @csrf
        <label for="password">Nueva contraseña</label>
        <input type="password" name="password" id="password" 
            required>
        <br>
        <label for="password">Confirmar contraseña</label>
        <input type="password" name="confirm_password" id="confirm_password"
            required>
        <br>
        <input type="submit" name="submit"  value="Enviar"  id="submit">
    </form>
@endsection


