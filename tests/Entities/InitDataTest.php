<?php

namespace TgWebValid\Entities;

use PHPUnit\Framework\TestCase;
use TgWebValid\Entities\InitData\Chat;
use TgWebValid\Entities\InitData\Receiver;
use TgWebValid\Entities\InitData\User;

class InitDataTest extends TestCase
{
    /**
     * @return array<string, int|string|bool>
     */
    public function testMake(): array
    {
        $data = [
            'auth_date' => 1676806993,
            'hash'      => 'c158d0819528b8106b95ec27e1073d367cbd1d4c8988c5dac8512799a4cb60ae'
        ];

        $initData = new InitData($data);

        $this->assertEquals($data['auth_date'], $initData->authDate);
        $this->assertEquals($data['hash'], $initData->hash);
        $this->assertNull($initData->user);
        $this->assertNull($initData->receiver);
        $this->assertNull($initData->chat);
        $this->assertNull($initData->queryId);
        $this->assertNull($initData->startParam);
        $this->assertNull($initData->canSendAfter);

        return $data;
    }

    /**
     * @depends testMake
     * @param array<string, int|string|bool> $data
     */
    public function testMakeUser(array $data): void
    {
        $data['user'] = json_encode([]);

        $initData = new InitData($data);

        $this->assertInstanceOf(User::class, $initData->user);
    }

    /**
     * @depends testMake
     * @param array<string, int|string|bool> $data
     */
    public function testMakeReceiver(array $data): void
    {
        $data['receiver'] = json_encode([]);

        $initData = new InitData($data);

        $this->assertInstanceOf(Receiver::class, $initData->receiver);
    }

    /**
     * @depends testMake
     * @param array<string, int|string|bool> $data
     */
    public function testMakeChat(array $data): void
    {
        $data['chat'] = json_encode([]);

        $initData = new InitData($data);

        $this->assertInstanceOf(Chat::class, $initData->chat);
    }

    /**
     * @depends testMake
     * @param array<string, int|string|bool> $data
     */
    public function testMakeFull(array $data): void
    {
        $data['query_id']       = 'AAE5gYJAAAAAADmBgkBAeZUJ';
        $data['start_param']    = 'start';
        $data['can_send_after'] = 300;

        $initData = new InitData($data);

        $this->assertEquals($data['query_id'], $initData->queryId);
        $this->assertEquals($data['start_param'], $initData->startParam);
        $this->assertEquals($data['can_send_after'], $initData->canSendAfter);
    }
}
