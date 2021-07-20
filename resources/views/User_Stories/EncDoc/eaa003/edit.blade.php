@extends('layouts.base')
@section('contenido')
    <h2>Actualizar Asignatura</h2>
    <form action="/dashboard/courses/{{ $course->id }}" method="POST">
        @csrf
        @method('PUT')
        <a href="/dashboard/courses" class="btn btn-secondary" tabindex="7">Volver</a>
        <!--NRC-->

        <div class="mb-3">
            <label class="form-label">NRC</label>
            <input type="text" id="nrc" name="nrc" required class="form-control" tabindex="1" value="{{ $course->nrc }}">

            <input type="hidden" name="nrc_antiguo" value="{{ $course->nrc }}">
            <input type="hidden" name="id" value="{{ $course->id }}">
        </div>
        <br>
        <!--Codigo-->
        <div class="mb-3">
            <label class="form-label">Código de Asignatura</label>
            <input id="codigo_asignatura" name="codigo_asignatura" type="text" class="form-control" tabindex="2"
                value="{{ $course->codigo_asignatura }}" required>
        </div>
        <br>
        <!--Rut profesor-->
        <div class="mb-3">
            <label class="form-label">Rut Profesor</label>
            <input id="rut_profesor" name="rut_profesor" type="text" class="form-control" tabindex="3"
                value="{{ $course->rut_profesor }}">
        </div>
        <br>
        <!--Nombre profesor-->
        <div class="mb-3">
            <label class="form-label">Nombre Profesor</label>
            <input id="nombre_profesor" name="nombre_profesor" type="text" class="form-control" tabindex="4"
                value="{{ $course->nombre_profesor }}">
        </div>
        <br>

        <input type="submit" value="Guardar" class="btn btn-primary" tabindex="8">
    </form>
    <hr>

    <div>
        <form action="">
            <div class="form-parent">
                <div class="form">
                    <input type="text" name="assistant_rut" autocomplete="off" required>
                    <label for="assistant_rut" class="label-data">
                        <span class="content-data">RUT Ayudante</span>
                    </label>
                </div>
                <input type="submit" class="btn btn-primary" value="Agregar">
            </div>
        </form>
        <br>
        <form action="">
            <div class="form-parent">
                <div class="form">
                    <input type="text" name="student_rut" autocomplete="off" required>
                    <label for="student_rut" class="label-data">
                        <span class="content-data">RUT Estudiante</span>
                    </label>
                </div>
                <input type="submit" class="btn btn-primary" value="Agregar">
            </div>
        </form>
    </div>
    <hr>
    <!--Nombre ayudantes-->
    <div class="mb-3">
        @if (count($assistant_list) > 0)
            <label class="form-label">Ayudantes</label><br>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Rut</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($assistant_list); $i++)
                        <tr>
                            <td id="rut_ayudante{{ $i }}" name="rut_ayudante{{ $i }}" type="text"
                                value="{{ $assistant_list[$i]->rut }}">{{ $assistant_list[$i]->name }}</td>
                            <td>{{ $assistant_list[$i]->rut }}</td>
                            <td>
                                <input type="image" src="https://img.icons8.com/cotton/2x/delete-sign--v2.png"
                                    alt="Eliminar" width="20px" height="20px">
                        </tr>
                    @endfor
                </tbody>
            </table>
        @else
            <label class="form-label">No hay ayudantes inscritos</label>

        @endif
    </div>
    <!--Nombre estudiantes-->
    <div class="mb-3">
        @if (count($student_list) > 0)
            <label class="form-label">Estudiantes</label>
            <table>
                <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>Rut</td>
                        <td>Acción</td>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($student_list); $i++)
                        <tr>
                            <td id="rut_estudiante{{ $i }}" name="rut_estudiante{{ $i }}"
                                type="text" value="{{ $student_list[$i]->rut }}">{{ $student_list[$i]->name }}</td>
                            <td>{{ $student_list[$i]->rut }}</td>
                            <td>
                                <input type="image" src="https://img.icons8.com/cotton/2x/delete-sign--v2.png"
                                    alt="Eliminar" width="20px" height="20px">
                        </tr>
                    @endfor
                @else
                    <label class="form-label">No hay estudiantes inscritos</label>
        @endif
        </tbody>
        </table>
        <ul>
    </div>
    <br>


    <script>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>

    <script>
        function checkRut(rut) {
            // Despejar Puntos
            var valor = rut.value.replace('.', '');
            // Despejar Guión
            valor = valor.replace('-', '');

            // Aislar Cuerpo y Dígito Verificador
            cuerpo = valor.slice(0, -1);
            dv = valor.slice(-1).toUpperCase();

            // Formatear RUN
            rut.value = cuerpo + '-' + dv


            // Si no cumple con el mínimo ej. (n.nnn.nnn)
            if (cuerpo.length < 7) {
                rut.setCustomValidity("RUT Incompleto");
                return false;
            }

            // Calcular Dígito Verificador
            suma = 0;
            multiplo = 2;

            // Para cada dígito del Cuerpo
            for (i = 1; i <= cuerpo.length; i++) {

                // Obtener su Producto con el Múltiplo Correspondiente
                index = multiplo * valor.charAt(cuerpo.length - i);

                // Sumar al Contador General
                suma = suma + index;

                // Consolidar Múltiplo dentro del rango [2,7]
                if (multiplo < 7) {
                    multiplo = multiplo + 1;
                } else {
                    multiplo = 2;
                }

            }

            // Calcular Dígito Verificador en base al Módulo 11
            dvEsperado = 11 - (suma % 11);

            // Casos Especiales (0 y K)
            dv = (dv == 'K') ? 10 : dv;
            dv = (dv == 0) ? 11 : dv;

            // Validar que el Cuerpo coincide con su Dígito Verificador
            if (dvEsperado != dv) {
                rut.setCustomValidity("RUT Inválido");
                return false;
            }

            // Si todo sale bien, eliminar errores (decretar que es válido)
            rut.setCustomValidity('');
        }
    </script>

@endsection
@section('script')
    <script src="{{ asset('js/notify.min.js') }}"></script>
    <script>
        var success = '{{ session('success') }}';
        var error = '{{ session('error') }}';
        if (error) {
            $.notify(error, "error");
        }
        if (success) {
            $.notify(success, "success")
        }
    </script>
@endsection
