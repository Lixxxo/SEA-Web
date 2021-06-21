<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Throwable;

class UserImport implements ToModel,WithHeadingRow,WithChunkReading,SkipsOnError
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $query0 = DB::select('select rut from users where role = ? and enabled = ?', ['Administrador', 1]);
        $query1 = DB::insert('insert into profiles (rut, nombre_completo, correo_electronico, clave, estado, AdministratorsProfilesrut) values (?, ?, ?, ?, ?, ?)', [$row['rut'], $row['nombre'], $row['correo'], Hash::make(substr($row['rut'], 0, -2)), 1, $query0[0]->rut]);
        $query2 = DB::insert('insert into profiles_roles (Profilesrut, Rolesrol) values (?, ?)', [$row['rut'], 'Estudiante']);
        $query3 = DB::insert('insert into student (Profilesrut) values (?)', [$row['rut']]);
        
        
        return new User([
            'rut' => $row['rut'],
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => Hash::make(substr($row['rut'], 0, -2)),
            'role' => 'Estudiante'
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function onError(Throwable $error)
    {
        
    }
}
