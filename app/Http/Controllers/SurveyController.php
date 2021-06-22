<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class SurveyController extends Controller
{   

    public function index(){

        $survey_list = DB::select('select * from surveys where estado = 1');
        
        $course_list = DB::select('select * from courses');
        
        return view("User_Stories.EncDoc.enc001.surveys", ['survey_list' => $survey_list, 'course_list'=>$course_list]);
    }


    public function store(Request $request){
       
        // explode == split
        $course_nrc = explode(",",$request->get("data"))[0];
        $course_codigo_asignatura = explode(",",$request->get("data"))[1];

        $survey_qtty = strval(count(DB::select('select * from surveys')));

        DB::insert('insert into surveys (Coursesnrc, nombre) values (?, ?)', [$course_nrc, $course_codigo_asignatura."_".$survey_qtty]);

        return redirect("/dashboard/surveys");
    }
}
