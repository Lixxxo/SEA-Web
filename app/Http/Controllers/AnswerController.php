<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Auth;

class AnswerController extends Controller
{
    //
    public function index(){
        $user = Auth::user();

        $student_course_list = DB::select('select * from courses
         where id in
         (select Coursesid
         from Students_Courses
         where Usersrut = ?)',[$user->rut]);

        //$student_surveys = DB::select('select * from Surveys where id in
        // (select Surveysid from courses where id = ?)',
        //[$student_courses->Surveysid]);

        //return response()->json($student_surveys);
        return view(
            'User_Stories.student.answer_survey',
            [
                'student_course_list' => $student_course_list
            ]
        );
    }
}
