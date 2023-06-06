<?php

namespace TgWebValid\Validator;

use TgWebValid\Entities\InitData;
use TgWebValid\Exceptions\ValidationException;

final class InitDataValidator extends Validator
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

        if (!$this->matchHash($hash, $initData->hash)) {
            if ($this->throw) {
                throw new ValidationException('Telegram InitData authentication error. Hash does not match.');
            }
            return false;
        }

        return $initData;
    }

    /**
     * @return array<string, int|string|bool>
     */
    public function parse(string $data): array
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
