@extends('layouts.base')
@section('contenido')
    <div>
        <a href="/dashboard">Dashboard</a>
    </div>
    <div align = "center" >
        <h3 >Cambiar contraseña</h3>
        <h4>
            Una vez cambiada la contraseña deberá volver a iniciar sesión
        </h4>
    </div>
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

@section('script')
    <script src="{{asset("js/notify.min.js")}}"></script>
    <script>
        var status = '{{session("status")}}';
        if (status){
            $.notify(status, "error");
        }
    </script>
    
@endsection
