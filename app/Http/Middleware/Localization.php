<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if user is logged in, get the locale from the user settings
        if (auth()->check()) {
            app()->setLocale(auth()->user()->locale ?? config('app.locale'));

            return $next($request);
        }

        // if user is not logged in, get the locale from the session
        app()->setLocale(session()->get('locale', config('app.locale')));

        return $next($request);
    }
}
