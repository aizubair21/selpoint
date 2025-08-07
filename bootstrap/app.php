<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckApiMasterKey;
use App\Http\Middleware\CheckApiRequestIsGet;
use App\Http\Middleware\CheckApiRequestIsPost;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        api: __DIR__ . '/../routes/api.php',
        apiPrefix: '/api/',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(
            [
                'auth.master' => CheckApiMasterKey::class,
            ]
        );
        // $middleware->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
