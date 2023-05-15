<?php

namespace TgWebValid\Validator;

use TgWebValid\Entities\LoginWidget;

class LoginWidgetValidator extends Validator
{
    public function validate(array $data): LoginWidget|false
    {
        $user = new LoginWidget($data);

        $rawData = $this->prepareRawData($data);
        $rawData = $this->sortData($rawData);
        $rawData = $this->ridHash($rawData);
        $data    = $this->implodeData($rawData);
        $hash    = hashLoginWidget($data, $this->token);

        if (0 === strcmp($hash, $user->hash)) {
            return $user;
        }

        return false;
    }
}
