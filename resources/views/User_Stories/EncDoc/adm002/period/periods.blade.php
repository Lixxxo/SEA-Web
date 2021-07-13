@extends('layouts.base')
@section('contenido')
<div>
    <a href="/dashboard">Menu principal</a>
</div>
<div>
    @if ($has_enabled_period)
    <div  class="text-center">
        <h4>
            El semestre habilitado es el {{$enabled_period->codigo_semestre}}

            Ingrese el código del semestre para deshabilitar:
            <br>
            <br>
        </h4>
        <h5>
            <form method="POST" action="{{route('periods_edit')}}">
                <input class = "code" type="txtNumber" minlength="6" maxlength="6"
                onchange="validatePeriodCode(this);"
                onkeypress="return isNumberKey(event);">
                <input onclick="verification();" type="submit">
            </form>
        </h5>
    </div>
    @else
        // habilitar
    @endif

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