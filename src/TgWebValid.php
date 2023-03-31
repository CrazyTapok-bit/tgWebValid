<?php

namespace TgWebValid;

use TgWebValid\Entities\InitData;
use TgWebValid\Entities\LoginWidget;

class TgWebValid
{
    public ?InitData $initData;

    public ?LoginWidget $user;

    public function __construct(
        private string $token
    )
    {
    }

    public function isValid(string $initData)
    {
        $rawData = explode('&', rawurldecode($initData));

        $rawData = array_merge(...array_map(
            function($item) {
                [$prop, $value] = explode('=', $item);
                return [$prop => $value];
            },
            $rawData
        ));

        $this->initData = new InitData($rawData);

        $rawData = array_map(
            fn($value, $key)  => $key . '=' . $value,
            $rawData,
            array_keys($rawData)
        );

        sort($rawData);

        $data = implode("\n", $this->ridHash($rawData));

        $secretKey = hash_hmac('sha256', $this->token, 'WebAppData', true);
        $hash      = bin2hex(hash_hmac('sha256', $data, $secretKey, true));

        return 0 === strcmp($hash, $this->initData->hash);
    }

    public function isLoginValid(array $user)
    {
        $this->user = new LoginWidget($user);

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
