<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */

    public function handle(Request $request, Closure $next)
    {
        $locale = $request->segment(1);
        $segments = $request->segments();
        $language = in_array($locale, config('app.available_locales'));
        $defaultLocale = config('app.fallback_locale');
        URL::defaults(['locale' => $locale ?? $defaultLocale]);

        if (!$language) {
            if (strlen($locale) === 2) {
                array_shift($segments);
            }
            array_unshift($segments, $defaultLocale);
            return $this->redirectTo($segments);
        }


        app()->setLocale($locale);

        return $next($request);
    }

    /**
     * Redirect to default language.
     *
     * @param array $segments
     *
     * @return RedirectResponse
     */
    protected function redirectTo(array $segments): RedirectResponse
    {
        return redirect()->to(implode('/', $segments));
    }

}
