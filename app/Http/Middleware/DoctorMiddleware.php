<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class DoctorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

            //checking usere role. admin==1/user==0
            if(Auth::user()->role=="Doctor"){
                return $next($request);
            }
            else{
                return redirect('/home')->with('message','Access Denied.You are not the Admin ');

            }


        return $next($request);
    }

}
