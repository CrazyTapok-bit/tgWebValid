<?php

namespace TgWebValid\Test;

use PHPUnit\Framework\TestCase;
use TgWebValid\Bot;
use TgWebValid\Exceptions\ValidationException;

final class BotTest extends TestCase
{
    protected string $initData = 'query_id=AAE5gYJAAAAAADmBgkD7IagW&user=%7B%22id%22%3A1082294585%2C%22first_name%22%3A%22%D0%A1%D0%B5%D1%80%D0%B3%D1%96%D0%B9%22%2C%22last_name%22%3A%22%D0%97%D0%B0%D1%81%D0%B0%D0%B4%D0%B8%D0%BD%D1%81%D1%8C%D0%BA%D0%B8%D0%B9%22%2C%22username%22%3A%22CrazyTapokUA%22%2C%22language_code%22%3A%22uk%22%7D&auth_date=1684086610&hash=f0f336451c74fc794e2b0b9fcaf3e27e16ca74afbfd0958a8d21efd9e8e2b53c';

    protected Bot $validator;

    public function setUp(): void
    {
        $this->validator = new Bot('5854973744:AAFnq4HoybEzqCJ-8HYHY_zlvkc_-H-kXq4');
    }

    public function testGlobalExceptionInitData(): void
    {
        $validator = new Bot('5854973744:AAFnq4HoybEzqCJ-8HYHY_zlvkc_-H-kXq4', true);

        $this->expectException(ValidationException::class);
        $validator->validateInitData($this->initData . '1');
    }

    public function testGlobalNoExceptionInitData(): void
    {
        $result = $this->validator->validateInitData($this->initData . '1');
        $this->assertFalse($result);
    }

    public function testGlobalExceptionLoginWidget(): void
    {
        $validator = new Bot('5854973744:AAFnq4HoybEzqCJ-8HYHY_zlvkc_-H-kXq4', true);

        $this->expectException(ValidationException::class);
        $validator->validateLoginWidget([]);
    }

    public function testGlobalNoExceptionLoginWidget(): void
    {
        $result = $this->validator->validateLoginWidget([]);
        $this->assertFalse($result);
    }

    public function testLocalExceptionInitData(): void
    {
        $this->expectException(ValidationException::class);
        $this->validator->validateInitData($this->initData . '1', true);
    }

    public function testLocalNoExceptionInitData(): void
    {
        $result = $this->validator->validateInitData($this->initData . '1', false);
        $this->assertFalse($result);
    }

    public function testLocalExceptionLoginWidget(): void
    {
        $this->expectException(ValidationException::class);
        $this->validator->validateLoginWidget([], true);
    }

    public function testLocalNoExceptionLoginWidget(): void
    {
        $result = $this->validator->validateLoginWidget([], false);
        $this->assertFalse($result);
    }

    public function testChangeGlobalNoExceptionInitData(): void
    {
        $validator = new Bot('5854973744:AAFnq4HoybEzqCJ-8HYHY_zlvkc_-H-kXq4', true);
        $result = $validator->validateInitData($this->initData . '1', false);
        $this->assertFalse($result);
    }

    public function testChangeGlobalNoExceptionLoginWidget(): void
    {
        $validator = new Bot('5854973744:AAFnq4HoybEzqCJ-8HYHY_zlvkc_-H-kXq4', true);
        $result = $validator->validateLoginWidget([], false);
        $this->assertFalse($result);
    }
}
