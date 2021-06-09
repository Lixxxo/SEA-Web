<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;

class ImportDataController extends Controller
{
    public function indexUsers() // Cargar Importar
    {
        //Aca creamos una query para que nos ponga la tabla usuarios en este orden y despues desplegarla en import_data
        $data = DB::table('users')->orderBy('name', 'desc')->get();
        return view('User_stories.EncDoc.eaa001.import_data', compact('data'));
    }

    public function import(Request $request) // Cargamos datos con un excel o otro
    {
        Excel::import(new UserImport, $request->select_file);
        return back()->with('success', 'Los alumnos han sido cargados correctamente');
    }

    //public function import<Entidad>(Request $request) para los demas

}