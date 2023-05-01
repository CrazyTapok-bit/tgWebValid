<?php

namespace TgWebValid\Test;

use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    public function testCamelize()
    {
        $this->assertEquals('', camelize(''));
        $this->assertEquals('snakeCase', camelize('snake_case'));
    }
}
