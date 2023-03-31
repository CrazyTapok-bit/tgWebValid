<?php

namespace TgWebValid\Entities\Make;

use TgWebValid\Entities\InitData\Chat;
use TgWebValid\Entities\InitData\Receiver;
use TgWebValid\Entities\InitData\User;

class InitDataMake extends Make
{
    public function __construct(array $props)
    {
        foreach ($props as $prop => $value) {
            $props[$prop] = match ($prop) {
                'user'     => new User(json_decode($value, true)),
                'receiver' => new Receiver(json_decode($value, true)),
                'chat'     => new Chat(json_decode($value, true)),
                default    => $value
            };
        }
        parent::__construct($props);
    }
}
