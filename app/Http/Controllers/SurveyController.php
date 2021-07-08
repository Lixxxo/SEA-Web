<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class SurveyController extends Controller
{

    public function index(){

        $survey_list = DB::select('select * from surveys');

        $question_qtty_list = array();
        foreach ($survey_list as $survey){
            $question_qtty = DB::select("select count(*) as cantidadPreguntas from questions where Surveysid = ?;",[$survey->id]);
            array_push($question_qtty_list, $question_qtty);
        }
        return view("User_Stories.EncDoc.enc001.surveys", ['survey_list' => $survey_list, 'question_qtty_list'=>$question_qtty_list]);
    }


    public function createSurvey(Request $request){

        $survey_qtty = strval(count(DB::select('select * from surveys')));

        DB::insert('insert into surveys (nombre, estado) values (?, ?)', ["Encuesta_".$survey_qtty, 1]);
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

    public function updateSurvey(Request $request)
    {
        //dd($request);
        $id = $request->get('survey_id');
        $nombre = $request->get('nombre');
        if($request->get('enabled') === "on"){
            $estado = 1;
        }else{
            $estado = 0;
        }
        try {
            DB::update('update surveys set nombre = ?, estado = ? where id = ?', [$nombre, $estado, $id]);
        } catch (\Throwable $th) {
            return back()->with('status', "Ya existe una encuesta con ese nombre.");
        }
        return redirect("/dashboard/surveys/".$id);

    }

    public function createQuestion(Request $request){

        $survey_id = $request->get('id');
        DB::insert('insert into questions (Surveysid) values (?)', [$survey_id]);

        return redirect("/dashboard/surveys/".$survey_id);
    }

    public function updateQuestion(Request $request){
        
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
