@extends('layouts.base')
@section('contenido')
@auth
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
@endauth
<br>

@if (Auth::user()->role == "Administrador") 
    <!--Cosas de Administrador-->
    <div>
        <a href="dashboard/users">
            <h3>Administrar usuarios</h2>
        </a>    
    </div>
    <!--Cosas de Encargado Docente-->
    <div>
        <a href="/dashboard/periods">
            <h3>Habilitar y deshabilitar periodo académico</h3>
        </a>
    </div>
    <div>
        <a href="/dashboard/import_data">
            <h3> Carga masiva de estudiantes</h3>
        </a>    
    </div>
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
        <a href="/dashboard/periods">
            <h3> Habilitar y deshabilitar periodo académico</h3>
        </a>
    </div>
@elseif (Auth::user()->role == "Ayudante") 
    Futuras historias de usuario para Ayudante
    Futuras historias de usuario para Estudiante

@else
    Futuras historias de usuario para Estudiante
@endif

@endsection
