<?php

namespace TgWebValid\Make;

use TgWebValid\Entities\InitData\Chat;
use TgWebValid\Entities\InitData\Receiver;
use TgWebValid\Entities\InitData\User;

abstract class InitData extends Make
{
    public function __construct(array $props)
    {
        foreach ($props as $prop => $value) {
            $value = match ($prop) {
                'user'     => new User(json_decode($value, true)),
                'receiver' => new Receiver(json_decode($value, true)),
                'chat'     => new Chat(json_decode($value, true)),
                default    => $value
            };
            $this->setProperty(camelize($prop), $value);
        }
    }
}
