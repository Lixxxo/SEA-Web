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
    <!--Cosas de Administrador-->
    <div>
        <h2>
            Administrar usuarios
        </h2>
        <!--acá los x-jet compompnents-->
    </div>
    Cosas de Encargado Docente
    Cosas de Ayudante
@elseif (Auth::user()->role == "Encargado Docente") 
    Cosas de Encargado Docente
@elseif (Auth::user()->role == "Ayudante") 
    Cosas de Ayudante
    Cosas de Estudiante
@else
    Cosas De Estudiante
@endif

@endsection