<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Throwable;

class UserImport implements ToModel,WithHeadingRow,WithChunkReading,SkipsOnError,SkipsOnFailure
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $student_verify = DB::select('select rut from users where rut = ?', [$row['rut']]);
        if($student_verify == null)
        {
            return new User([
                'rut' => $row['rut'],
                'name' => $row['nombre'],
                'email' => $row['correo'],
                'password' => Hash::make(substr($row['rut'], 0, -2)),
                'role' => 'Estudiante',
                'enabled' => 1
            ]);              
        }
        else
        {
            return back()->with('error');
            
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function onError(Throwable $error)
    {
        
    }

    public function onFailure(\Maatwebsite\Excel\Validators\Failure ...$failures)
    {
        
    }
}
