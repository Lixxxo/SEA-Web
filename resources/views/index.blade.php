@extends('layouts.base')
@section('contenido')
    <div class="text-center" >
        <img alt="UCN" width="150" src="img/ucn-logo.png" />
    </div>

    <div class="text-right">
        <div class="mx-auto">
            <h2 style = "text-align: center">
                Sistema Web Seguimiento y Evaluación de Ayudantes DISC
            </h2>
            <br>
            <p class="text-center">
                Bienvenido al sistema de seguimiento y evaluacion de ayudantes, por favor inicie sesion, en caso de no tener cuenta contactar con el administrador
                <br>Muchas Gracias
            </p>
        </div>
    </div>

    <div class="text-center">
        @if (Route::has('login'))
            <div class="">
                @auth
                    <form action="{{ url('/dashboard') }}">
                        <button>Menu Principal</button>
                    </form>
                @else
                    <form action="{{ route('login') }}">
                        <button>Iniciar Sesion</button>
                    </form>
                    <form action="{{ route('register') }}">
                        <button>Registrarse</button>
                    </form>
                @endauth
            </div>
        @endif
    </div>
@endsection
