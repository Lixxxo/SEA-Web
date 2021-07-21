<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
        public function index(){
                
        }
        public function indexCourses(){
                $idLog = DB::select('select user_id from sessions');
                
                $rutAyuLog = DB::select('select rut from users where id = ? ', [$idLog[0]->user_id]);
                $asistVer = DB::select('select role from users where rut = ?', [$rutAyuLog[0]->rut]);
                // con el combobox hacer una query que compare el nombre del cursoAyu = nombreCursoBox
                // VALIDACION 1
                $cursosAyudante = DB::select('select nrc from courses c, assistants_courses ac where ac.usersrut = ? AND c.id = ac.coursesid', [$rutAyuLog[0]->rut]);
                if($asistVer[0]->role == 'Ayudante'){
                        if ($cursosAyudante == null){
                        return back()->with('error', 'No existen cursos asociados.');
                        }
                }

            
                $idEncuesta = DB::select('select surveysid from courses where nrc = ? ', [1]);
                return view("User_Stories.Ayudante.enc004.select_courses")->with(['courses_list'=>$cursosAyudante]);
        }
}
