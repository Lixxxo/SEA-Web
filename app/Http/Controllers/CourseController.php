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
        //$course_list = Course::all();
        $course_list = DB::select('select * from courses where id in (select Coursesid from periods_courses where periodscodigo_semestre in (select codigo_semestre from Periods where estado = ?))', [1]);
        //$assistant_list = DB::table('users')->where('rut', DB::table('assistants_courses')->first())->first();
        $assistant_matrix = array();
        foreach($course_list as $course){
            $assistant_list = DB::select('select * from users where rut in (select Usersrut from assistants_courses where Coursesid = ?);', [$course->id]);
            array_push($assistant_matrix, $assistant_list);
        }

        //return response()->json($assistant_list);
        return view('User_Stories.EncDoc.eaa003.edit_course',['course_list' => $course_list],['assistant_matrix' => $assistant_matrix]);
    }

    public function deleteAssistant(request $request){
        dd($request);
    }

    public function deleteStudent(request $request){
        dd($request);
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

        //);
        $course = DB::select('select * from courses where id = ?', [$id])[0];
        $assistant_list = DB::select('select * from users where rut in (select Usersrut from assistants_courses where Coursesid = ?);', [$id]);
        $student_list = DB::select('select * from users where rut in (select Usersrut from students_courses where Coursesid = ?);', [$id]);

        //return response()->json($course);
        return view('User_stories.EncDoc.eaa003.edit',['course' => $course, 'assistant_list' => $assistant_list, 'student_list'=>$student_list ]);
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
        $course_id = $request->get('id');
        $old_nrc = $request->get('nrc_antiguo');
        $nrc  = $request->get('nrc');
        $course_codigo = $request->get('codigo_asignatura');
        $professor_rut  = $request->get('rut_profesor');
        $professor_nombre  = $request->get('nombre_profesor');
        $assistant_rut_list  = request()->except('_token', '_method', 'nrc','codigo_asignatura', 'rut_profesor', 'nombre_profesor');

        /*
        if(strval($nrc) != strval($old_nrc)){


            DB::update('update courses set nrc = ? where id = ?', [$nrc, $course_id]);

        }
        */
        $nrcs = DB::select('select nrc from courses where nrc = ?', [$nrc]);
        if (count($nrcs) != 0){
            if (strval($nrc) == strval($old_nrc)){
                DB::update('update courses set nrc = ?, codigo_asignatura = ?, rut_profesor = ?,  nombre_profesor = ?  where id = ?', [$nrc, $course_codigo, $professor_rut, $professor_nombre, $course_id]);
                return back()->with('success',"Asignatura modificada con exito. Mismo NRC");
            }
            return back()->with('error', "El NRC ingresado ya existe");
        }
        else{
            DB::update('update courses set nrc = ?, codigo_asignatura = ?, rut_profesor = ?,  nombre_profesor = ?  where id = ?', [$nrc, $course_codigo, $professor_rut, $professor_nombre, $course_id]);
            return back()->with('success',"Asignatura modificada con exito. Distinto nrc");
        }

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
