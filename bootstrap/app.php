<?php

use App\Http\Middleware\CheckPremiumStatus;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Middleware\SubstituteBindings;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        channels: __DIR__ . '/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'blockuser' => \App\Http\Middleware\BlockUser::class,
            'check-premium' => CheckPremiumStatus::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // $exceptions->report(function (\Throwable $exception, $request) {
        // if ($request->is('api/*')) {
        //     $statusCode = getStatusCode($exception);
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Error occurred. Please try again later.',
        //     ], $statusCode);
        // }
        // });
    })->create();
