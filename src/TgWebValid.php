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
        private string $token,
        private bool $throw = false
    )
    {
    }

    public function addBot(BotConfig $bot): void
    {
        $this->bots[$bot->name] = $bot;
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
