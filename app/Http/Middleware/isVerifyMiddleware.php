<?php

namespace App\Http\Middleware;

use Closure;

use Session;
use Redirect;
use App\Users;

class isVerifyMiddleware
{
    
    public function handle($request, Closure $next)
    {
        $isVerify = Users::Where('fb_id', Session::get('id'))->Where('isVerify', 'exists', true)->count();

        if ($isVerify === 0)
        {
            return Redirect::to('/verify');
        }


        return $next($request);
    }
}
