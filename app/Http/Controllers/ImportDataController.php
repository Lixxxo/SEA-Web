<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;
use App\Imports\CourseImport;
use App\Imports\Assistants_CoursesImport;
use Throwable;

class ImportDataController extends Controller
{
    public function indexStudents() // Cargar Importar
    {
        //Aca creamos una query para que nos ponga la tabla usuarios en este orden y despues desplegarla en import_data
        $data = DB::table('users')->where('role', 'Estudiante')->orderBy('name', 'desc')->get();
        return view('User_stories.EncDoc.eaa001.import_data', compact('data'));
    }

    public function importStudents(Request $request) // Cargamos datos con un excel o otro
    {
        try {
            $Students = Excel::import(new UserImport, $request->select_file);
            return back()->with('success', 'Los alumnos han sido cargados correctamente');
        } catch (Throwable $th) {
            return back()->with('error', 'Los alumnos no han sido cargados correctamente');
        }
    }

    public function indexCourses() // Cargar Importar
    {
        //Aca creamos una query para que nos ponga la tabla usuarios en este orden y despues desplegarla en import_data
        $data = DB::table('courses')->orderBy('nrc', 'desc')->get();
        return view('User_stories.EncDoc.eaa002.import_data_courses', compact('data'));
    }

    public function importCourses(Request $request) // Cargamos datos con un excel o otro
    {
        $Courses = Excel::import(new CourseImport, $request->select_file);
        try {
            //$Courses = Excel::import(new CourseImport, $request->select_file);
            return back()->with('success', 'Las asignaturas han sido cargadas correctamente');
        } catch (Throwable $error) {
            return back()->with('error', 'Las asignaturas no han sido cargadas correctamente');
        }
    }

    public function indexAssistants() // Cargar Importar
    {
        //Aca creamos una query para que nos ponga la tabla usuarios en este orden y despues desplegarla en import_data
        $data = DB::select('select ac.Usersrut, c.nrc from assistants_courses ac, courses c where ac.Coursesid = c.id');
        return view('User_stories.EncDoc.eaa004.import_data_assistants', compact('data'));
    }

    public function importAssistants(Request $request) // Cargamos datos con un excel o otro
    {

        try {
            $AssistantsCourses = Excel::import(new Assistants_CoursesImport, $request->select_file);
            return back()->with('success', 'Los ayudantes han sido asignados');
        } catch (\Throwable $th) {
            return back()->with('error', 'Los ayudantes no han sido asignados');
        }
    }
}
