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
                    @for ($i = 0; $i < count($student_course_list); $i++)
                        <tr>
                            <td>{{ $student_course_list[$i]->nrc }}</td>
                            <td>{{ $student_course_list[$i]->codigo_asignatura }}</td>
                            <td>{{ $student_course_list[$i]->rut_profesor }}</td>
                            <td>{{ $student_course_list[$i]->nombre_profesor }}</td>
                            <td>
                                <form action="{{ route('openSurvey') }}" method="GET">
                                    @if ($student_course_list[$i]->Surveysid != null)
                                        @if ($students_courses_table[$i]->isAnswered == 0)
                                            <input type="submit" name="" id="" value="Responder">
                                            <input type="text" name="surveysid" hidden
                                                value="{{ $student_course_list[$i]->Surveysid }}">
                                            <input type="text" name="coursesid" hidden
                                                value="{{ $student_course_list[$i]->id }}">
                                        @else
                                            <p>Ya has respondido esta encuesta</p>
                                        @endif


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
