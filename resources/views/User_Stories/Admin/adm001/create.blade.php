@extends('layouts.base')

@section('contenido')
  <h2>Crear Usuarios</h2>

  <form action="/dashboard/users" method="POST">
      @csrf
    <!--Rut-->
    <div class="mb-3">
      <label for="" class="form-label">Rut (sin puntos y con guión : 12345678-9)</label>
      <input id="rut" name="rut" type="text" class="form-control" tabindex="1">    
    </div>
    <!--Nombre Completo-->
    <div class="mb-3">
      <label for="" class="form-label">Nombre completo</label>
      <input id="full_name" name="full_name" type="text" class="form-control" tabindex="2">
    </div>
    <!--Email-->
    
    <div class="mb-3">
      <label for="" class="form-label">Email</label>
      <input id="email" name="email" type="email" class="form-control" tabindex="3">
    </div>
    <!--Rol-->
    <div class="mb-3">
      <label for="" class="form-label">Rol</label>
      <select class="form-select" id="role" name="role">
        <option selected>Estudiante</option>
        <option value="Ayudante">Ayudante</option>
        <option value="Encargado Docente">Encargado Docente</option>
      </select>
    </div>
    <a href="/dashboard/users" class="btn btn-secondary" tabindex="5">Cancelar</a>

    <button type="submit" class="btn btn-primary" tabindex="6">Guardar</button>
  </form>

@endsection