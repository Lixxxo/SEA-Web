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
            <h2>
                Sistema Web Seguimiento y Evaluación de Ayudantes DISC
            </h2>
            <br>
            <p class="text-center">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolor modi deserunt illum natus culpa corrupti, tenetur maiores cum reiciendis fuga numquam eum ab necessitatibus. Dolorem possimus obcaecati laborum nulla nesciunt?
            </p>
        </div>
    </div>

@endsection