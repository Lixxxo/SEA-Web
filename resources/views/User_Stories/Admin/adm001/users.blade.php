@extends('layouts.base')
@section('contenido')
    <div>
        <a href="/dashboard">Menú principal</a>
    </div>
    <h4>Listado de usuarios</h4>
    <br>
    <a href="users/create" class="btn btn-success" href="dashboard/users/create">Crear usuario</a>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <table>
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
                    @foreach ($user_list as $user)
                        <tr>
                            <td>{{ $user->rut }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            @if ($user->enabled === 1)
                                <td style="color: green">Habilitado</td>
                            @else
                                <td style="color: red">Deshabilitado</td>
                            @endif

                            <td>
                                <a href='/dashboard/users/{{ $user->id }}/edit'>
                                    <input type="button" id="edit" value="Editar">
                                </a>

                                <form action="{{ route('reset_password') }}" method="POST">
                                    @csrf
                                    <input id="user_id" name="user_id" hidden value="{{ $user->id }}">
                                    <input id="restore-password" type="submit" value="Restablecer contraseña">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>


@endsection
@section('script')
    <script src="{{ asset('js/notify.min.js') }}"></script>
    <script>
        var status = '{{ session('status') }}';
        if (status) {
            $.notify(status, "success");
        }
    </script>

@endsection
