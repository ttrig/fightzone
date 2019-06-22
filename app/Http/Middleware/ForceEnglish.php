<?php

namespace App\Http\Middleware;

use Closure;

class ForceEnglish
{
    public function handle($request, Closure $next)
    {
        app()->setLocale('en');
        return $next($request);
    }
}
