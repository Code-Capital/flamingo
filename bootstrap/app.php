<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


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
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->report(function (\Throwable $exception, $request) {
            if ($request->is('api/*') || $request->ajax()) {
                $statusCode = $this->getStatusCode($exception);
                return response()->json([
                    'success' => false,
                    'message' => 'Error occurred. Please try again later.',
                ], $statusCode);
            }
        });
    })->create();

function getStatusCode(Throwable $e): int
{
    if ($e instanceof ValidationException) {
        return Response::HTTP_UNPROCESSABLE_ENTITY;
    } elseif ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException) {
        return Response::HTTP_NOT_FOUND;
    } elseif ($e instanceof MethodNotAllowedHttpException) {
        return Response::HTTP_METHOD_NOT_ALLOWED;
    } elseif ($e instanceof AuthenticationException) {
        return Response::HTTP_UNAUTHORIZED;
    } elseif ($e instanceof AuthorizationException) {
        return Response::HTTP_FORBIDDEN;
    } elseif ($e instanceof BadRequestHttpException) {
        return Response::HTTP_BAD_REQUEST;
    }

    return Response::HTTP_INTERNAL_SERVER_ERROR;
}
