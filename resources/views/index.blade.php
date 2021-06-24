@extends('layouts.base')
@section('contenido')
    <div class="text-left" >
        <img alt="UCN" width="150" src="img/ucn-logo.png" />  
    </div>
    <div class="text-left">
        @if (Route::has('login'))
            <div class="">
                @auth
                    <a href="{{ url('/dashboard') }}" >Dashboard</a>
                @else
                    <a href="{{ route('login') }}" >Login</a>

                @endauth
            </div>
        @endif
    </div>
    <div class="text-right">
        <div class="mx-auto">
            <h2 style = "text-align: center">
                Sistema Web Seguimiento y Evaluación de Ayudantes DISC
            </h2>
            <br>
            <p class="text-center">
                Bienvenido al sistema de seguimiento y evaluacion de ayudantes, por favor inicia sesion, en caso de no tener cuenta contactar con el administrador
                <br>Muchas Gracias
            </p>
        </div>
    </div>

@endsection