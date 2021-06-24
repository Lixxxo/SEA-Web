@extends('layouts.base')
@section('contenido')
<h2>Actualizar Asignatura</h2>
    <form action="/dashboard/courses/{{$course->id}}" method="POST">
        @csrf
        @method('PUT')
        <!--NRC-->

        <div class="mb-3">
            <label class="form-label">NRC</label>
            <input type="text" id="nrc" name="nrc" required
            class="form-control" tabindex="1" value="{{$course->nrc}}" >

            <input type="hidden" name = "nrc_antiguo" value="{{$course->nrc}}">
            <input type="hidden" name = "id" value="{{$course->id}}">
        </div>
        <br>
        <!--Codigo-->
        <div class="mb-3">
            <label class="form-label">Código de Asignatura</label>
            <input id="codigo_asignatura" name="codigo_asignatura" type="text" class="form-control"
                tabindex="2" value="{{$course->codigo_asignatura}}" required>
        </div>
        <br>
        <!--Rut profesor-->
        <div class="mb-3">
            <label class="form-label">Rut Profesor</label>
            <input id="rut_profesor" name="rut_profesor" type="text" class="form-control"
                tabindex="3" value="{{$course->rut_profesor}}">
        </div>
        <br>
        <!--Nombre profesor-->
        <div class="mb-3">
            <label class="form-label">Nombre Profesor</label>
            <input id="nombre_profesor" name="nombre_profesor" type="text" class="form-control"
                tabindex="4" value="{{$course->nombre_profesor}}">
        </div>
        <br>

        <!--Nombre ayudantes-->
        <div class="mb-3">
            <label class="form-label">Ayudantes</label>
            <ul>
                @for($i = 0 ; $i < count($assistant_list); $i++)
                    <li id="rut_ayudante{{$i}}" name="rut_ayudante{{$i}}"
                        velue = "rut_ayudante{{$i}}" >{{$assistant_list[$i]->name}}
                    </li>
                    <br>
                @endfor
            </ul>
        </div>
        
        <!--Nombre estudiantes-->
        <div class="mb-3">
            <label class="form-label">Estudiantes</label>
            <ul>
                @for($i = 0 ; $i < count($assistant_list); $i++)
                    <li id="rut_estudiante{{$i}}" name="rut_estudiante{{$i}}"
                        value= "rut_ayudante{{$i}}">{{$assistant_list[$i]->name}}
                    </li>
                    <br>
                @endfor

        </div>

        <br>
        <a href="/dashboard/courses" class="btn btn-secondary" tabindex="7">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="8">Guardar</button>
    </form>

    <script>
        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>

<script>
    function checkRut(rut) {
    // Despejar Puntos
    var valor = rut.value.replace('.','');
    // Despejar Guión
    valor = valor.replace('-','');

    // Aislar Cuerpo y Dígito Verificador
    cuerpo = valor.slice(0,-1);
    dv = valor.slice(-1).toUpperCase();

    // Formatear RUN
    rut.value = cuerpo + '-'+ dv


    // Si no cumple con el mínimo ej. (n.nnn.nnn)
    if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}

    // Calcular Dígito Verificador
    suma = 0;
    multiplo = 2;

    // Para cada dígito del Cuerpo
    for(i=1;i<=cuerpo.length;i++) {

        // Obtener su Producto con el Múltiplo Correspondiente
        index = multiplo * valor.charAt(cuerpo.length - i);

        // Sumar al Contador General
        suma = suma + index;

        // Consolidar Múltiplo dentro del rango [2,7]
        if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }

    }

    // Calcular Dígito Verificador en base al Módulo 11
    dvEsperado = 11 - (suma % 11);

    // Casos Especiales (0 y K)
    dv = (dv == 'K')?10:dv;
    dv = (dv == 0)?11:dv;

    // Validar que el Cuerpo coincide con su Dígito Verificador
    if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }

    // Si todo sale bien, eliminar errores (decretar que es válido)
    rut.setCustomValidity('');
    }
</script>

@endsection
