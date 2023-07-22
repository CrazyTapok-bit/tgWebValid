<?php

namespace TgWebValid\Test;

use PHPUnit\Framework\TestCase;
use TgWebValid\Bot;
use TgWebValid\BotConfig;
use TgWebValid\Exceptions\BotException;
use TgWebValid\TgWebValid;

class TgWebValidTest extends TestCase
{
    protected TgWebValid $manager;

    public function setUp(): void
    {
        $this->manager = new TgWebValid('DEFAULT_BOT_TOKEN');
        $this->manager->addBot(new BotConfig('next', 'NEXT_BOT_TOKEN'));
        $this->manager->addBot(new BotConfig('other', 'OTHER_BOT_TOKEN'));
    }

    public function testWithoutName(): void
    {
        $bot = $this->manager->bot();
        $this->assertInstanceOf(Bot::class, $bot);
    }

    public function testWithName(): void
    {
        $bot = $this->manager->bot('next');
        $this->assertInstanceOf(Bot::class, $bot);
    }

    public function testWithNameNotFound(): void
    {
        $this->expectException(BotException::class);
        $this->manager->bot('any');
    }
}
