<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class GlobalController extends Controller
{
    //
    public function index()
    {
        return view('User_Stories.EncDoc.das001.dash');
    }
}
