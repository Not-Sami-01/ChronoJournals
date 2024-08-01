<?php
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Providers\SessionServiceProvider;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Add your middleware configuration here
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Add your exception handling configuration here
    })
    ->withProviders([
        SessionServiceProvider::class,
        // Add other providers if needed
    ])
    ->create();
