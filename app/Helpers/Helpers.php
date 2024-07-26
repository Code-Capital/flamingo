<?php

use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

if (!function_exists('getPaginated')) {
    function getPaginated($limit = 10): int
    {
        return $limit;
    }
}

if (!function_exists('limitString')) {
    function limitString($string, $limit = 100): string
    {
        if (strlen($string) <= $limit) {
            return $string;
        }

        $trimmedString = substr($string, 0, $limit);
        $lastSpaceIndex = strrpos($trimmedString, ' ');

        if ($lastSpaceIndex !== false) {
            $trimmedString = substr($trimmedString, 0, $lastSpaceIndex);
        }

        return $trimmedString . '...';
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
