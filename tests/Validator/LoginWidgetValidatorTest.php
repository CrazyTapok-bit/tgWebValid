<?php

namespace TgWebValid\Test\Validator;

use PHPUnit\Framework\TestCase;
use TgWebValid\Entities\LoginWidget;
use TgWebValid\Exceptions\ValidationException;
use TgWebValid\Validator\LoginWidgetValidator;

class LoginWidgetValidatorTest extends TestCase
{
    protected LoginWidgetValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new LoginWidgetValidator('5854973744:AAFnq4HoybEzqCJ-8HYHY_zlvkc_-H-kXq4');
    }

    public function testValidated(): void
    {
        $result = $this->validator->validate([
            'auth_date' => 1685117908,
            'first_name' => 'Сергій',
            'hash' => 'e286fe20edabc0f086ba11bad5eead92a67776d01ac97e814ddfb683974d16e9',
            'id' => 1082294585,
            'last_name' => 'Засадинський',
            'photo_url' => 'https://t.me/i/userpic/320/7gMg9ZfoSzMQcLwYiEj4rLAofXXn0wOBV9HXGb6c1T0.jpg',
            'username' => 'CrazyTapokUA'
        ]);

        $this->assertInstanceOf(LoginWidget::class, $result);
    }

    public function testFail(): void
    {
        $result = $this->validator->validate([
            'auth_date' => 1679130118,
            'first_name' => 'Сергій',
            'hash' => 'e286fe20edabc0f086ba11bad5eead92a67776d01ac97e814ddfb683974d16e9',
        ]);

        $this->assertFalse($result);
    }

    public function testException(): void
    {
        $this->validator = new LoginWidgetValidator('5854973744:AAFnq4HoybEzqCJ-8HYHY_zlvkc_-H-kXq4', true);

        $this->expectException(ValidationException::class);

        $this->validator->validate([
            'auth_date' => 1679130118,
            'first_name' => 'Сергій',
            'hash' => 'e286fe20edabc0f086ba11bad5eead92a67776d01ac97e814ddfb683974d16e9',
        ]);
    }

    public function testNoException(): void
    {
        $this->validator = new LoginWidgetValidator('5854973744:AAFnq4HoybEzqCJ-8HYHY_zlvkc_-H-kXq4', true);

        $result = $this->validator->validate([
            'auth_date' => 1685117908,
            'first_name' => 'Сергій',
            'hash' => 'e286fe20edabc0f086ba11bad5eead92a67776d01ac97e814ddfb683974d16e9',
            'id' => 1082294585,
            'last_name' => 'Засадинський',
            'photo_url' => 'https://t.me/i/userpic/320/7gMg9ZfoSzMQcLwYiEj4rLAofXXn0wOBV9HXGb6c1T0.jpg',
            'username' => 'CrazyTapokUA'
        ]);

        $this->assertInstanceOf(LoginWidget::class, $result);
    }
}
