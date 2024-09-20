<?php

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Collection;
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
    function limitString(?string $string = null, $limit = 100): string
    {
        return $string
            ? Str::limit($string, $limit, '...')
            : '';
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
    function convertSnakeCaseToUpperCase(?string $string = null): string
    {
        return $string
            ? ucfirst(str_replace('_', ' ', $string))
            : '';
    }
}
if (! function_exists('getPeoples')) {
    function getPeoples(?User $user = null, int $limit = 10, bool $pagination = false)
    {
        // Get user interests and friend IDs
        $interests = $user->interests()->pluck('interest_id')->toArray();
        $friendsIds = $user->reverseFriends->pluck('id')->toArray();

        // Build the query
        $query = $user->byInterests($interests)
            ->whereNotIn('id', $friendsIds) // Exclude friends
            ->byNotUser($user->id); // Exclude the current user

        // Return the result based on pagination
        if ($pagination) {
            return $query->paginate(getPaginated($limit));
        } else {
            return $query->limit($limit)->get();
        }
    }
}

if (! function_exists('getInterval')) {
    function getInterval($interval)
    {
        switch ($interval) {
            case 'day':
                return 'Daily';
            case 'week':
                return 'Weekly';
            case 'month':
                return 'Monthly';
            case 'quarter':
                return 'Quarterly';
            case 'year':
                return 'Yearly';
            default:
                return ucfirst($interval) . 'ly';
        }
    }
}
if (! function_exists('getPeoples')) {
    function getPeoples(User $user): Collection
    {
        $interests = $user->interests()->pluck('interest_id')->toArray();

        $peoples = $user->byInterests($interests)
            ->byNotUser($user->id)
            ->limit(10)
            ->get();

        return $peoples;
    }
}
if (! function_exists('getAllowedENVs')) {
    function getAllowedENVs(array $envs = [], array $discard = []): array
    {
        $allowed = [];
        foreach ($envs as $env) {
            if (! in_array($env, $discard)) {
                $allowed[] = $env;
            }
        }

        return $allowed;
    }
}
