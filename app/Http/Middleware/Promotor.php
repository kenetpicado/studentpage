<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Promotor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (in_array(auth()->user()->rol, ['promotor', 'admin']))
            return $next($request);

        abort(403);
    }
}
