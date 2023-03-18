<?php

namespace TgWebValid;

use TgWebValid\Entities\InitData\Chat;
use TgWebValid\Entities\InitData\Receiver;
use TgWebValid\Entities\InitData\User;

class Field
{
    public function __construct(
        public string $name,
        public mixed $value
    ) {
        $this->value = match ($name) {
            'user'     => new User(json_decode($this->value, true)),
            'receiver' => new Receiver(json_decode($this->value, true)),
            'chat'     => new Chat(json_decode($this->value, true)),
            default    => $this->value
        };
    }

    public function toArray()
    {
        return [$this->name => $this->value];
    }
}
