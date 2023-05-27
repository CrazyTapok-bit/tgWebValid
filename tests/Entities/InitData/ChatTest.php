<?php

namespace TgWebValid\Test\Entities\InitData;

use PHPUnit\Framework\TestCase;
use TgWebValid\Entities\InitData\Chat;

class ChatTest extends TestCase
{
    /**
     * @return array<string, int|string>
     */
    public function testMake(): array
    {
        $data = [
            'id'    => 123456789,
            'type'  => 'supergroup',
            'title' => 'Chat title'
        ];

        $chat = new Chat($data);

        $this->assertEquals($data['id'], $chat->id);
        $this->assertEquals($data['type'], $chat->type);
        $this->assertEquals($data['title'], $chat->title);
        $this->assertNull($chat->username);
        $this->assertNull($chat->photoUrl);

        return $data;
    }

    /**
     * @depends testMake
     * @param array<string, int|string> $data
     */
    public function testMakeFull(array $data): void
    {
        $data['username']  = 'CrazyTapokUA';
        $data['photo_url'] = 'https://t.me/i/userpic/320/7gMg9ZfoSzMQcLwYiEj4rLAofXXn0wOBV9HXGb6c1T0.jpg';

        $chat = new Chat($data);

        $this->assertEquals($data['username'], $chat->username);
        $this->assertEquals($data['photo_url'], $chat->photoUrl);
    }
}
