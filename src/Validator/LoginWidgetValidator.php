<?php

namespace TgWebValid\Validator;

use TgWebValid\Entities\LoginWidget;

class LoginWidgetValidator extends Validator
{
    public function validate(array $data): LoginWidget|false
    {
        $user = new LoginWidget($data);

        $rawData = $this->prepare($data);
        $rawData = $this->sort($rawData);
        $rawData = $this->ridHash($rawData);
        $data    = $this->implode($rawData);
        $hash    = hashLoginWidget($data, $this->token);

        if (0 !== strcmp($hash, $user->hash)) {
            return $user;
        }

        return false;
    }
}
