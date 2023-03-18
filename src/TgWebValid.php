<?php

namespace TgWebValid;

use TgWebValid\Entities\InitData;

class TgWebValid
{
    public InitData $initData;

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

        $data = implode("\n", array_filter(
            $rawData,
            fn ($item) => substr($item, 0, strlen('hash=')) !== 'hash='
        ));

        $secretKey = hash_hmac('sha256', $this->token, 'WebAppData', true);
        $hash      = bin2hex(hash_hmac('sha256', $data, $secretKey, true));

        return 0 === strcmp($hash, $this->initData->hash);
    }
}
