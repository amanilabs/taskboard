<?php

if (! function_exists('get_initials')) {
    function get_initials(string $name = null): string
    {
        $name = trim($name);
        $parts = preg_split('/\s+/u', $name, 2, PREG_SPLIT_NO_EMPTY);

        $first  = mb_strtoupper(mb_substr($parts[0] ?? '', 0, 1, 'UTF-8'), 'UTF-8');
        $second = mb_strtoupper(mb_substr($parts[1] ?? '', 0, 1, 'UTF-8'), 'UTF-8');

        return $first . ($parts[1] ?? '' ? $second : '');
    }
}
