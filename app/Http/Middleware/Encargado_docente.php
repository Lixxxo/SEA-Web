<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Encargado_docente
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
        // if role is not in the array
        // https://www.php.net/manual/es/function.in-array.php
        if (!in_array(auth()->user()->role, array('Administrador','Encargado Docente'))){
            return redirect('/404');
        }
        return $next($request);
    }
}
