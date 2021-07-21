<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\PeriodController;
class EnabledPeriod
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!PeriodController::has_enabled_period()){
            return redirect('/404');
        }
        return $next($request);
    }
}
