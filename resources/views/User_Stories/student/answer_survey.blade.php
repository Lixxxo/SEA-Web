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
                    <a href="/dashboard/">aaa</a>
                    @for ($i = 0; $i < count($student_course_list); $i++)
                        <tr>
                            <td>{{ $student_course_list[$i]->nrc }}</td>
                            <td>{{ $student_course_list[$i]->codigo_asignatura }}</td>
                            <td>{{ $student_course_list[$i]->rut_profesor }}</td>
                            <td>{{ $student_course_list[$i]->nombre_profesor }}</td>
                            <td>
                                <form action="">
                                    @if ($student_course_list[$i]->Surveysid != null)
                                        <a href='/dashboard/answer_survey/{{ $student_course_list[$i]->Surveysid }}/answer'
                                            class="btn btn-warning">
                                            Responder
                                        </a>
                                    @else
                                        <p>Sin encuesta asociada</p>
                                    @endif
                                </form>
                            </td>
                        </tr>

                    @endfor
                </tbody>
            </table>
        @endif


    </div>
@endsection

@section('script')

@endsection
