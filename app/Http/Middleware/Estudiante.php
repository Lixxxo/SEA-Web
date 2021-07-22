<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Estudiante
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
        if (!in_array(auth()->user()->role, array('Estudiante','Ayudante'))){

            return redirect('/404');
        }

        return $next($request);
    }
}
