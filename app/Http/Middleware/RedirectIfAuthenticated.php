<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $userType = Auth::user()->type;
            if ($userType == 'PURCHASER')
                return redirect()->guest('purchaser');
            else if ($userType == 'SALESPERSON')
                return redirect()->guest('salesperson');

            return redirect('/');
        }
        return $next($request);
    }
}
