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
        return lcfirst(implode('', array_map('ucfirst', explode('_', $str))));
    }
}
