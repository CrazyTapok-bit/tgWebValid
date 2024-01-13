<?php

namespace TgWebValid;

use TgWebValid\Exceptions\BotException;

final class TgWebValid
{
    /**
     * @var BotConfig[] $bots
     */
    private array $bots = [];

    public function __construct(
        private readonly string $token,
        private readonly bool $throw = false
    )
    {
    }

    public function addBot(string $name, string $token): void
    {
        $this->bots[$name] = new BotConfig($name, $token);
    }

    public function bot(?string $name = null): Bot
    {
        if(!$name){
            return new Bot($this->token, $this->throw);
        }

        if(!array_key_exists($name, $this->bots)){
            throw new BotException('Bot [' . $name . '] not found in configuration');
        }

        $config = $this->bots[$name];

        return new Bot($config->token, $this->throw);
    }
}
