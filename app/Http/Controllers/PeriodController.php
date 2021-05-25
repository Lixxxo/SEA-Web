<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Period;
class PeriodController extends Controller
{

    //
    public function show(){
        $period_list = Period::all();

        return view('period.edit_period', ['period_list' => $period_list]);
    }

    public function edit($code){
        $period = Period::findOrFail($code);
        return view('/dashboard/periods');
        //$code = $request->only('Codigo');
        //$period = Period::findOrFail($code);
        //Period::
        //return redirect('/dashboard/periods');
        /*
        try {
            $periodo = Period::find($code);

        } catch (\Throwable $th) {
            //throw $th;
        }

        if($periodo->Estado === 0){

        }else{
            // desabilitar
            // vaya no mas compare

        }
        */
    }

    public function store(Request $request){
        $datosPeriodo = request()->except('_token');
        Period::insert($datosPeriodo);

        $period_list = Period::all();

        return redirect('/dashboard/periods');
    }
}
