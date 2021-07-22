<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students_Courses extends Model
{
    use HasFactory;

    protected $fillable = [
        'Usersrut',
        'Coursesid'
    ];

}
