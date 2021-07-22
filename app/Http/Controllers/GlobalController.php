<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class GlobalController extends Controller
{
    //
    public function index()
    {

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
            
            if ($actual_answers == $actual_surveys) {
                $answered_all = $answered_all + 1;
            }elseif($actual_answers == 0 and $actual_answers < $actual_surveys){
                $answered_none = $answered_none + 1;
            }elseif($actual_answers < $actual_surveys){
                $answered_some = $answered_some + 1;
            }

            
        }
        dd($answered_all, $answered_some, $answered_none);
        //dd($rut_list, $x);
        return view('User_Stories.EncDoc.das001.dash');
    }
}
