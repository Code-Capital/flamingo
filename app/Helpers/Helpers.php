<?php

if (!function_exists('getPaginated')) {
    function getPaginated($limit = 2): int
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
