<?php

if (!function_exists('camelize')) {
    /**
     * Convert snake_case to camelCase
     *
     * @param string $str
     * @return string
     */
    function camelize(string $str): string
    {
        return lcfirst(str_replace('_', '', mb_convert_case($str, MB_CASE_TITLE, 'UTF-8')));
    }
}
