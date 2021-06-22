<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class SurveyController extends Controller
{   

    public function index(){

        $survey_list = DB::select("select id, nombre, count(*) as cantidad_preguntas, totalRespuestas, estado, Coursesnrc from surveys where id in (Select Surveysid from questions) group by(nombre);");
        //dd($survey_list);
        $course_list = DB::select('select * from courses');
        
        return view("User_Stories.EncDoc.enc001.surveys", ['survey_list' => $survey_list, 'course_list'=>$course_list]);
    }


    public function store(Request $request){
       
        // explode == split
        $course_nrc = explode(",",$request->get("data"))[0];
        $course_codigo_asignatura = explode(",",$request->get("data"))[1];

        $survey_qtty = strval(count(DB::select('select * from surveys')));

        DB::insert('insert into surveys (Coursesnrc, nombre) values (?, ?)', [$course_nrc, $course_codigo_asignatura."_".$survey_qtty]);
        DB::insert('insert into questions (Surveysid) values (last_insert_id())');

        return redirect("/dashboard/surveys");
    }

    public function edit($id)
    {
        
        $survey = DB::select('select * from surveys where id = ?', [$id])[0];
        $question_list = DB::select('select * from questions where Surveysid = ?', [$id]);
        //dd($survey, $question_list);
        return view('User_stories.EncDoc.enc001.edit',['survey' => $survey, 'question_list'=>$question_list]);
    }

    public function createQuestion(Request $request){
        dd($request);
    }
}
