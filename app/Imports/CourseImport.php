<?php

namespace App\Imports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseImport implements ToModel,WithHeadingRow,WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Course([
            'nrc' => $row['nrc'],
            'codigo_asignatura' => $row['codigo_asignatura'],
            'rut_profesor' => $row['rut_profesor'],
            'nombre_profesor' => $row['nombre_profesor']
        ]);

    }

    public function chunkSize(): int
    {
        return 1000;

    }
}
