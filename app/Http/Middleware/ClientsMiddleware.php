<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
class ClientsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){

         if(!Sentinel::guest())
         {
            return $next($request);
           
       }
        else  {
            return redirect('/');
        
        }
    }
}
