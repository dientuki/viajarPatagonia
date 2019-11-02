<?php

namespace App\Http\Middleware;

use Closure;

class SetAdminLocale
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
        app()->setLocale('es');
        return $next($request);
    }
}
