<?php

namespace TgWebValid\Validator;

abstract class Validator
{
    public function __construct(
        protected string $token
    )
    {
    }

    protected function prepare(array $data): array
    {
        return array_map(
            fn($value, $key)  => $key . '=' . $value,
            $data,
            array_keys($data)
        );
    }

    protected function ridHash(array $array): array
    {
        return preg_grep('/^hash=/i', $array, PREG_GREP_INVERT);
    }

    protected function implode(array $data): string
    {
        return implode("\n", $data);
    }

    protected function sort(array $data): array
    {
        sort($data);
        return $data;
    }
}
