<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'check.for.price' => \App\Http\Middleware\CheckForPrice::class,
            'check.for.auth' => \App\Http\Middleware\CheckForAuth::class,

            // Add more aliases as needed
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
