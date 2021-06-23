<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $primaryKey = "nrc";
    protected $fillable = ['nrc','codigo_asignatura','nombre_profesor','rut_profesor'];
    use HasFactory;
}
