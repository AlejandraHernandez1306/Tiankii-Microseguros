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
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->booting(function () {
        // Registrar dinámicamente la ruta de la caché en el arranque oficial del contenedor
        if (env('APP_ENV') === 'production' || env('VIEW_COMPILED_PATH')) {
            config(['view.compiled' => env('VIEW_COMPILED_PATH', '/tmp')]);
        }
    })
    ->create();