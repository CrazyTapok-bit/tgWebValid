<?php

namespace TgWebValid\Test\Entities\InitData;

use PHPUnit\Framework\TestCase;
use TgWebValid\Entities\InitData\Receiver;

class ReceiverTest extends TestCase
{
    /**
     * @return array<string, int|string>
     */
    public function testMake(): array
    {
        $data = [
            'id'         => 123456789,
            'first_name' => 'Сергій'
        ];

        $receiver = new Receiver($data);

        $this->assertEquals($data['id'], $receiver->id);
        $this->assertEquals($data['first_name'], $receiver->firstName);

        return $data;
    }

    /**
     * @depends testMake
     * @param array<string, int|string> $data
     */
    public function testMakeFull(array $data): void
    {
        $data['is_bot']     = false;
        $data['last_name']  = 'Засадинський';
        $data['username']   = 'CrazyTapokUA';
        $data['is_premium'] = true;
        $data['photo_url']  = 'https://t.me/i/userpic/320/7gMg9ZfoSzMQcLwYiEj4rLAofXXn0wOBV9HXGb6c1T0.jpg';

        $receiver = new Receiver($data);

        $this->assertFalse($receiver->isBot);
        $this->assertEquals($data['last_name'], $receiver->lastName);
        $this->assertEquals($data['username'], $receiver->username);
        $this->assertTrue($receiver->isPremium);
        $this->assertEquals($data['photo_url'], $receiver->photoUrl);
    }
}
