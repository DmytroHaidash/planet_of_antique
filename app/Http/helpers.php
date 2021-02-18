<?php

use Illuminate\Support\Str;

/**
 * @return Closure
 */
if (!function_exists('filenameSanitizer')) {
    function filenameSanitizer(): Closure
    {
        return function ($fileName) {
            $name = pathinfo($fileName, PATHINFO_FILENAME);
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            return Str::slug($name) . '.' . $ext;
        };
    }
}


if (!function_exists('in_array_field')) {
    function in_array_field($needle, $needle_field, $haystack, $strict = false) {
        if ($strict) {
            foreach ($haystack as $item)
                if (isset($item->$needle_field) && $item->$needle_field === $needle)
                    return true;
        }
        else {
            foreach ($haystack as $item)
                if (isset($item->$needle_field) && $item->$needle_field == $needle)
                    return true;
        }
        return false;
    }
}