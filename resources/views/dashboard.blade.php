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
            <a href="/dashboard/periods">
                <h3> Habilitar y deshabilitar periodo académico</h3>
            </a>
        </div>
        <hr>
        <div>
            <a href="/dashboard/import_data">
                <h3> Carga masiva de estudiantes</h2>
            </a>
        </div>
        @if ($enabled_period)
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
        <div>
            <a href="/dashboard/link_students">
                <h3> Asociar estudiantes en asignaturas</h3>
            </a>
        </div>
        <hr>
        <div>
            <a href="/dashboard/courses">
                <h3> Administrar asignaturas</h3>
            </a>
        </div>
        @endif
        <hr>

        <div>
            <a href="/dashboard/surveys">
                <h3>Crear encuesta</h3>
            </a>

        </div>
        <div>
            <a href="/dashboard/link_survey">
                <h3>Asociar encuesta</h3>
            </a>

        </div>
        <hr>
        <!--Cosas de Ayudante-->
        <div>
            <h3>
                <a href="/dashboard/review_surveys">
                    <h3>Revisar encuestas</h3>
                </a>
            </h3>
        </div>
        <div>
            <h3>
                <a href="/dashboard/review__global">
                    <h3>Revisar indicadores globales</h3>
                </a>
            </h3>
        </div>

    @elseif (Auth::user()->role == "Encargado Docente")
       <!--Cosas de Encargado Docente-->
       <div>
        <a href="/dashboard/periods">
            <h3> Habilitar y deshabilitar periodo académico</h3>
        </a>
    </div>
    <hr>
    <div>
        <a href="/dashboard/import_data">
            <h3> Carga masiva de estudiantes</h2>
        </a>
    </div>
    @if ($enabled_period)
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
    <div>
        <a href="/dashboard/link_students">
            <h3> Asociar estudiantes en asignaturas</h3>
        </a>
    </div>
    <hr>
    <div>
        <a href="/dashboard/courses">
            <h3> Administrar asignaturas</h3>
        </a>
    </div>
    @endif
    <hr>

    <div>
        <a href="/dashboard/surveys">
            <h3>Crear encuesta</h3>
        </a>

    </div>
    <div>
        <a href="/dashboard/link_survey">
            <h3>Asociar encuesta</h3>
        </a>

    </div>
    <hr>
    @elseif (Auth::user()->role == "Ayudante")
        <!--Cosas de Ayudante-->
        <div>
            <h3>
                <a href="/dashboard/review_surveys">
                    <h3>Revisar encuestas</h3>
                </a>
            </h3>
        </div>
        <div>
            <h3>
                <a href="/dashboard/answer">
                    <h3>Responder encuestas</h3>
                </a>
            </h3>
        </div>
    @else
        <!--Cosas de Estudiante-->
        <div>
            <h3>
                <a href="/dashboard/answer">
                    <h3>Responder encuestas</h3>
                </a>
            </h3>
        </div>
    @endif
@endif

{{-- TODO: hacer responsivo con grid boostrap --}}

@endsection
