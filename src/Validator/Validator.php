<?php

namespace TgWebValid\Validator;

abstract class Validator
{
    public function __construct(
        protected string $token,
        protected bool $throw = false
    )
    {
    }

    /**
     * @param array<string, int|string|bool> $data
     * @return array<int, string>
     */
    public function prepare(array $data): array
    {
        return array_map(
            fn($value, $key)  => $key . '=' . $value,
            $data,
            array_keys($data)
        );
    }

    /**
     * @param array<int, string> $data
     * @return array<int, string>
     */
    public function ridHash(array $data): array
    {
        if ($withoutHash = preg_grep('/^hash=/i', $data, PREG_GREP_INVERT)) {
            return array_values($withoutHash);
        }

        return $data;
    }

    /**
     * @param array<int, string> $data
     */
    public function implode(array $data): string
    {
        return implode("\n", $data);
    }

    /**
     * @param array<int, string> $data
     * @return array<int, string>
     */
    public function sort(array $data): array
    {
        sort($data);
        return $data;
    }

    public function matchHash(string $hash1, string $hash2): bool
    {
        return 0 === strcmp($hash1, $hash2);
    }
}
