<?php

namespace Shureban\LaravelLocalization;

use Closure;
use Illuminate\Http\Request;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $locale   = $request->header(config('localization.header'), config('app.locale'));
        $language = config('localization.languages')[$locale] ?? null;

        if (!is_null($language)) {
            app()->setLocale($language);
        }

        return $next($request);
    }
}