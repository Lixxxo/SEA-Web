<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Period;
use DB;
class PeriodController extends Controller
{
    public function index(){
        $period_list = DB::select('select * from periods order by (estado) desc');
        
        $enabled_period = DB::select('select * from periods where estado = ?', [1])[0];
        
        return view('User_stories.EncDoc.adm002.period.periods', 
        ['period_list' => $period_list, 
        'has_enabled_period' => $this->has_enabled_period(),
        'enabled_period'=> $enabled_period]);
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



        $code = $request->codigo_semestre;
        $request->request->add(['estado' => '1']);
        $period_data = request()->except('_token');
        $period_code = substr($code, -2);
        if ($period_code == "10" || $period_code == "20") {
            $period = Period::where('codigo_semestre',$code)->first();
            //return response()->json($period);
            //dd($period);
            if ($period != null ){
                if ($period->estado === 0){
                    //Period::where('codigo_semestre',$code)->first()->update(['estado' => 1,'descripcion' => $request->descripcion]);
                    DB::update('update periods set estado = ?, descripcion = ? where codigo_semestre = ?', [1, $request->descripcion, $code]);
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
        $code = $request->codigo_semestre;
        $period = Period::where(['codigo_semestre' => $code])->first();
        $period->timestamps = false;

        if ($period != null){
            if ($period->estado === 1){
                //$period->estado = 0;
                $period->update(['estado' => 0]);
            }
            else{
                //$period->enabled = 1;
                //$period->description = $request->description;
            }
            //$period->save();
        }
        return redirect('/dashboard/periods');
    }
}
