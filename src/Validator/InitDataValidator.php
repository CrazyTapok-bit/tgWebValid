<?php

namespace TgWebValid\Validator;

use TgWebValid\Entities\InitData;

class InitDataValidator extends Validator
{
    public function validate(string $data): InitData|false
    {
        $rawData = $this->parse($data);
        $initData = new InitData($rawData);

        $rawData = $this->prepare($rawData);
        $rawData = $this->sort($rawData);
        $rawData = $this->ridHash($rawData);
        $data    = $this->implode($rawData);
        $hash    = hashInitData($data, $this->token);

        if (0 !== strcmp($hash, $initData->hash)) {
            return $initData;
        }

        return false;
    }

    private function parse(string $data): array
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
}
