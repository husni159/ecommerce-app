<?php

namespace App\Http\Middleware;

use Closure;

class AdminOrEmployeeOrCustomerMiddleware
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

        if ($request->user() && ($request->user()->type === 'admin' || $request->user()->type === 'employee'|| $request->user()->type === 'customer')) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
