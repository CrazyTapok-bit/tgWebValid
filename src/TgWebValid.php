<?php

namespace TgWebValid;

class TgWebValid
{
    private static string $initDataOrigin;

    private static array $initDataArray;

    public InitData $initData;

    public function __construct(string $initData)
    {
        $this->initData = self::init($initData);
    }

    private static function parse(): array
    {
        self::$initDataArray = explode('&', rawurldecode(self::$initDataOrigin));
        sort(self::$initDataArray);
        return array_merge(...array_map(
            fn ($item) => (new Field(...explode('=', $item)))->toArray(),
            self::$initDataArray
        ));
    }

    private static function init(string $initData): InitData
    {
        self::$initDataOrigin = $initData;
        return new InitData(self::parse());
    }

    public function isValid(string $token)
    {
        $data = implode("\n", array_filter(
            self::$initDataArray,
            fn ($item) => substr($item, 0, strlen('hash=')) !== 'hash='
        ));
        $secretKey = hash_hmac('sha256', $token, 'WebAppData', true);
        $hash      = bin2hex(hash_hmac('sha256', $data, $secretKey, true));

        return 0 === strcmp($hash, $this->initData->hash);
    }
}
