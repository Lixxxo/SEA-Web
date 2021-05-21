@extends('layouts.base')
@section('contenido')
<!--TODO: Un navbar responsivo con cada componente dependiendo del Auth:user()->role logeado-->
<a href="/">Home</a>
<form method="POST" action="{{ route('logout') }}">
    @csrf

    <x-jet-dropdown-link href="{{ route('logout') }}"
             onclick="event.preventDefault();
                    this.closest('form').submit();">
        {{ __('Cerrar Sesión') }}
    </x-jet-dropdown-link>
</form>
<br>
<!--TODO: Crear Componentes pesonalizados en cada caso-->
@if (Auth::user()->role == "Administrador")
    Cosas de Administrador
    Cosas de Encargado Docente
    Cosas de Ayudante
@elseif (Auth::user()->role == "Encargado Docente")
    Cosas de Encargado Docente
    <div class>
        <a href="http://127.0.0.1:8000/dashboard/enable_period">Habilitar periodo academico</a>
        <br>
        <a href="http://127.0.0.1:8000/dashboard/disable_period">Deshabilitar periodo academico</a>
    </div>
@elseif (Auth::user()->role == "Ayudante")
    Cosas de Ayudante
    Cosas de Estudiante
@else
    Cosas De Estudiante
@endif

@endsection
