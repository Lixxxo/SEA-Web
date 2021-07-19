<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
        public function index(){
        return view("User_Stories.Ayudante.enc004.survey_status");
        }
}
