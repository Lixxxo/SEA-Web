@extends('layouts.base')
@section('contenido')
<div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <x-jet-dropdown-link href="{{ route('logout') }}"
            onclick="event.preventDefault();
                this.closest('form').submit();">
            {{ __('Cerrar Sesión') }}
        </x-jet-dropdown-link>
    </form>
</div>
<div>
    <a href="{{ url('password_change') }}">
        Cambiar Contraseña
    </a>
</div>
<br>
@if (Auth::user()->enabled == 0)
    <div align="center">
        <h3>Cuenta deshabilitada</h3>
    </div>
    <br>
    <div align="center">
        <p>Su cuenta está deshabilitada por el momento.</p>
    </div>
    <br>

@else
    <hr>
    @if (Auth::user()->role == "Administrador")
        <!--Cosas de Administrador-->
        <div>
            <a href="/dashboard/users">
                <h3>Administrar usuarios</h2>
            </a>
        </div>
        <hr>
        <!--Cosas de Encargado Docente-->
        <div>
            <a href="/dashboard/import_data">
                <h3> Carga masiva de estudiantes</h2>
            </a>
        </div>
        <div>
            <a href="/dashboard/import_data_courses">
                <h3> Carga masiva de asignaturas</h2>
            </a>
        </div>
        <div>
            <a href="/dashboard/import_data_assistants">
                <h3> Carga masiva de ayudantes</h2>
            </a>
        </div>
        <hr>
        <div>
            <a href="/dashboard/periods">
                <h3> Habilitar y deshabilitar periodo académico</h3>
            </a>
        </div>
        <hr>
        <div>
            <a href="/dashboard/courses">
                <h3> Administrar asignaturas</h3>
            </a>
        </div>
        <div>
            <a href="/dashboard/surveys">
                <h3>Crear Encuesta</h3>
            </a>

        </div>
        <hr>
        <div>
            Futuras historias de usuario para Ayudante
        </div>

    @elseif (Auth::user()->role == "Encargado Docente")

        <div>
            <a href="/dashboard/import_data">
                <h3> Carga masiva de estudiantes</h2>
            </a>
        </div>
        <div>
            <a href="/dashboard/import_data_courses">
                <h3> Carga masiva de asignaturas</h2>
            </a>
        </div>
        <div>
            <a href="/dashboard/import_data_assistants">
                <h3> Carga masiva de ayudantes</h2>
            </a>
        </div>
        <hr>
        <div>
            <a href="/dashboard/periods">
                <h3> Habilitar y deshabilitar periodo académico</h3>
            </a>
        </div>
        <hr>
        <div>
            <a href="/dashboard/courses">
                <h3> Administrar asignaturas</h3>
            </a>
        </div>
        <hr>
        <div>
            <a href="/dashboard/surveys">
                <h3>Crear Encuesta</h3>
            </a>
        </div>
    @elseif (Auth::user()->role == "Ayudante")

        Futuras historias de usuario para Ayudante
        <hr>
        Futuras historias de usuario para Estudiante

    @else
        Futuras historias de usuario para Estudiante
    @endif
@endif
<script src= "{{asset('/js/notify.min.js')}}"></script>
<scri
</script>
@endsection
