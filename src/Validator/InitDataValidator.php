<?php

namespace TgWebValid\Validator;

use TgWebValid\Entities\InitData;

class InitDataValidator extends Validator
{
    public function validate(string $data): InitData|false
    {
        $rawData = $this->parseData($data);
        $initData = new InitData($rawData);

        $rawData = $this->prepareRawData($rawData);
        $rawData = $this->sortData($rawData);
        $rawData = $this->ridHash($rawData);
        $data    = $this->implodeData($rawData);
        $hash    = $this->calculateHash($data);

        if (0 === strcmp($hash, $initData->hash)) {
            return $initData;
        }

        return false;
    }

    private function parseData(string $data): array
    {
        $rawData = explode('&', rawurldecode($data));

        return array_merge(...array_map(
            function($item) {
                [$prop, $value] = explode('=', $item);
                return [$prop => $value];
            },
            $rawData
        ));
    }

    private function calculateHash(string $data): string
    {
        $secretKey = hash_hmac('sha256', $this->token, 'WebAppData', true);
        return bin2hex(hash_hmac('sha256', $data, $secretKey, true));
    }
}
