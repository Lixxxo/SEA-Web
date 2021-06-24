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
    public function update(Request $request)
    {

        //dd($request);
        $old_nrc = $request->get('nrc_antiguo');
        $nrc  = $request->get('nrc');
        $course_codigo = $request->get('codigo_asignatura');
        $professor_rut  = $request->get('rut_profesor');
        $professor_nombre  = $request->get('nombre_profesor');
        $assistant_rut_list  = request()->except('_token', '_method', 'nrc','codigo_asignatura', 'rut_profesor', 'nombre_profesor');

        if(strval($nrc) != strval($old_nrc)){

            // obtener las weas desde la db guardarlas (periodos, los ayudantes, los estudiantes, las surveys )
            $period_list = DB::select('select * from periods_courses where Coursesnrc = ?', [$old_nrc]);
            $assistant_list = DB::select('select * from assistants_courses where coursesnrc = ?', [$old_nrc]);
            $student_list = DB::select('select * from students_courses where coursesnrc = ?', [$old_nrc]);
            $survey_list = DB::select('select * from surveys where coursesnrc = ?', [$old_nrc]);
            //por cada wea borrar cuando corresponda

            foreach ($period_list as $period) {
                dd($period);
                DB::delete('delete from periods_courses where Coursesnrc = ?', [$old_nrc]);
                DB::insert('insert into periods_courses (Periodscodigo_semestre, Coursesnrc) values (?, ?)', [$period->Periodscodigo_semestre, $nrc]);
            }
            foreach ($assistant_list as $assistant) {
                DB::delete('delete assistants_courses where Coursesnrc = ?', [$old_nrc]);
                DB::insert('insert into assistants_courses (id, name) values (?, ?)', [$nrc]);
            }
            foreach ($student_list as $student) {
                DB::delete('delete students_courses where coursesnrc = ?', [$old_nrc]);
                DB::insert('insert into students_courses (Usersrut, Coursesnrc) values (?, ?)', [$student->Usersrut, $nrc]);
            }
            //DB::update('update surveys set coursesnrc = ? where coursesnrc = ?', [$nrc, $old_nrc]);
        }

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
