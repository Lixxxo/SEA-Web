@extends('layouts.base')
@section('contenido')
    <h2>Actualizar usuario</h2>
    <form action="/dashboard/users/{{$user->id}}" method="POST">
        @csrf    
        @method('PUT')
        <!--Rut-->
        
        <div class="mb-3">
            <label class="form-label">Rut</label>
            <input id="rut" name="rut" type="text" class="form-control" 
                    tabindex="1" value="{{$user->rut}}">    
        </div>
        <br>
        <!--Nombre Completo-->
        <div class="mb-3">
            <label class="form-label">Nombre completo</label>
            <input id="full_name" name="full_name" type="text" class="form-control" 
                tabindex="2" value="{{$user->name}}">
        </div>
        <br>
        <!--Email-->
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input id="email" name="email" type="email" class="form-control" 
                tabindex="3" value="{{$user->email}}">
        </div>
        <br>
        <!--Clave-->
        <div class="mb-3">
            <label class="form-label">Clave</label>
            <input id="password" name="password" type="text" class="form-control" 
                tabindex="4" value="{{$user->password}}">
        </div>
        <br>
        <!--Rol-->
        <div class="mb-3">
            <label class="form-label">Rol</label>
            <br>
            <select class="form-select" id="role" name="role">
              <option selected>Estudiante</option>
              <option value="Ayudante">Ayudante</option>
              <option value="Encargado Docente">Encargado Docente</option>
            </select>
          </div>
          <br>
        <!--Estado-->
        <div class="form-check form-switch">
            
            @if ($user->enabled === 1)
                <input class="form-check-input" type="checkbox" 
                    id="status" name = "status" checked>                   
            @else
                <input class="form-check-input" type="checkbox" 
                    id="enabled" name = "enabled" >
            @endif
            <label class="form-check-label" for="flexSwitchCheckDefault">Habilitado</label>
            <br>
          </div>
        <a href="/dashboard/users" class="btn btn-secondary" tabindex="7">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="8">Guardar</button>
    </form>

    <script>
        var stateValue = $("enabled").is(":checked") ? $("enabled").val() : null;
    </script>
@endsection