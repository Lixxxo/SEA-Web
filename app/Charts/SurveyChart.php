<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class SurveyChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        return Chartisan::build()
            ->labels(['Lixo', 'Joelo', 'Guetti', 'Noah', 'Pipe'])
            ->dataset('EL NIÑO MAS BONITO', [1, 2, 17, 4.6, 15]);
    }
}