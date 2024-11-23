<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ParentAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path=$request->path();
      

        if(( $path == "parent/login") && Session::get('guardian_name')){
            return redirect('parent/index');
        }
        else if(($path != 'parent/login') && (!Session::get('guardian_name'))){
            return redirect('parent/login');
        }

        return $next($request);
    }
}
