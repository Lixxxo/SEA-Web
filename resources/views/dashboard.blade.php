@extends('layouts.base')
@section('contenido')
    <br>
    <div>
        <img alt="UCN" width="100" src="img/ucn-logo.png" />
        <h1>Bienvenido</h1>    
    </div>
    
    <div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
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
        @if (Auth::user()->role == 'Administrador')

            <!--Cosas de Administrador-->
            <div>
                <a href="/dashboard/users">
                    <h4>Administrar usuarios</h4>
                </a>
            </div>
            <hr>
            <!--Cosas de Encargado Docente-->
            <div>
                <a href="/dashboard/periods">
                    <h4>Administrar período</h4>
                </a>
            </div>
            <hr>
            <div>
                <a href="/dashboard/import_data">
                    <h4>Cargar estudiantes</h4>
                </a>
            </div>
            @if ($enabled_period)
                <div>
                    <a href="/dashboard/import_data_courses">
                        <h4>Cargar asignaturas</h4>
                    </a>
                </div>
                <div>
                    <a href="/dashboard/import_data_assistants">
                        <h4>Cargar ayudantes</h4>
                    </a>
                </div>
                <div>
                    <a href="/dashboard/import_data_associate">
                        <h4> Asociar estudiantes en asignaturas</h4>
                    </a>
                </div>
                <hr>
                <div>
                    <a href="/dashboard/courses">
                        <h4> Administrar asignaturas</h4>
                    </a>
                </div>
            @endif
            <hr>
            <div>
                <a href="/dashboard/surveys">
                    <h4>Crear encuesta</h4>
                </a>

            </div>
            <div>
                <a href="/dashboard/manage_surveys">
                    <h4>Asociar encuesta</h4>
                </a>

            </div>
            <hr>
            <!--Cosas de Ayudante-->
            <div>
                <h4>
                    <a href="/dashboard/review_surveys">
                        <h4>Revisar encuestas</h4>
                    </a>
                </h4>
            </div>
            <div>
                <h4>
                    <a href="/dashboard/review__global">
                        <h4>Revisar indicadores globales</h4>
                    </a>
                </h4>
            </div>

        @elseif (Auth::user()->role == "Encargado Docente")
            <!--Cosas de Encargado Docente-->
            <div>
                <a href="/dashboard/periods">
                    <h3> Administrar período </h3>
                </a>
            </div>
            <hr>
            <div>
                <a href="/dashboard/import_data">
                    <h3>Cargar estudiantes</h2>
                </a>
            </div>
            @if ($enabled_period)
                <div>
                    <a href="/dashboard/import_data_courses">
                        <h3>Cargar asignaturas</h2>
                    </a>
                </div>
                <div>
                    <a href="/dashboard/import_data_assistants">
                        <h3>Cargar ayudantes</h2>
                    </a>
                </div>
                <div>
                    <a href="/dashboard/import_data_associate">
                        <h3>Asociar estudiantes en asignaturas</h3>
                    </a>
                </div>
                <hr>
                <div>
                    <a href="/dashboard/courses">
                        <h3>Administrar asignaturas</h3>
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
                <a href="/dashboard/manage_surveys">
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
                    <a href="/dashboard/answer_survey">
                        <h3>Responder encuestas</h3>
                    </a>
                </h3>
            </div>
        @else
            <!--Cosas de Estudiante-->
            <div>
                <h3>
                    <a href="/dashboard/answer_survey">
                        <h3>Responder encuestas</h3>
                    </a>
                </h3>
            </div>
        @endif
    @endif
    <br>
@endsection
