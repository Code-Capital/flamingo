<?php

use Illuminate\Support\Str;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

if (! function_exists('getPaginated')) {
    function getPaginated($limit = 5): int
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
