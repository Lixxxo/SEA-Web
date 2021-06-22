<?php

namespace App\Imports;

use App\Models\Assistants_Courses;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class Assistants_CoursesImport implements ToModel,WithHeadingRow,WithChunkReading,SkipsOnError
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $query0 = DB::select('select rut from users where rut = ? and role = ?', [$row['rut'], 'Ayudante']);
        if($query0 != NULL)
        {
            $query1 = DB::select('select Usersrut from Assistants_Courses where Usersrut = ? and Coursesnrc = ?', [$row['rut'], $row['nrc']]);

            if($query1 == NULL)
            {
                $query2 = DB::insert('insert into assistants_courses (Usersrut, Coursesnrc) values (?, ?)', [$row['rut'], $row['nrc']]);

                return new Assistants_Courses([
                ]);       
            }
            else
            {
                return NULL;
            }
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
