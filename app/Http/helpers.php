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
