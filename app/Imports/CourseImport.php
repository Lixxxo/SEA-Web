<?php

namespace App\Imports;

use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class CourseImport implements ToModel,WithHeadingRow,WithChunkReading,SkipsOnError
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
            $query1 = DB::insert('insert into courses (nrc,	codigo_asignatura, rut_profesor, nombre_profesor) values (?, ?, ?, ?)', [$row['nrc'], $row['codigo_asignatura'], $row['rut_profesor'], $row['nombre_profesor']]);

            $query2 = DB::select('select codigo_semestre from Periods where estado = ?', [1]);
            $query3 = DB::insert('insert into periods_courses (Periodscodigo_semestre, Coursesid) values (?, last_insert_id())', [$query2[0]->codigo_semestre]);

            return new Course([
            ]);
        }
        else
        {
            return NULL;
        }

    }

    public function chunkSize(): int
    {
        return 1000;

    }

    public function onError(Throwable $e)
    {

    }
}
