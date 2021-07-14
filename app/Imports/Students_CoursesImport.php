<?php

namespace App\Imports;

use App\Models\Students_Courses;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;


class Students_CoursesImport implements ToModel,WithHeadingRow,WithChunkReading,SkipsOnError
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $query0 = DB::select('select rut from users where rut = ?', [$row['rut']]);
        $rol = DB::select('select role from users where rut = ?', [$row['rut']]);


        if($query0 != NULL && ($rol[0]->role == 'Estudiante' || $rol[0]->role == 'Ayudante'))
        {
            $course_id = DB::select('select id from courses where nrc = ?', [$row['nrc']])[0]->id;

            $query2 = DB::select('select codigo_semestre from periods where estado = 1');

            if($query2 != null)
            {
                $query3 = DB::select('select Periodscodigo_semestre from periods_courses where Periodscodigo_semestre = ? and Coursesid = ?', [$query2[0]->codigo_semestre, $course_id]);
                
                if($query3 != null)
                {
                    $query1 = DB::select('select Usersrut from Students_Courses where Usersrut = ? and Coursesid = ?', [$row['rut'], $course_id]);

                    if($query1 == null)
                    {
                        $query4 = DB::insert('insert into students_courses (Usersrut, Coursesid) values (?, ?)', [$row['rut'], $course_id]);

                        return null;       
                    }
                    else
                    {
                        return null;
                    }                
                }
                else
                {
                    return null;
                }
            }
            else
            {
                //Poner alerta
                return null;
            }
        }
        else
        {
            return null;
        }
    }


    public function chunkSize(): int
    {
        return 1000;

    }

    public function onError(Throwable $th)
    {
        
    }
}
