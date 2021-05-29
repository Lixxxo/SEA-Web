
@extends('layouts.base')
@section('contenido')
    <div>
        <a href="/dashboard">Dashboard</a>
    </div>
    <h3  align = "center">Listado de usuarios</h3>
    
    <table class="table table-dark table-striped mt-4">
        <thead>
            <tr>
                <th scope="col">Rut</th>
                <th scope="col">Nombre completo</th>
                <th scope="col">Email</th>
                <th scope="col">Rol</td>
                <th scope="col">Estado</th>
                <th scope="col">Acción</th>
            </tr>

        </thead>
        <tbody>
            @foreach($user_list as $user)
                <tr>
                    <td>{{$user->rut}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role}}</td>
                    @if ($user->enabled === 1)
                        <td>Habilitado</td>
                    @else
                        <td>Deshabilitado</td>
                    @endif
                    
                    <td>
                        <a href='/dashboard/users/{{$user->id}}/edit' class="btn btn-warning">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    <br>
    <a href="users/create" class="btn btn-success" href="dashboard/users/create">Crear usuario</a>
    <br>
@endsection