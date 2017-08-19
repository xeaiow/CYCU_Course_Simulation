<?php

namespace App\Http\Middleware;

use Closure;

use Session;
use Redirect;
use App\Users;

class verifySuccessMiddleware
{

    public function handle($request, Closure $next)
    {
        $isVerifySuccess = Users::Where('fb_id', Session::get('id'))->Where(['verify.isVerify' => 1])->count();
        
        if ($isVerifySuccess === 1)
        {
            return redirect('/start');
        }
        
        return $next($request);
    }
}
