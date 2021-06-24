<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistants_Courses extends Model
{
    use HasFactory;


    protected $fillable = [
        'AssistantsProfilesrut',
        'Coursesnrc'
    ];


}
