<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;
use App\Imports\CourseImport;
use App\Imports\Assistants_CoursesImport;
use App\Imports\Students_CoursesImport;

use Throwable;

class ImportDataController extends Controller
{
    public function indexStudents() // Cargar Importar
    {
        //Aca creamos una query para que nos ponga la tabla usuarios en este orden y despues desplegarla en import_data
        $data = DB::table('users')->where('role','Estudiante')->orderBy('name', 'asc')->get();
        return view('User_stories.EncDoc.eaa001.import_data', compact('data'));
    }

    public function importStudents(Request $request) // Cargamos datos con un excel o otro
    {
        $file = $request->select_file;
        if($file != null)
        {
            try 
            {
                $Students = Excel::import(new UserImport, $request->select_file);
                return back()->with('success', 'Se ha cargado el archivo correctamente');  
            } 
            catch (\Throwable $th) 
            {
                return back()->with('error', 'Hay alumnos duplicados en el archivo o el excel no tiene el formato correcto');
            }
        }
        else
        {
            return back()->with('error', 'No se ha adjuntado ningun archivo!');    
        }
    }

    public function indexCourses() // Cargar Importar
    {
        //Aca creamos una query para que nos ponga la tabla usuarios en este orden y despues desplegarla en import_data
        $query0 = DB::select('select codigo_semestre from Periods where estado = ?', [1]);
        if($query0 != null)
        {
            $data = DB::select('select * from courses c, periods_courses pc where c.id = Coursesid and pc.Periodscodigo_semestre = ?', [$query0[0]->codigo_semestre]);
            return view('User_stories.EncDoc.eaa002.import_data_courses', compact('data'));            
        }
        else
        {
            $data = null;
            return view('User_stories.EncDoc.eaa002.import_data_courses', compact('data'));
        }
    }

    public function importCourses(Request $request) // Cargamos datos con un excel o otro
    {
        $query0 = DB::select('select codigo_semestre from Periods where estado = ?', [1]);
        $file = $request->select_file;
        if($file != null)
        {
            try 
            {
                $Courses = Excel::import(new CourseImport, $request->select_file);
                return back()->with('success', 'Las asignaturas han sido cargadas correctamente');                
            } 
            catch (\Throwable $th) 
            {
                if ($query0 == null) 
                {
                    return back()->with('error', 'No hay semestre habilitado');
                }
                else
                {
                    return back()->with('error', 'Hay asignaturas duplicadas o el archivo no tiene el formato correcto'); 
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
        if($query0 != null)
        {
            $data = DB:: select('select ac.Usersrut, c.nrc from assistants_courses ac, courses c where ac.Coursesid = c.id');
            return view('User_stories.EncDoc.eaa004.import_data_assistants', compact('data'));           
        }
        else
        {
            $data = null;
            return view('User_stories.EncDoc.eaa004.import_data_assistants', compact('data')); 
        }
    }

    public function importAssistants(Request $request) // Cargamos datos con un excel o otro
    {
        $query0 = DB::select('select codigo_semestre from Periods where estado = ?', [1]);
        $file = $request->select_file;
        if($file != null)
        {
            try
            {
                $AssistantsCourses = Excel::import(new Assistants_CoursesImport, $request->select_file);
                return back()->with('success', 'Los ayudantes han sido asignados');
            }
            catch (\Throwable $th)
            {
                if ($query0 == null) 
                {
                    return back()->with('error', 'No hay semestre habilitado');
                }
                else
                {
                    return back()->with('error', 'Hay ayudantes duplicados o el archivo no tiene el formato correcto'); 
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
        //Aca creamos una query para que nos ponga la tabla usuarios en este orden y despues desplegarla en import_data
        $data = DB::select('select sc.Usersrut, c.nrc from students_courses sc, courses c where sc.Coursesid = c.id');
        return view('User_stories.EncDoc.eaa005.import_data_associate', compact('data'));
    }

    public function importAssociate(Request $request) // Cargamos datos con un excel o otro
    {
        try
        {
            $StudentsCourses = Excel::import(new Students_CoursesImport, $request->select_file);
            return back()->with('success', 'Los estudiantes han sido asignados');
        }
        catch (Throwable $th)
        {
            return back()->with('error', 'Los estudiantes no han sido asignados');
        }
    }
}
