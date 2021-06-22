<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class SurveyController extends Controller
{
    //
    public function index(){

        $survey_list = DB::select('select * from surveys');
        return view("User_Stories.EncDoc.enc001.surveys", ['survey_list' => $survey_list]);
    }

    public function create(){
        DB::insert('insert into surveys');
        return view("User_Stories.EncDoc.enc001.edit");
    }

    public function store(){

    }
}
