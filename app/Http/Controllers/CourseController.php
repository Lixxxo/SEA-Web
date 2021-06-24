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
        $assistant_list = DB::table('assistants_courses')->get();
        //dd($course);
        //return response()->json($course);
        return view('User_stories.EncDoc.eaa003.edit',['course' => $course],['assistant_list' => $assistant_list]);
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
        //return response()->json($request);
        //$course = DB::table('Courses')->where('nrc',$nrc)->first();
        $course = Course::where('nrc',$nrc)->first();

        $course->timestamps = false;

        $periods_courses = DB::table('periods_courses')->get();
        $periods_codigo_semestre = $periods_courses->get('Periodscodigo_semestre');

        $assistants_courses = DB::table('assistants_courses')->get();
        //return response()->json($assistants_courses);
        $users_rut = $assistants_courses->get('Usersrut');
        //return response()->json($users_rut);
        $courses = DB::table('courses')->get();
        $codigo_asignatura = $courses->get('codigo_asignatura');
        $rut_profesor = $courses->get('rut_profesor');
        $nombre_profesor = $courses->get('nombre_profesor');
        DB::table('periods_courses')->where('Coursesnrc',$nrc)->delete();
        DB::table('assistants_courses')->where('Coursesnrc',$nrc)->delete();
        DB::table('courses')->where('nrc',$nrc)->delete();

        DB::insert('insert into courses (nrc, codigo_asignatura, rut_profesor, nombre_profesor) values (?, ?, ?, ?)', [$request->get('nrc'),$request->get('codigo_asignatura'),$request->get('rut_profesor'), $request->get('nombre_profesor')]);
        foreach($assistants_courses as $assistant){
            DB::insert('insert into assistants_courses (Usersrut, Coursesnrc) values (?, ?)', [$assistant->Usersrut, $request->get('nrc')]);
        }
        foreach($periods_courses as $period){
            DB::insert('insert into periods_courses (Periodscodigo_semestre, Coursesnrc) values (?, ?)', [$period->Periodscodigo_semestre, $request->get('nrc')]);
        }

        //DB::delete('delete periods_courses where Coursesnrc = ?', [$nrc]);



        //DB::delete('delete assistants_courses where Coursesnrc = ?', [$nrc]);
        //DB::insert('insert into assistants_courses (Usersrut, Coursesnrc) values (?, ?)', [$assistants_courses->Usersrut, $nrc]);

        //$course->update(['nrc'=>$request->get('nrc'),'codigo_asignatura'=>$request->get('codigo_asignatura'),'rut_profesor'=>$request->get('rut_profesor'),'nombre_profesor'=>$request->get('nombre_profesor')]);
        //DB::table('assistants_courses')->get()->update(['Usersrut'=>$request->])
        //DB::update('update Assistants_Courses set Coursesnrc = ? where Coursesnrc = ?', [$request->get('nrc'),$nrc]);
        //DB::update('update Surveys set Coursesnrc = ? where Coursesnrc = ?', [$request->get('nrc'),$nrc]);
        //DB::update('update Periods_Courses set Coursesnrc = ? where Coursesnrc = ?', [$request->get('nrc'),$nrc]);
        //DB::update('update Students_Courses set Coursesnrc = ? where Coursesnrc = ?', [$request->get('nrc'),$nrc]);
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
