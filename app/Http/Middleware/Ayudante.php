<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Ayudante
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
        try {
            $user_role = Auth::user()->role;
        } catch (\Throwable $th) {
            return redirect('/login');
        }
        if ($user_role != 'Ayudante'){
            return redirect('/404');
        }
        return $next($request);
    }
}
