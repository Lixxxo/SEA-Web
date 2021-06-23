<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class SurveyController extends Controller
{   

    public function index(){

        $survey_list = DB::select("select id, nombre, totalRespuestas, estado, Coursesnrc from surveys where id in (Select Surveysid from questions);");
        $question_qtty_list = array();
        foreach ($survey_list as $survey){
            $question_qtty = DB::select("select count(*) as cantidadPreguntas from questions where Surveysid = ?;",[$survey->id]);
            array_push($question_qtty_list, $question_qtty);
        }
       //dd($question_qtty_list);
        $course_list = DB::select('select * from courses');
        
        return view("User_Stories.EncDoc.enc001.surveys", ['survey_list' => $survey_list, 'course_list'=>$course_list, 'question_qtty_list'=>$question_qtty_list]);
    }


    public function createSurvey(Request $request){
       
        // explode == split
        $course_nrc = explode(",",$request->get("data"))[0];
        $course_codigo_asignatura = explode(",",$request->get("data"))[1];

        $survey_qtty = strval(count(DB::select('select * from surveys')));

        DB::insert('insert into surveys (Coursesnrc, nombre) values (?, ?)', [$course_nrc, $course_codigo_asignatura."_".$survey_qtty]);
        DB::insert('insert into questions (Surveysid) values (last_insert_id())');

        return redirect("/dashboard/surveys");
    }

    public function editSurvey($id)
    {
        
        $survey = DB::select('select * from surveys where id = ?', [$id])[0];
        $question_list = DB::select('select * from questions where Surveysid = ?', [$id]);
        //dd($survey, $question_list);
        return view('User_stories.EncDoc.enc001.edit',['survey' => $survey, 'question_list'=>$question_list]);
    }

    public function createQuestion(Request $request){
        
        $survey_id = $request->get('id');
        DB::insert('insert into questions (Surveysid) values (?)', [$survey_id]);
        
        return redirect("/dashboard/surveys/".$survey_id);
    }
    
    public function updateQuestion(Request $request){
        //dd($request);
        $question_id = $request->get('question_id');
        $frase = $request->get('frase');
        $indicador = $request->get('indicador');
        $survey_id = $request->get('survey_id');
        
        DB::update('update questions set frase = ?, indicador = ? where id = ?', [$frase, $indicador, $question_id]);
        return redirect("/dashboard/surveys/".$survey_id);
    }

    public function deleteQuestion(Request $request){
        //dd($request);
        
        $question_id = $request->get('question_id');
        $survey_id = $request->get('survey_id');
        $question_list = DB::select('select * from questions where Surveysid = ?', [$survey_id]);
        if(count($question_list) == 1)
        {
            return redirect("/dashboard/surveys/".$survey_id."/edit");
        }
        DB::delete('delete from questions where id = ?', [$question_id]);
        return redirect("/dashboard/surveys/".$survey_id);
        
    }
}
