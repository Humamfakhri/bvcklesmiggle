<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\CheckLaunchDate;
use App\Http\Middleware\OnlyAdminMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AuthenticatedAdminMiddleware;
use App\Http\Middleware\AuthenticatedUserMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'guest' => AuthenticatedUserMiddleware::class,
            'only-admin' => OnlyAdminMiddleware::class,
            'auth-admin' => AuthenticatedAdminMiddleware::class,
            'checkLaunchDate' => CheckLaunchDate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
