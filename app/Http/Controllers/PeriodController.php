<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Period;
use DB;
class PeriodController extends Controller
{
    public function index(){
        $period_list = DB::select('select * from periods order by (estado) desc');
        if ($this->has_enabled_period()) {
            $enabled_period = DB::select('select * from periods where estado = ?', [1])[0];
        }else {
            $enabled_period = "";
        }
        return view('User_stories.EncDoc.adm002.period.periods', 
        ['period_list' => $period_list, 
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
        
        $code = $request->get("year").$request->get("period") ;
        $description = $request->get("description")
        $period = DB::select('select * from periods where codigo_semestre = ?',[$code]);
        
        if (count($period) == 0) {
            DB::insert('insert into periods (codigo_semestre, descripcion, estado) values (?,?,?)', [$code,$description,1])
        }

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
