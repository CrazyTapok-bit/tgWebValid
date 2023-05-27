<?php

namespace TgWebValid\Test;

use PHPUnit\Framework\TestCase;

final class HelpersTest extends TestCase
{
    public function testCamelize(): void
    {
        $this->assertEquals('', camelize(''));
        $this->assertEquals('snakeCase', camelize('snake_case'));
        $this->assertEquals('snakeCase', camelize('snAke_CaSe'));
        $this->assertEquals('snakeCase', camelize('_snAke__CaSe_'));
    }
}
