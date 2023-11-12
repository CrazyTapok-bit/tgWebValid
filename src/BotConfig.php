<?php

namespace TgWebValid;

class BotConfig
{
    public function __construct(
        public readonly string $name,
        public readonly string $token
    )
    {
    }
}
