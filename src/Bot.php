<?php

namespace TgWebValid;

use TgWebValid\Entities\InitData;
use TgWebValid\Entities\LoginWidget;
use TgWebValid\Validator\InitDataValidator;
use TgWebValid\Validator\LoginWidgetValidator;

class Bot
{
    public function __construct(
        private readonly string $token,
        private readonly bool $throw = false
    )
    {
    }

    public function validateInitData(string $initData, ?bool $throw = null): InitData|false
    {
        $validator = new InitDataValidator(
            $this->token,
            $throw ?? $this->throw
        );
        return $validator->validate($initData);
    }

    /**
     * @param array<string, int|string|bool> $user
     */
    public function validateLoginWidget(array $user, ?bool $throw = null): LoginWidget|false
    {
        $validator = new LoginWidgetValidator(
            $this->token,
            $throw ?? $this->throw
        );
        return $validator->validate($user);
    }
}
