<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;
use App\Imports\CourseImport;
use App\Imports\Assistants_CoursesImport;

class ImportDataController extends Controller
{
    public function indexStudents() // Cargar Importar
    {
        //Aca creamos una query para que nos ponga la tabla usuarios en este orden y despues desplegarla en import_data
        $data = DB::table('users')->orderBy('name', 'desc')->get();
        return view('User_stories.EncDoc.eaa001.import_data', compact('data'));
    }

    public function importStudents(Request $request) // Cargamos datos con un excel o otro
    {
        $Students = Excel::import(new UserImport, $request->select_file);
        if(is_null($Students))
        {
            return back()->with('error', 'Los alumnos no han sido cargados correctamente');
        }
        else
        {
            return back()->with('success', 'Los alumnos han sido cargados correctamente');
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
        if(is_null($Courses))
        {
            return back()->with('error', 'Las asignaturas no han sido cargadas correctamente');
        }
        else
        {
            return back()->with('success', 'Las asignaturas han sido cargadas correctamente');
        }
        
    }

    public function indexAssistants() // Cargar Importar
    {
        //Aca creamos una query para que nos ponga la tabla usuarios en este orden y despues desplegarla en import_data
        $data = DB::table('Assistants_Courses')->orderBy('Coursesnrc', 'desc')->get();
        return view('User_stories.EncDoc.eaa004.import_data_assistants', compact('data'));
    }

    public function importAssistants(Request $request) // Cargamos datos con un excel o otro
    {
        $AssistantsCourses = Excel::import(new Assistants_CoursesImport, $request->select_file);
        if(is_null($AssistantsCourses))
        {
            return back()->with('error', 'Los ayudantes no han sido asignados');
        }
        else
        {
            return back()->with('success', 'Los ayudantes han sido asignados');
        }
        
    }

}