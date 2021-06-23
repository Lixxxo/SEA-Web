<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Period;
class PeriodController extends Controller
{
    public function show(){
        $period_list = Period::all();

        return view('User_stories.EncDoc.adm002.period.edit_period', ['period_list' => $period_list]);
    }

    public function has_enabled_period(){
        foreach (Period::all() as $period){
            if ($period->estado == 1){
                return true;
            }
        }
        return false;
    }

    public function store(Request $request){
        if ($this->has_enabled_period()){
            return redirect('/dashboard/periods');
        }

        $period_data = request()->except('_token');

        $code = $request->codigo_semestre;
        $period_code = substr($code, -2);
        if ($period_code == "10" || $period_code == "20") {
            $period = Period::where('codigo_semestre',$code)->first();
            if ($period != null ){
                if ($period->estado === 0){
                    $period->estado = 1;
                    $period->descripcion = $request->descripcion;
                    $period->save();
                }
        }
            else{
                Period::insert($period_data);
            }
        }
        else{
            return redirect('/dashboard/periods'); //TODO: Enviar una alerta indicando que no se pudo habilitar el semestre por codigo invalido.
        }


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
        $period = Period::where('codigo_semestre',$code)->first();

        if ($period != null){
            if ($period->estado === 1){
                $period->estado = 0;
            }
            else{
                //$period->enabled = 1;
                //$period->description = $request->description;
            }
            $period->save();
        }
        return redirect('/dashboard/periods');
    }
}
