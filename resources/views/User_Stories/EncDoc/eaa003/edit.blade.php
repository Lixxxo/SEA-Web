@extends('layouts.base')
@section('contenido')
<h2>Actualizar asignatura</h2>
    <form action="/dashboard/courses/{{$course->nrc}}" method="POST">
        @csrf
        @method('PUT')
        <!--NRC-->

        <div class="mb-3">
            <label class="form-label">NRC</label>
            <input type="text" id="nrc" name="nrc" required

            class="form-control" tabindex="1" value="{{$course->nrc}}">
        </div>
        <br>
        <!--Codigo-->
        <div class="mb-3">
            <label class="form-label">Código de asignatura</label>
            <input id="code" name="code" type="text" class="form-control"
                tabindex="2" value="{{$course->codigo_asignatura}}">
        </div>
        <br>
        <!--Email-->
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input id="email" name="email" type="email" class="form-control"
                tabindex="3" value="{{$user->email}}">
        </div>
        <br>

        <br>
        <!--Rol-->
        <div class="mb-3">
            <label class="form-label">Rol</label>
            <br>
            <select class="form-select" id="role" name="role">
              <option selected>{{$user->role}}</option>
              <option value="Ayudante">Estudiante</option>
              <option value="Ayudante">Ayudante</option>
              <option value="Encargado Docente">Encargado Docente</option>
            </select>
          </div>
          <br>
        <!--Estado-->
        <div class="form-check form-switch">

            @if ($user->enabled)
                <input class="form-check-input" type="checkbox"
                    id="enabled" name = "enabled" checked>
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
        var stateValue = $("enabled").is("checked") ? true : false;
    </script>

@endsection
