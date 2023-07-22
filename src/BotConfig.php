<?php

namespace TgWebValid;

class BotConfig
{
    public function __construct(
        public string $name,
        public string $token
    )
    {
    }
}
