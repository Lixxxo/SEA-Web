@extends('layouts.base')
@section('contenido')
<h2>Actualizar Asignatura</h2>
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
            <label class="form-label">Código de Asignatura</label>
            <input id="codigo_asignatura" name="codigo_asignatura" type="text" class="form-control"
                tabindex="2" value="{{$course->codigo_asignatura}}">
        </div>
        <br>
        <!--Rut profesor-->
        <div class="mb-3">
            <label class="form-label">Rut Profesor</label>
            <input id="rut_profesor" name="rut_profesor" type="text" class="form-control"
                tabindex="3" value="{{$course->rut_profesor}}">
        </div>
        <br>
        <!--Nombre profesor-->
        <div class="mb-3">
            <label class="form-label">Nombre Profesor</label>
            <input id="nombre_profesor" name="nombre_profesor" type="text" class="form-control"
                tabindex="4" value="{{$course->nombre_profesor}}">
        </div>
        <br>

        <br>
        <a href="/dashboard/courses" class="btn btn-secondary" tabindex="7">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="8">Guardar</button>
    </form>

@endsection
