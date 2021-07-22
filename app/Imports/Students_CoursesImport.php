<?php

namespace App\Imports;

use App\Models\Students_Courses;
use Maatwebsite\Excel\Concerns\ToModel;
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
        return new students_courses([
            'Usersrut' => $row['rut'],
            'Coursesid' => $row['nrc']
        ]);
    }


    public function chunkSize(): int
    {
        return 1000;

    }

    public function onError(Throwable $th)
    {
        
    }
}
