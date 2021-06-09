@extends('layouts.base')
@section('contenido')
<div>
    <a href="/dashboard">Dashboard</a>
</div>
<div>
    <body>
       <div style="width: 100%; display: table;">
           <div style="display: table-row; height: 100px;">
               <div style="width: 50%; display: table-cell; ">
                <div class="small">
                    <form action="/dashboard/enable_period/" method="post">
                        @csrf
                        <h2>Habilitar periodo</h2>
                        <h6>Codigo</h6>
                        <input placeholder="Ej: 202110" id="code" name="code" type="number" minlength="6" maxlength="6" min="202010" max="300020" required >
                        <h6>Descripcion</h6>
                        <input maxlength="25" size="25" placeholder="Ej: primer semestre año 2020" id="description" name="description" type="text">
                        <br>
                        <input type="submit" value="Habilitar periodo">
                    </form>
                </div>
            </div>
            <div style="display: table-cell;">
                <div class="small">
                    <form action={{route('dashboard_edit')}} method="post">
                        @csrf

                        <h2>Deshabilitar periodo</h2>
                        <h6>Codigo</h6>
                        <input placeholder="Ej: 202110" id="code" name="code" type="number" minlength="6" maxlength="6" min="202010" max="300020" required>
                        <br>
                        <input type="submit" value="Deshabilitar periodo" onclick="return verification();">
                    </form>
                </div>
               </div>
           </div>
       </div>
    </body>
    <br>

    <table class="table table-dark table-striped mt-4">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Estado</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($period_list as $period)
            <tr>
                <td>{{$period->code}}</td>
                <td>{{$period->description}}</td>
                <td>
                    @if ($period->enabled)
                        Habilitado
                    @else
                        Deshabilitado
                    @endif


                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>

<script>
    function verification() {
        if(!confirm("¿Deshabilitar periodo?"))
        event.preventDefault();
    }
</script>

@endsection
