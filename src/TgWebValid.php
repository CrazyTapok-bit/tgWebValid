<?php

namespace TgWebValid;

use TgWebValid\Entities\InitData;
use TgWebValid\Entities\User;

class TgWebValid
{
    public ?InitData $initData;

    public ?User $user;

    public function __construct(
        private string $token
    )
    {
    }

    public function isValid(string $initData)
    {
        $rawData = explode('&', rawurldecode($initData));

        sort($rawData);

        $this->initData = new InitData(array_merge(...array_map(
            fn ($item) => (new Field(...explode('=', $item)))->toArray(),
            $rawData
        )));

        $data = implode("\n", $this->ridHash($rawData));

        $secretKey = hash_hmac('sha256', $this->token, 'WebAppData', true);
        $hash      = bin2hex(hash_hmac('sha256', $data, $secretKey, true));

        return 0 === strcmp($hash, $this->initData->hash);
    }

    public function isLoginValid(array $user)
    {
        $this->user = new User($user);

        $rawData = array_map(
            fn($value, $key)  => $key . '=' . $value,
            $user,
            array_keys($user)
        );

        sort($rawData);

        $data = implode("\n", $this->ridHash($rawData));

        $secretKey = hash('sha256', $this->token, true);
        $hash      = hash_hmac('sha256', $data, $secretKey);

        return 0 === strcmp($hash, $this->user->hash);
    }

    private function ridHash(array $array): array
    {
        return preg_grep('/^hash=/i', $array, PREG_GREP_INVERT);
    }
}
