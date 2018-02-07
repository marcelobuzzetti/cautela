<?php

namespace cautela\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ControleAcesso
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(Auth::check()){
            if(Auth::user()->perfil == 1){

            }
        } else {
             return redirect('/home');
        }
    }
}
