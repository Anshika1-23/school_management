<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path=$request->path();
      

        if(( $path == "student/login") && Session::get('first_name')){
            return redirect('student/index');
        }
        else if(($path != 'student/login') && (!Session::get('first_name'))){
            return redirect('student/login');
        }

        return $next($request);
    }
}
