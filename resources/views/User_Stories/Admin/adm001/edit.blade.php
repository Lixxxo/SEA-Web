@extends('layouts.base')
@section('contenido')
    <h2>Actualizar usuario</h2>
    <form action="/dashboard/users/{{$user->id}}" method="POST">
        @csrf
        @method('PUT')
        <!--Rut-->

        <div class="mb-3">
            <label class="form-label">Rut</label>
            <input type="text" id="rut" name="rut" required
            oninput="checkRut(this)"
            class="form-control" tabindex="1" value="{{$user->rut}}" onsubmit="return checkRut(event)">
        </div>
        <br>
        <!--Nombre Completo-->
        <div class="mb-3">
            <label class="form-label">Nombre completo</label>
            <input id="full_name" name="full_name" type="text" class="form-control"
                tabindex="2" value="{{$user->name}}">
        </div>
        <br>
        <!--Email-->
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input id="email" name="email" type="email" class="form-control"
                tabindex="3" value="{{$user->email}}">
        </div>
        <br>

        <br>
        <!--Rol-->
        <div class="mb-3">
            <label class="form-label">Rol</label>
            <br>
            <select class="form-select" id="role" name="role">
              <option selected>{{$user->role}}</option>
              <option value="Ayudante">Estudiante</option>
              <option value="Ayudante">Ayudante</option>
              <option value="Encargado Docente">Encargado Docente</option>
            </select>
          </div>
          <br>
        <!--Estado-->
        <div class="form-check form-switch">

            @if ($user->enabled)
                <input class="form-check-input" type="checkbox"
                    id="enabled" name = "enabled" checked>
            @else
                <input class="form-check-input" type="checkbox"
                    id="enabled" name = "enabled" >
            @endif
            <label class="form-check-label" for="flexSwitchCheckDefault">Habilitado</label>
            <br>
          </div>
        <a href="/dashboard/users" class="btn btn-secondary" tabindex="7">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="8">Guardar</button>
    </form>

    <script>
        var stateValue = $("enabled").is("checked") ? true : false;
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
