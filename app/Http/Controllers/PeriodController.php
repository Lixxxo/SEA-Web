<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Period;
class PeriodController extends Controller
{
    public function show(){
        $period_list = Period::all();

        return view('period.edit_period', ['period_list' => $period_list]);
    }

    public function store(Request $request){
        $datos_periodo = request()->except('_token');
        Period::insert($datos_periodo);

        $period_list = Period::all();

        return redirect('/dashboard/periods');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $code = $request->code;
        $period = Period::where('code',$code)->first();
        $period->enabled = 0;
        $period->save();
        return redirect('/dashboard/periods');
    }
}
