<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        $query0 = DB::select('select rut from users where rut = ?', [$row['rut']]);
        if($query0 == NULL)
        {
            $query1 = DB::insert('insert into profiles (rut, nombre_completo, correo_electronico, clave, estado) values (?, ?, ?, ?, ?)', [$row['rut'], $row['nombre'], $row['correo'], Hash::make(substr($row['rut'], 0, -2)), 1]);
            $query2 = DB::insert('insert into profiles_roles (Profilesrut, Rolesrol) values (?, ?)', [$row['rut'], 'Estudiante']);
            $query3 = DB::insert('insert into students (Profilesrut) values (?)', [$row['rut']]);
            
            
            return new User([
                'rut' => $row['rut'],
                'name' => $row['nombre'],
                'email' => $row['correo'],
                'password' => Hash::make(substr($row['rut'], 0, -2)),
                'role' => 'Estudiante'
            ]);            
        }
        else
        {
            return back()->with('error', 'El alumno o ciertos alumnos estan duplicados');
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
