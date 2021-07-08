@extends('layouts.base')

@section('contenido')
  <h2>Crear Usuarios</h2>

  <form action="/dashboard/users" method="POST">
      @csrf
    <!--Rut-->
    <div class="mb-3">
      <label for="" class="form-label">Rut (sin puntos y con guión:)</label>
      <input type="text" id="rut" name="rut" required 
          oninput="checkRut(this)" placeholder="11111111-1"
          class="form-control" tabindex="1">    
    </div>
    <!--Nombre Completo-->
    <div class="mb-3">
      <label for="" class="form-label">Nombre completo</label>
      <input id="full_name" name="full_name" type="text" class="form-control" tabindex="2">
    </div>
    <!--Email-->
    
    <div class="mb-3">
      <label for="" class="form-label">Email</label>
      <input id="email" name="email" type="email" class="form-control" tabindex="3">
    </div>
    <!--Rol-->
    <div class="mb-3">
      <label for="" class="form-label">Rol</label>
      <select class="form-select" id="role" name="role">
        <option selected>Estudiante</option>
        <option value="Ayudante">Ayudante</option>
        <option value="Encargado Docente">Encargado Docente</option>
      </select>
    </div>
    <a href="/dashboard/users" class="btn btn-secondary" tabindex="5">Cancelar</a>

    <button type="submit" class="btn btn-primary" tabindex="6">Guardar</button>
  </form>



@endsection
@section('script')
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

  <script src="{{asset("js/notify.min.js")}}"></script>
  <script>
      var status = '{{session("status")}}';
      if (status){
          $.notify(status, "error");
      }
  </script>
    
@endsection