<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use DB;
class SurveyChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $labels = [];
        $nrcs = [];
        $assistants = DB::table('assistants_courses')->get();
        foreach ($assistants as $ass){
            array_push($labels,$ass->Usersrut);
        }
        foreach ($assistants as $ass){
            array_push($nrcs,$ass->Coursesid);
        }
        return Chartisan::build()
            ->labels($labels)
            ->dataset('Prueba tabla', $nrcs);
 
    }
}