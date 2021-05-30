@extends('layouts.base')
@section('contenido')
    <div>
        <a href="/dashboard">Dashboard</a>
    </div>
    <h3  align = "center">Cambiar contraseña</h3>

    @if($message = Session::get('success'))
        <div class = "alert alert-success alert-block">
            <button type = "button" class = "close" data-dismiss = "alert">x</button>
            <strong> {{ $message }}</strong>
        </div>
    @elseif($message = Session::get('error'))
    <div class = "alert alert-warning alert-block">
        <button type = "button" class = "close" data-dismiss = "alert">x</button>
        <strong> {{ $message }}</strong>
    </div>
    @endif

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


