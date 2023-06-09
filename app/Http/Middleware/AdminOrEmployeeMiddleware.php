<?php

namespace App\Http\Middleware;

use Closure;

class AdminOrEmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($request->user() && ($request->user()->type === 'admin' || $request->user()->type === 'employee')) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
