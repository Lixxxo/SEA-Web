<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;
use App\Imports\CourseImport;
use App\Imports\Assistants_CoursesImport;
use App\Imports\Students_CoursesImport;

use Throwable;

class ImportDataController extends Controller
{
    public function indexStudents()
    {

        $data = DB::table('users')->where('role','Estudiante')->orderBy('name', 'asc')->get();

        return view('User_stories.EncDoc.eaa001.import_data', compact('data'));
    }

    public function importStudents(Request $request)
    {

        $file = $request->select_file;
        if($file != null)
        {
            $students = Excel::toArray(new UserImport, $request->select_file)[0];
            $file_verify = array_keys($students[0]);

            if($file_verify[0] == 'rut' && $file_verify[1] == 'nombre' && $file_verify[2] == 'correo')
            {
                $student_error = array();
                foreach ($students as $s) {
                    $student_verify = DB::select('select rut from users where rut = ?', [$s['rut']]);
                    if($student_verify == null)
                    {
                        DB::insert('insert into users (rut, name, email, password, role, enabled) values (?, ?, ?, ?, ?, ?)', [$s['rut'], $s['nombre'], $s['correo'], Hash::make(substr($s['rut'], 0, -2)), 'Estudiante', 1]);
                    }
                    else
                    {
                        array_push($student_error,$s["rut"]);   
                    }
                }

                return back()
                ->with('success', 'Se ha cargado el archivo correctamente')
                ->with('student_list', implode(";",$student_error));                
            }
            else
            {
                return back()->with('error', 'Archivo con formato incorrecto');
            }
        }
        else
        {
            return back()->with('error', 'No se ha adjuntado ningun archivo!');    

        }
    }

    public function indexCourses()
    {
        $query0 = DB::select('select codigo_semestre from Periods where estado = ?', [1]);
        if($query0 != null)
        {
            $data = DB::select('select * from courses c, periods_courses pc where c.id = Coursesid and pc.Periodscodigo_semestre = ?', [$query0[0]->codigo_semestre]);
            return view('User_stories.EncDoc.eaa002.import_data_courses', compact('data'));            
        }
        else
        {
            $data = null;
            return view('User_stories.EncDoc.eaa002.import_data_courses', compact('data'))->with('error', 'No hay semestre habilitado');
        }
    }

    public function importCourses(Request $request)
    {
        $period_code = DB::select('select codigo_semestre from Periods where estado = ?', [1]);
        $file = $request->select_file;
        if($file != null)
        {
            if($period_code == null)
            {
                return back()->with('error', 'No hay semestre habilitado');

            }
            else
            {
                $courses = Excel::toArray(new CourseImport, $request->select_file)[0];
                $file_verify = array_keys($courses[0]);
                //dd($file_verify);
                if($file_verify[0] == 'nrc' && $file_verify[1] == 'codigo_asignatura' && $file_verify[3] == 'nombre_profesor' && $file_verify[2] == 'rut_profesor')
                {
                    $courses_error = array();
                    foreach ($courses as $c) {
                        if($c['nrc'] == null)
                        {
                            //Nada
                        }
                        else
                        {
                            $course_verify = DB::select('select nrc from courses where nrc = ?', [$c['nrc']]);
                            if($course_verify == null)
                            {
                                DB::insert('insert into courses (nrc,codigo_asignatura, rut_profesor, nombre_profesor) values (?, ?, ?, ?)', [$c['nrc'], $c['codigo_asignatura'], $c['rut_profesor'], $c['nombre_profesor']]);
                                $course_id = DB::select('select id from courses where nrc = ?', [$c['nrc']]);
                                DB::insert('insert into periods_courses (Periodscodigo_semestre, Coursesid) values (?, ?)', [$period_code[0]->codigo_semestre, $course_id[0]->id]);
                            }
                            else
                            {
                                $course_id = DB::select('select id from courses where nrc = ?', [$c['nrc']]);
                                $period_code_semestre = DB::select('select Periodscodigo_semestre from Periods_Courses where Periodscodigo_semestre = ? and Coursesid = ?', [$period_code[0]->codigo_semestre, $course_id[0]->id]);
                                if($period_code_semestre == null)
                                {
                                    DB::insert('insert into periods_courses (Periodscodigo_semestre, Coursesid) values (?, ?)', [$period_code[0]->codigo_semestre, $course_id[0]->id]);
                                }
                                else
                                {
                                    array_push($courses_error,$c["nrc"]);
                                }
                            }                    
                        }
                    }

                    return back()
                    ->with('success', 'Se ha cargado el archivo correctamente')
                    ->with('courses_list', implode(";",$courses_error)); 
                }
                else
                {
                    
                    return back()->with('error', 'Archivo con formato incorrecto');
                }
               
            }

        }
        else
        {
            return back()->with('error', 'No se ha adjuntado ningun archivo!');

        }
    }

    public function indexAssistants() // Cargar Importar
    {

        $query0 = DB::select('select codigo_semestre from Periods where estado = ?', [1]);
        //dd($query0);
        if($query0 != null)
        {
            $data = DB:: select('select ac.Usersrut, c.nrc from assistants_courses ac, courses c where ac.Coursesid = c.id');
            //dd($data);
            return view('User_stories.EncDoc.eaa004.import_data_assistants', compact('data'));           
        }
        else
        {
            $data = null;
            return view('User_stories.EncDoc.eaa004.import_data_assistants', compact('data'))->with('error', 'No hay semestre habilitado'); 
        }

    }

    public function importAssistants(Request $request) // Cargamos datos con un excel o otro
    {
        $period_code = DB::select('select codigo_semestre from Periods where estado = ?', [1]);
        $file = $request->select_file;
        if($file != null)
        {
            
            if($period_code == null)
            {
                return back()->with('error', 'No hay semestre habilitado');
            }
            else
            {
                $assistants = Excel::toArray(new Assistants_CoursesImport, $request->select_file)[0];
                $file_verify = array_keys($assistants[0]);

                if($file_verify[0] == 'nrc' && $file_verify[1] == 'rut')
                {
                    $assistants_error = array();
                    $courses_error = array();
                    $assistants_Cverify = array();
                    $courses_Cverify = array();
                    $courses_verify = array();

                    foreach ($assistants as $a) {

                        if($a['nrc'] == null)
                        {
                            //Nada
                        }
                        else
                        {

                            $assistants_verify = DB::select('select rut from users where rut = ? and (role = ? or role = ?)', [$a['rut'], 'Ayudante', 'Estudiante']);
                            //dd($assistants_verify);
                            if($assistants_verify != null)
                            {
                                $course_id = DB::select('select id from courses where nrc = ?', [$a['nrc']]);
                                if($course_id == null)
                                {
                                    array_push($courses_verify, $a["nrc"]);
                                }
                                else
                                {                                
                                    //dd($course_id, $a['nrc']);
                                    $period_course_verify = DB::select('select Periodscodigo_semestre from periods_courses where Periodscodigo_semestre = ? and Coursesid = ?', [$period_code[0]->codigo_semestre, $course_id[0]->id]);
                                    //dd($period_course_verify, $period_code);
                                    if($period_course_verify[0]->Periodscodigo_semestre == $period_code[0]->codigo_semestre)
                                    {
                                        $assistants_courses = DB::select('select Usersrut from assistants_courses where Usersrut = ? and Coursesid = ?', [$a['rut'], $course_id[0]->id]);
                                        
                                        if($assistants_courses == null)
                                        {
                                            DB::update('update users set role = ? where rut = ?', ['Ayudante', $a['rut']]);
                                            DB::insert('insert into assistants_courses (Usersrut, Coursesid) values (?, ?)', [$a['rut'], $course_id[0]->id]);

                                        }
                                        else
                                        {
                                            array_push($assistants_Cverify,$a["rut"]);
                                            array_push($courses_Cverify,$a["nrc"]);
                                        }
                                    }
                                    else
                                    {
                                        array_push($courses_error,$a["nrc"]);  
                                    }                                
                                }
                            }
                            else
                            {
                                array_push($assistants_error,$a["rut"]);
                            }           
                        }
                    }


                    return back()
                    ->with('success', 'Se ha cargado el archivo correctamente')
                    ->with('courses_list', implode(";",$courses_error)) 
                    ->with('assistants_list', implode(";",$assistants_error))
                    ->with('assistants_C_list', implode(";",$assistants_Cverify))
                    ->with('courses_C_list', implode(";",$courses_Cverify))
                    ->with('courses_verify', implode(";",$courses_verify));                    
                }
                else
                {
                    return back()->with('error', 'Archivo con formato incorrecto');
                }

            }
        }
        else
        {
            return back()->with('error', 'No se ha adjuntado ningun archivo!');
        }
    }

    public function indexAssociate() // Cargar Importar
    {
        $period_verify = DB::select('select codigo_semestre from Periods where estado = ?', [1]);
        if($period_verify != null)
        {
            $data = DB::select('select sc.Usersrut, c.nrc from students_courses sc, courses c where sc.Coursesid = c.id');
            return view('User_stories.EncDoc.eaa005.import_data_associate', compact('data'));
        }
        else
        {
            $data = null;
            return view('User_stories.EncDoc.eaa005.import_data_associate', compact('data'))->with('error', 'No hay semestre habilitado!');
        }
        
    }

    public function importAssociate(Request $request) // Cargamos datos con un excel o otro
    {
        $period_code = DB::select('select codigo_semestre from Periods where estado = ?', [1]);
        $file = $request->select_file;
        if($file != null)
        {
            if($period_code == null)
            {
                return back()->with('error', 'No hay semestre habilitado');
            }
            else
            {
                $associate = Excel::toArray(new Students_CoursesImport, $request->select_file)[0];
                $file_verify = array_keys($associate[0]);
                if($file_verify[0] == 'rut' && $file_verify[1] == 'nrc')
                {
                    $students_error = array();
                    $courses_error = array();
                    $students_Cverify = array();
                    $courses_Cverify = array();
                    $courses_verify = array();



                    foreach ($associate as $a) {
                        if($a['nrc'] == null)
                        {
                            //Nada
                        }
                        else
                        {
                            $students_verify = DB::select('select rut from users where rut = ? and role = ?', [$a['rut'], 'Estudiante']);
                            if($students_verify != null)
                            {
                                $course_id = DB::select('select id from courses where nrc = ?', [$a['nrc']]);
                                if($course_id == null)
                                {
                                    array_push($courses_verify,$a["nrc"]);
                                }
                                else
                                {
                                    $period_course_verify = DB::select('select Periodscodigo_semestre from periods_courses where Periodscodigo_semestre = ? and Coursesid = ?', [$period_code[0]->codigo_semestre, $course_id[0]->id]);
                                    if($period_course_verify[0]->Periodscodigo_semestre == $period_code[0]->codigo_semestre)
                                    {
                                        $students_courses = DB::select('select Usersrut from students_courses where Usersrut = ? and Coursesid = ?', [$a['rut'], $course_id[0]->id]);
                                        if($students_courses == null)
                                        {
                                            DB::insert('insert into students_courses (Usersrut, Coursesid) values (?, ?)', [$a['rut'], $course_id[0]->id]);

                                        }
                                        else
                                        {
                                            array_push($students_Cverify,$a["rut"]);
                                            array_push($courses_Cverify,$a["nrc"]);
                                        }
                                    }
                                    else
                                    {
                                        array_push($courses_error,$a["nrc"]);  
                                    }                                
                                }
                            }
                            else
                            {
                                array_push($students_error,$a["rut"]);
                            }           
                        }
                    }

                    return back()
                    ->with('success', 'Se ha cargado el archivo correctamente')
                    ->with('courses_list', implode(";",$courses_error)) 
                    ->with('students_list', implode(";",$students_error))
                    ->with('students_C_list', implode(";",$students_Cverify))
                    ->with('courses_C_list', implode(";",$courses_Cverify))
                    ->with('courses_verify', implode(";",$courses_verify));
                }
                else
                {
                    return back()->with('error', 'Archivo con formato incorrecto');
                }
                
            }
        }
        else
        {
            return back()->with('error', 'No se ha adjuntado ningun archivo!');
        }
    }

}
