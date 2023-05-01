<?php

namespace TgWebValid\Test\Entities;

use PHPUnit\Framework\TestCase;
use TgWebValid\Entities\LoginWidget;

class LoginWidgetTest extends TestCase
{
    public function testMake()
    {
        $data = [
            'auth_date'  => 1679130118,
            'first_name' => 'Сергій',
            'hash'       => '93f1016f2891b100c6f5be101b62dcc840e1f11a7cf18bb4ba6db9cae69b45ad',
            'id'         => 1082294585,
        ];

        $loginWidget = new LoginWidget($data);

        $this->assertEquals($data['auth_date'], $loginWidget->authDate);
        $this->assertEquals($data['first_name'], $loginWidget->firstName);
        $this->assertEquals($data['hash'], $loginWidget->hash);
        $this->assertEquals($data['id'], $loginWidget->id);
        $this->assertNull($loginWidget->lastName);
        $this->assertNull($loginWidget->photoUrl);
        $this->assertNull($loginWidget->username);

        return $data;
    }

    /**
     * @depends testMake
     */
    public function testMakeFull(array $data)
    {
        $data['last_name'] = 'Засадинський';
        $data['photo_url'] = 'https://t.me/i/userpic/320/7gMg9ZfoSzMQcLwYiEj4rLAofXXn0wOBV9HXGb6c1T0.jpg';
        $data['username']  = 'CrazyTapokUA';

        $loginWidget = new LoginWidget($data);

        $this->assertEquals($data['last_name'], $loginWidget->lastName);
        $this->assertEquals($data['photo_url'], $loginWidget->photoUrl);
        $this->assertEquals($data['username'], $loginWidget->username);
    }
}
