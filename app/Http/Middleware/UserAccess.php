<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $userType)
    {
        if($userType=='admin')
        {
            $userType=2;
        }
        elseif($userType=='manager')
        {
            
            $userType=1;
        }
        elseif($userType=='user')
        {
            $userType=0;
        }

        if(auth()->user()->type == $userType)
        {
            return $next($request);    
        }
        return response()->json(["Not permission"]);
        
    }
}
