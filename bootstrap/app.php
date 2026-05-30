<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Forzar dinámicamente la ruta de la caché de las vistas en entornos de producción (Render)
if (env('APP_ENV') === 'production' || env('VIEW_COMPILED_PATH')) {
    $compiledPath = env('VIEW_COMPILED_PATH', '/tmp');
    config(['view.compiled' => $compiledPath]);
}

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
    })->create();