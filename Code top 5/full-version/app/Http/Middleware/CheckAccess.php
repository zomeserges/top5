<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAccess
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

      $path =  \Illuminate\Support\Facades\Request::path();

      //echo $path;
      if(!userLoggedIn()){
        abort(404);
      }elseif (userLoggedIn()){
        return $next($request);
      }
        return $next($request);

    }
}
