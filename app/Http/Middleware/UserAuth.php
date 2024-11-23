<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        
       $path=$request->path();
      

        if(( $path == "staff/login") && Session::get('f_name')){
            return redirect('staff/index');
        }
        else if(($path != 'staff/login') && (!Session::get('f_name'))){
            return redirect('staff/login');
        }

        return $next($request);
    }
}
