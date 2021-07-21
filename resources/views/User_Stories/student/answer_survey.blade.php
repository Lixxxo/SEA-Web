@extends('layouts.base')
<title>Responder encuesta</title>
@section('contenido')
    <div>
        <a href="/dashboard">Menú principal</a>
    </div>
    <fieldset>
        <legend>Responder encuestas</legend>
    </fieldset>

    <div>

        @if (count($student_course_list) == 0)
            <p>No hay encuestas disponibles para este estudiante</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th id="header">nrc</th>
                        <th id="header">código</th>
                        <th id="header">rut profesor</th>
                        <th id="header">nombre profesor</th>
                        <th id="header">acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($student_course_list as $course)
                        <tr>
                            <td>{{ $course->nrc }}</td>
                            <td>{{ $course->codigo_asignatura }}</td>
                            <td>{{ $course->rut_profesor }}</td>
                            <td>{{ $course->nombre_profesor }}</td>
                            <td>
                                <form action="">
                                    @if ($course->Surveysid != null)
                                        <input type="button" value="Responder encuesta">
                                        <input type="text" name="surveyId" hidden value={{ $course->Surveysid }}>
                                    @else
                                        <p>Sin encuesta asociada</p>
                                    @endif
                                </form>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        @endif


    </div>
@endsection

@section('script')

@endsection
