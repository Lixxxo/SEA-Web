<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Assistants_Courses;
use Illuminate\Http\Request;
use DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course_list = Course::all();
        //$assistant_list = DB::table('users')->where('rut', DB::table('assistants_courses')->first())->first();
        $assistant_list = DB::table('assistants_courses')->get();
        //return response()->json($assistant_list);
        return view('User_Stories.EncDoc.eaa003.edit_course',['course_list' => $course_list],['assistant_list' => $assistant_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);
        //);
        $course = DB::table('Courses')->where('nrc',$id)->first();
        //dd($course);
        //return response()->json($course);
        return view('User_stories.EncDoc.eaa003.edit',['course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nrc)
    {
        //$course = DB::table('Courses')->where('nrc',$nrc)->first();
        $course = Course::where('nrc',$nrc)->first();

        $course->timestamps = false;
        $course->update(['nrc'=>$request->get('nrc'),'codigo_asignatura'=>$request->get('codigo_asignatura'),'rut_profesor'=>$request->get('rut_profesor'),'nombre_profesor'=>$request->get('nombre_profesor')]);
        DB::update('update Assistants_Courses set Coursesnrc = ? where Coursesnrc = ?', [$request->get('nrc'),$nrc]);
        DB::update('update Surveys set Coursesnrc = ? where Coursesnrc = ?', [$request->get('nrc'),$nrc]);
        DB::update('update Periods_Courses set Coursesnrc = ? where Coursesnrc = ?', [$request->get('nrc'),$nrc]);
        DB::update('update Students_Courses set Coursesnrc = ? where Coursesnrc = ?', [$request->get('nrc'),$nrc]);
        //Assistants_Courses::where('Coursesnrc',$nrc)->update(['Coursesnrc'=>$request->get('nrc')]);
        //return response()->json($course);
        //return response()->json($course);
        //$course->timestamps = false;
        //$course->codigo_asignatura = $request->get('codigo_asignatura');
        //$course->rut_profesor = $request->get('rut_profesor');
        //$course->nombre_profesor = $request->get('nombre_profesor');
        //$course->save();
        return redirect('/dashboard/courses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
