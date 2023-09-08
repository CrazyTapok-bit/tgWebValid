<?php

namespace TgWebValid\Test\Entities\InitData;

use PHPUnit\Framework\TestCase;
use TgWebValid\Entities\InitData\User;
use TgWebValid\Support\Arrayable;

final class UserTest extends TestCase
{
    /**
     * @return array<string, int|string>
     */
    public function testMake(): array
    {
        $data = [
            'id'         => 1082294585,
            'first_name' => 'Сергій'
        ];

        $user = new User($data);

        $this->assertEquals($data['id'], $user->id);
        $this->assertEquals($data['first_name'], $user->firstName);
        $this->assertNull($user->isBot);
        $this->assertNull($user->lastName);
        $this->assertNull($user->username);
        $this->assertNull($user->languageCode);
        $this->assertNull($user->isPremium);
        $this->assertNull($user->photoUrl);
        $this->assertNull($user->allowsWriteToPm);
        $this->assertInstanceOf(Arrayable::class, $user);

        return $data;
    }

    /**
     * @depends testMake
     * @param array<string, int|string> $data
     */
    public function testMakeFull(array $data): void
    {
        $data['is_bot']        = true;
        $data['last_name']     = 'Засадинський';
        $data['username']      = 'CrazyTapokUA';
        $data['language_code'] = 'uk';
        $data['is_premium']    = false;
        $data['allows_write_to_pm'] = true;
        $data['photo_url']     = 'https://t.me/i/userpic/320/7gMg9ZfoSzMQcLwYiEj4rLAofXXn0wOBV9HXGb6c1T0.jpg';

        $user = new User($data);

        $this->assertTrue($user->isBot);
        $this->assertEquals($data['last_name'], $user->lastName);
        $this->assertEquals($data['username'], $user->username);
        $this->assertEquals($data['language_code'], $user->languageCode);
        $this->assertFalse($user->isPremium);
        $this->assertEquals($data['photo_url'], $user->photoUrl);
        $this->assertTrue($user->allowsWriteToPm);
        $this->assertInstanceOf(Arrayable::class, $user);
    }
}
