<?php

use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
        ]);

        $middleware->redirectTo(
            guests: function ($request) {
                if (auth()->guard('customer')->check()) {
                    return route('customer.dashboard');
                }
                if (auth()->guard('web')->check()) {
                    return route('dashboard');
                }
                if ($request->is('customer/*') || $request->is('booking')) {
                    return route('customer.login');
                }

                return route('login');
            },
            users: function ($request) {
                if (auth()->guard('customer')->check()) {
                    return route('customer.dashboard');
                }

                return route('dashboard');
            }
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
