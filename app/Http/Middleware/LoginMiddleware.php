<?php

namespace App\Http\Middleware;

use Closure;

use Session;
use Redirect;

class LoginMiddleware
{
    
    public function handle($request, Closure $next)
    {
        // 判斷是否已登入，如果沒登入就踢去登入頁面
        if (!Session::has('id') || !Session::has('username') || !Session::has('photo')) {
            
            return Redirect::to('/');
        }
        return $next($request);
    }
}
