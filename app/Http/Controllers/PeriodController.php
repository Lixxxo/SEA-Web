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
        $description = $request->get("description");
        $period = DB::select('select * from periods where codigo_semestre = ?',[$code]);

        if (count($period) == 0) {
            DB::insert('insert into periods (codigo_semestre, descripcion, estado) values (?,?,?)', [$code,$description,1]);
        }
        else{
            DB::update('update periods set estado = 1 where codigo_semestre = ?', [$code]);
            if ($description != ""){
                DB::update('update periods set descripcion = ? where codigo_semestre = ?', [$description,$code]);
            }
        }
        // TODO: redireción con error (revisar status de UserController)
        
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
        $period = DB::select('select * from periods where codigo_semestre = ?',[$code]);
        dd($period);
        if ($period == null) {
            //TODO: Enviar aviso de error de semestre no encontrado.
            return redirect('/dashboard/periods');
        }
        if ($period[0] != null){
            if ($period[0]->estado == 1){
                DB::update('update periods set estado = 0 where codigo_semestre = ?', [$code]);
            }
            else{
                DB::update('update periods set estado = 1 where codigo_semestre = ?', [$code]);
            }
        }
        return redirect('/dashboard/periods');
    }
}
