<?php

namespace TgWebValid;

use TgWebValid\Entities\InitData;
use TgWebValid\Entities\LoginWidget;
use TgWebValid\Validator\InitDataValidator;
use TgWebValid\Validator\LoginWidgetValidator;

class TgWebValid
{
    public function __construct(
        private string $token
    )
    {
    }

    public function isValid(string $initData): InitData|false
    {
        $validator = new InitDataValidator($this->token);
        return $validator->validate($initData);
    }

    public function isLoginValid(array $user): LoginWidget|false
    {
        $validator = new LoginWidgetValidator($this->token);
        return $validator->validate($user);
    }
}
