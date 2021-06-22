<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveyController extends Controller
{
    //
    public function index(){

        $survey_list = DB::select('select * from surveys where active = ?', [1])
        return view("User_Stories.EncDoc.enc001.surveys");
    }
}
