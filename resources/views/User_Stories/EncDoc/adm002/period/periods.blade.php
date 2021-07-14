@extends('layouts.base')
@section('contenido')
<div>
    <a href="/dashboard">Menu principal</a>
</div>
<div>
    <div  class="text-center">
        <h3>Estado de semestre</h3>
    @if ($enabled_period != "")
        <h4>
            El semestre habilitado es el {{$enabled_period->codigo_semestre}}

            Ingrese el código del semestre para deshabilitar: <br>
            (Solo datos numéricos)
            <br>
            <br>
        </h4>
        <h5>
            <form method="POST" action="{{route('periods_edit')}}">
                @csrf
                <input class = "code" type="txtNumber" minlength="6" maxlength="6" id="codigo_semestre" name="codigo_semestre"
                onchange="validatePeriodCode(this);"
                onkeypress="return isNumberKey(event);">
                <input onclick="verification();" type="submit">
            </form>
        </h5>

    @else
        <h4>
            No se encuentra nigún semestre habilitado
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
                {{-- TODO: agregar descipción --}}

                <label for="description">Descripción</label>
                <textarea name="description" id="description" cols="30" rows="2"></textarea>
                <label for=""></label>
                <br>
                <input type="submit">
            </form>
        </h4>
    @endif
    </div>
    <div  >
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
            @if ($period->estado)
                <tr style="background-color:palegreen;">
            @else
                <tr >
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
