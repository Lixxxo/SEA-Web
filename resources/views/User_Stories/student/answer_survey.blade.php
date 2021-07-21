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
                                <input type="button" value="Responder encuesta">
                                <input type="text" name="surveyId" hidden value={{ $course->Surveysid }}>
                            </form>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')

@endsection
