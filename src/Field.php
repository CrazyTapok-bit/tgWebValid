<?php

namespace TgWebValid;

use TgWebValid\Entities\TgWebChat;
use TgWebValid\Entities\TgWebReceiver;
use TgWebValid\Entities\TgWebUser;

class Field
{
    public function __construct(
        public string $name,
        public mixed $value
    ) {
        $this->value = match ($name) {
            'user'     => new TgWebUser(json_decode($this->value, true)),
            'receiver' => new TgWebReceiver(json_decode($this->value, true)),
            'chat'     => new TgWebChat(json_decode($this->value, true)),
            default    => $this->value
        };
    }

    public function toArray()
    {
        return [$this->name => $this->value];
    }
}
