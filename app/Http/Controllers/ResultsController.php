<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class ResultsController extends Controller
{    
        public function index()
        {
                $idLog = DB::select('select user_id from sessions');
                $rutAyuLog = DB::select('select rut from users where id = ? ', [$idLog[0]->user_id]);
                $asistVer = DB::select('select role from users where rut = ?', [$rutAyuLog[0]->rut]);
                // con el combobox hacer una query que compare el nombre del cursoAyu = nombreCursoBox
                // VALIDACION 1
                $cursosAyudante = DB::select('select * from courses c, assistants_courses ac where ac.usersrut = ? AND c.id = ac.coursesid', [$rutAyuLog[0]->rut]);
                if($asistVer[0]->role == 'Ayudante'){
                        if ($cursosAyudante == null){
                        //return back()->with('error', 'No existen cursos asociados.');
                        }
                }

                
                $idEncuesta = DB::select('select surveysid from courses where nrc = ? ', [1]);
                return view("User_Stories.Ayudante.enc004.select_courses")->with(['courses_list'=>$cursosAyudante]);
        }

        public function indexSurveys(Request $request)
        {
                $course_nrc = $request->get('courses_nrc');
                $survey_id = DB::select('select surveysid from courses where nrc = ?', [$course_nrc]);
                $questions = DB::select('select * from questions where surveysid = ?', [$survey_id[0]->surveysid]);
                $questions_answers = array();
                $countAnswerQuestions = array();
                $course_id = DB::select('select id from courses where nrc = ?', [$course_nrc]);
                
                for ($i=0; $i < count($questions) ; $i++) 
                { 
                        if($questions[$i]->indicador == 1)
                        {
                                $no_apply = DB::select('select count(*) from answers where questionsid = ? and coursesid = ? and respuesta = ?', [$questions[$i]->id, $course_id[0]->id, 0]);
                                array_push($countAnswerQuestions, $no_apply);
                                
                                $complete_desagreement = DB::select('select count(*) from answers where questionsid = ? and coursesid = ? and respuesta = ?', [$questions[$i]->id, $course_id[0]->id, 1]);
                                array_push($countAnswerQuestions, $complete_desagreement);

                                $desagreement = DB::select('select count(*) from answers where questionsid = ? and coursesid = ? and respuesta = ?', [$questions[$i]->id, $course_id[0]->id, 2]);
                                array_push($countAnswerQuestions, $desagreement);

                                $none = DB::select('select count(*) from answers where questionsid = ? and coursesid = ? and respuesta = ?', [$questions[$i]->id, $course_id[0]->id, 3]);
                                array_push($countAnswerQuestions, $none);

                                $agreement = DB::select('select count(*) from answers where questionsid = ? and coursesid = ? and respuesta = ?', [$questions[$i]->id, $course_id[0]->id, 4]);
                                array_push($countAnswerQuestions, $agreement);

                                $complete_agreement = DB::select('select count(*) from answers where questionsid = ? and coursesid = ? and respuesta = ?', [$questions[$i]->id, $course_id[0]->id, 5]);
                                array_push($countAnswerQuestions, $complete_agreement);

                                array_push($questions_answers, $countAnswerQuestions);

                        }
                        else if($questions[$i]->indicador == 2)
                        {
                                $no_apply = DB::select('select count(*) from answers where questionsid = ? and coursesid = ? and respuesta = ?', [$questions[$i]->id, $course_id[0]->id, 0]);
                                array_push($countAnswerQuestions, $no_apply);

                                $no = DB::select('select count(*) from answers where questionsid = ? and coursesid = ? and respuesta = ?', [$questions[$i]->id, $course_id[0]->id, 1]);
                                array_push($countAnswerQuestions, $no);
                                
                                $yes = DB::select('select count(*) from answers where questionsid = ? and coursesid = ? and respuesta = ?', [$questions[$i]->id, $course_id[0]->id, 2]);
                                array_push($countAnswerQuestions, $yes);

                                array_push($questions_answers, $countAnswerQuestions);
                        }
                }
                return view("User_Stories.Ayudante.enc004.survey_status")
                ->with(['questions_answers' => $questions_answers])
                ->with(['questions' => $questions]);
        }
}
