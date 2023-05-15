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

if (!function_exists('hashLoginWidget')) {
    /**
     * Calculates hash for LoginWidget using the specified token and data.
     *
    * @param string $data The data to calculate the hash for.
    * @param string $token The token used for hashing.
    * @return string The calculated hash.
     */
    function hashLoginWidget(string $data, string $token): string
    {
        $secretKey = hash('sha256', $token, true);
        return hash_hmac('sha256', $data, $secretKey);
    }
}


if (!function_exists('hashInitData')) {
    /**
     * Calculates hash for InitData using the specified token and data.
     *
    * @param string $data The data to calculate the hash for.
    * @param string $token The token used for hashing.
    * @return string The calculated hash.
     */
    function hashInitData(string $data, string $token): string
    {
        $secretKey = hash_hmac('sha256', $token, 'WebAppData', true);
        return bin2hex(hash_hmac('sha256', $data, $secretKey, true));
    }
}
