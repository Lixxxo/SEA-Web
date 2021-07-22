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
        $students_courses_table = DB::select('select * from Students_Courses where Usersrut = ?', [$user->rut]);
        //dd($user, $student_course_list, $students_courses_table);
        //$student_surveys = DB::select('select * from Surveys where id in
        // (select Surveysid from courses where id = ?)',
        //[$student_courses->Surveysid]);

        //return response()->json($students_courses_table);
        return view(
            'User_Stories.student.answer_survey',
            [
                'student_course_list' => $student_course_list,
                'user' => $user,
                'students_courses_table' => $students_courses_table
            ]
        );
    }

    public function edit(request $request){
        //dd($request);
        $user = Auth::user();
        $question_list = DB::select('select * from Questions where Surveysid = ?', [$request->surveysid]);
        //dd($question_list);
        return view('User_stories.student.view_survey',
        ['question_list' => $question_list,
            'user' => $user,
            'courseid' => $request->coursesid,
            'surveysid' => $request->surveysid
        ]);
    }

    public function answerSurvey(request $request){
        $course_id = $request->get('courseid');
        for ($i=0; $i < $request->questions_number; $i++) {
            $answer = $request->get('answer'.$i);
            $questionid = $request->get('question'.$i);
            DB::insert('insert into Answers (respuesta, Questionsid, Coursesid) values (?, ?, ?)', [$answer, $questionid, $course_id]);
        }
        DB::update('update Students_Courses set isAnswered = 1 where Usersrut = ? and Coursesid = ?', [$request->rut,$request->courseid]);
        //DB::update('update Questions set cantRespuesta = cantRespuesta + 1 where id = ?', [$questionid]);
        DB::update('update Surveys set totalRespuestas = totalRespuestas + 1 where id = ?', [$course_id]);
        return redirect('/dashboard/answer_survey')->with('success',"Has respondido esta encuesta");
    }
}
