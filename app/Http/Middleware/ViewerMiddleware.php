<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
class ViewerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   //1.user should be authenticated

        if(Sentinel::check())
         {
            return $next($request);
           
       }
        else  {
            return redirect('/');
        
        }
    }
}
