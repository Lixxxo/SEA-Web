<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Period;
class PeriodController extends Controller
{
    //
    public function enable(){
        $period_list = Period::all();

        return view('period.enable_period', ['period_list' => $period_list]);
    }
    

}
