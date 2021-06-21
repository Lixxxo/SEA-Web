<?php

namespace App\Imports;

use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;

class CourseImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $query0 = DB::select('select nrc from courses where nrc = ?', [$row['nrc']]);
        if($query0 == NULL)
        {
            $query1 = DB::select('select rut from users where role = ? and enbaled = ?', ['Encargado Docente', 1]);
            $query2 = DB::insert('insert into courses (nrc,	codigo_asignatura, rut_profesor, nombre_profesor, Teacher_ManagersProfilesrut) values (?, ?, ?, ?, ?)', [$row['nrc'], $row['codigo_asignatura'], $row['rut_profesor'], $row['nombre_profesor'], $query1[0]->rut]);

            $query3 = DB::select('select codigo_semestre from Periods where estado = ?', [1]);
            $query4 = DB::insert('insert into periods_courses (Periodscodigo_semestre, Coursesnrc) values (?, ?)', [$query3[0]->codigo_semestre, $row['nrc']]);

            return new Course([
            ]);
        }
        else
        {
            return NULL;
        }

    }
}
