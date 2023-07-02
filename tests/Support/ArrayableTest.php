<?php

namespace TgWebValid\Test\Support;

use PHPUnit\Framework\TestCase;
use stdClass;
use TgWebValid\Make\Make;
use TgWebValid\Support\Arrayable;

final class ArrayableTest extends TestCase
{

    public function testEmpty(): void
    {
        $arrayable = new class extends Arrayable {};
        $this->assertEmpty($arrayable->toArray());
    }

    public function testPropertyInitialization(): void
    {
        $arrayable = new class extends Arrayable
        {
            public int $id;
            public string $firstName = '';
            public ?string $lastName;
            public ?string $username = null;
            // @phpstan-ignore-next-line
            public $languageCode = null;
            public bool $isPremium;
            // @phpstan-ignore-next-line
            public $photoUrl;
        };

        $this->assertEquals([
            'id' => null,
            'firstName' => '',
            'lastName' => null,
            'username' => null,
            'languageCode' => null,
            'isPremium' => null,
            'photoUrl' => null
        ], $arrayable->toArray());
    }

    public function testPropertyAccess(): void
    {
        $arrayable = new class extends Arrayable
        {
            public int $id;
            // @phpstan-ignore-next-line
            protected $firstName;
            // @phpstan-ignore-next-line
            private ?string $lastName = null;
        };

        $this->assertEquals([
            'id' => null
        ], $arrayable->toArray());
    }

    public function testPropertyDeep(): object
    {
        $user = new class ($this->createStdClass()) extends Make
        {
            public int $id;
            public string $firstName = 'Сергій';
            public function __construct(
                public stdClass $stdClass
            )
            {
            }
        };

        $initData = new class ($user) extends Make
        {
            public ?string $queryId = null;
            public function __construct(
                public object $user
            )
            {
            }
        };

        $arrayable = new class ($initData) extends Arrayable
        {
            public function __construct(
                public object $initData
            )
            {
            }
        };

        $this->assertEquals([
            'initData'  => [
                'queryId' => null,
                'user' => [
                    'id' => null,
                    'firstName' => 'Сергій',
                    'stdClass' => $this->createStdClass()
                ]
            ]
        ], $arrayable->toArray());

        return $arrayable;
    }

    /**
     * @depends testPropertyDeep
     */
    public function testAlien(object $object): void
    {
        $arrayable = new class extends Arrayable {};
        $this->assertEquals([
            'initData'  => [
                'queryId' => null,
                'user' => [
                    'id' => null,
                    'firstName' => 'Сергій',
                    'stdClass' => $this->createStdClass()
                ]
            ]
        ], $arrayable->toArray($object));
    }

    public function createStdClass(): stdClass
    {
        $stdClass = new stdClass;
        $stdClass->field = 'test';
        return $stdClass;
    }
}
