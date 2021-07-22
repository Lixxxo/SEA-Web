<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class GlobalController extends Controller
{
    //
    public function index()
    {
        $courses_without_surveys = DB::select('select * from courses where Surveysid is null');
        //dd($courses_without_surveys);
        $courses_with_surveys_withthout_answers = DB::select('select * from courses where Surveysid in (select id from Surveys where totalRespuestas = 0)');
        //dd($courses_with_surveys_withthout_answers);

        $rut_list = DB::select('select distinct Usersrut
                            from students_courses
                            ');
        $total_students = count($rut_list);
        $answered_all = 0;
        $answered_some = 0;
        $answered_none = 0;
        $x = array();
        foreach($rut_list as $rut){

            $surveys_user = DB::select('select c.Surveysid, s.isAnswered
                            from courses c
                            join students_courses s on
                            c.id = s.Coursesid
                            where s.Usersrut = ?', [$rut->Usersrut]);
            array_push($x, $surveys_user);
            $actual_answers = 0;
            $actual_surveys = 0;
            foreach ($surveys_user as $sv) {

                if ($sv->Surveysid != null){

                    if ($sv->isAnswered == true) {
                        $actual_answers = $actual_answers + 1;
                    }
                    $actual_surveys = $actual_surveys + 1;
                }
            }

            if ($actual_answers == $actual_surveys and $actual_answers > 0) {
                $answered_all = $answered_all + 1;
            }elseif($actual_answers == 0 and $actual_answers < $actual_surveys){
                $answered_none = $answered_none + 1;
            }elseif($actual_answers < $actual_surveys ){
                $answered_some = $answered_some + 1;
            }


        }

        return view('User_Stories.EncDoc.das001.dash',
                   ['total_students'=>$total_students,
                    'answered_all'=>$answered_all,
                    'answered_some'=>$answered_some,
                    'answered_none'=>$answered_none,
                    'courses_with_surveys_without_answers' =>$courses_with_surveys_withthout_answers,
                    'courses_without_surveys' =>$courses_without_surveys]);
    }
}
