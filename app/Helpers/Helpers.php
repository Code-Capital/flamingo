<?php

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

if (! function_exists('getPaginated')) {
    function getPaginated($limit = 25): int
    {
        return $limit;
    }
}

if (! function_exists('limitString')) {
    function limitString($string, $limit = 100): string
    {
        return Str::limit($string, $limit, '...');
    }
}

if (! function_exists('getStatusCode')) {
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
}

if (! function_exists('convertSnakeCaseToUpperCase')) {
    function convertSnakeCaseToUpperCase($string): string
    {
        return ucfirst(str_replace('_', ' ', $string));
    }
}

if (! function_exists('getPeoples')) {
    function getPeoples($user): mixed
    {
        $interests = $user->interests()->pluck('interest_id')->toArray();

        return $user->byInterests($interests)
            ->byNotUser($user->id)
            ->limit(10)
            ->get();
    }
}
