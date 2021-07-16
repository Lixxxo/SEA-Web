@extends('layouts.base')
@section('contenido')
<div>
    <a href="/dashboard">Menu principal</a>
</div>
<style>

</style>
<div>
    <div  class="text-center">
        <h3>Estado de semestre</h3>
    @if ($enabled_period != "")
        <h4>
            El código de semestre habilitado es el {{$enabled_period->codigo_semestre}} <br>

            Ingrese el código del semestre para deshabilitar: <br>
            (Solo datos numéricos)
            <br>
            <br>
            <form method="POST" action="{{route('periods_edit')}}">
                @csrf
                <input class = "form" type="txtNumber" minlength="6" maxlength="6" id="codigo_semestre" name="codigo_semestre"
                onchange="validatePeriodCode(this);"
                onkeypress="return isNumberKey(event);">
                <br>
                <input value="Deshabilitar" onclick="verification();" type="submit" style="background-color: orange">
            </form>
        </h4>


    @else
        <h4>
            No se encuentra nigún semestre habilitado <br>
            seleccione el año y el semestre para habilitarlo
            <br><br>

            <form method="POST" action="{{route('periods_store')}}">
                @csrf
                <label for="year">Año</label>
                <select name="year" id="year">
                    <option value="{{now()->year -1}}">{{now()->year -1}}</option>
                    <option selected value="{{now()->year }}">{{now()->year }}</option>
                    @for ($i = 1; $i < 4; $i++)
                    <option value="{{now()->year +$i}}">{{now()->year+$i }}</option>
                    @endfor
                </select>
                <input checked type="radio" id="p1" name="period" value="10">
                <label  for="p1">Primer semestre</label>
                <input type="radio" id="p2" name="period" value="20">
                <label for="p2">Segundo semestre</label><br>
                <br>

                <label for="description">Descripción</label>
                <textarea name="description" id="description" cols="30" rows="2"></textarea>

                <br>
                <input type="submit" value="Habilitar/Editar" style="background-color: green">
            </form>
        </h4>
    @endif
    </div>
    @if (count($period_list) > 0)
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($period_list as $period)
                        @if ($period->estado)
                            <tr style="background-color:palegreen;">
                        @else
                            <tr>
                        @endif

                        <td>{{$period->codigo_semestre}}</td>
                        <td>{{$period->descripcion}}</td>
                        <td>
                            @if ($period->estado)
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
    @endif

</div>
@endsection
@section('script')
<script src="{{asset("js/notify.min.js")}}"></script>
<script>
    var success = '{{session("success")}}';
    var error = '{{session("error")}}';
    if (error){
        $.notify(error, "error");
    }
    if (success){
        $.notify(success, "success")
    }

</script>
<script>
    var validCode = false;
    function verification() {
        if (!validCode){
            $(".code").notify("El código no es válido",
                {classname: "error",
                autoHideDelay: 2000});
            event.preventDefault();
        }else
        if(!confirm("¿Deshabilitar periodo?")){
            event.preventDefault();
        }
    }
    function validatePeriodCode(input){
        console.log(input.value.slice(-2));
        var str = input.value;
        if (str.slice(-2) == "20" || str.slice(-2) == "10"){
            validCode = true;
        }else{
            validCode = false;
        }
    }
    function isNumberKey(evt){
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
    }
</script>

@endsection
