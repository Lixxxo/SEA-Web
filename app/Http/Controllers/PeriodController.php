<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Period;
class PeriodController extends Controller
{
    //
    public function enable(){
        $period_list = Period::all();

        return view('period.edit_period', ['period_list' => $period_list]);
    }

    public function disable_period(Request $request, $period){

    }

    public function enable_period(){

    }


}
