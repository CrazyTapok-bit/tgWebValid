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

        if (!$this->matchHash($hash, $user->hash)) {
            return false;
        }

        return $user;
    }
}
