<?php

namespace TgWebValid\Test\Entities\InitData;

use PHPUnit\Framework\TestCase;
use TgWebValid\Entities\InitData\Receiver;

class ReceiverTest extends TestCase
{
    public function testMake()
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
     */
    public function testMakeFull(array $data)
    {
        $data['is_bot']     = false;
        $data['last_name']  = 'Засадинський';
        $data['username']   = 'CrazyTapokUA';
        $data['is_premium'] = true;
        $data['photo_url']  = 'https://t.me/i/userpic/320/7gMg9ZfoSzMQcLwYiEj4rLAofXXn0wOBV9HXGb6c1T0.jpg';

        $receiver = new Receiver($data);

        $this->assertFalse($data['is_bot'], $receiver->isBot);
        $this->assertEquals($data['last_name'], $receiver->lastName);
        $this->assertEquals($data['username'], $receiver->username);
        $this->assertTrue($data['is_premium'], $receiver->isPremium);
        $this->assertEquals($data['photo_url'], $receiver->photoUrl);
    }
}
