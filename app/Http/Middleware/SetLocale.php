<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
{
    public const AVAILABLE = [
        'en',
        'sv'
    ];

    public function handle($request, Closure $next)
    {
        # use locale from session if set
        if (session()->has('locale')) {
            $locale = session()->get('locale', config('app.locale'));

        # or fetch from http header
        } else {
            $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
        }

        # set to default if not available
        if (!in_array($locale, self::AVAILABLE)) {
            $locale = config('app.locale');
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
