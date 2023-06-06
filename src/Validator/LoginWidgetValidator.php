<?php

namespace TgWebValid\Validator;

use TgWebValid\Entities\LoginWidget;
use TgWebValid\Exceptions\ValidationException;

final class LoginWidgetValidator extends Validator
{
    /**
     * @param array<string, int|string|bool> $data
     */
    public function validate(array $data): LoginWidget|false
    {
        $user = new LoginWidget($data);

        $rawData = $this->prepare($data);
        $rawData = $this->sort($rawData);
        $rawData = $this->ridHash($rawData);
        $data    = $this->implode($rawData);
        $hash    = hashLoginWidget($data, $this->token);

        if (!$this->matchHash($hash, $user->hash)) {
            if ($this->throw) {
                throw new ValidationException('Telegram Login Widget authentication error. Hash does not match.');
            }
            return false;
        }

        return $user;
    }
}
