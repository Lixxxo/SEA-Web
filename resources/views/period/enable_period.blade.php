@extends('layouts.base')
@section('contenido')

Vista para habilitar un periodo academico.
<div>
    <form action="/dashboard/enable_period/" method="GET">
        <h4>Codigo de semestre</h4>
        <input placeholder="Ej: 202110" id="code" name="code" type="text">

    </form>
    @foreach ($period_list as $period)
    <h6>{{$period->Codigo}}</h6>
    @endforeach
</div>

<br>
<a href="/dashboard">Volver</a>
@endsection
