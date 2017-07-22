<?php

namespace App\Http\Middleware;

use Closure;

use Session;
use Redirect;

class LoginMiddleware
{
    
    public function handle($request, Closure $next)
    {
        // 判斷登入
        if (!Session::has('id') || !Session::has('username') || !Session::has('photo')) {
            
            return Redirect::to('/login');
        }
        return $next($request);
    }
}
