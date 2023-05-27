<?php

namespace TgWebValid\Test\Validator;

use PHPUnit\Framework\TestCase;
use TgWebValid\Validator\Validator;

final class ValidatorTest extends TestCase
{
    protected Validator $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new class ('') extends Validator {};
    }

    /**
     * @return array<int, string>
     */
    public function testPrepare(): array
    {
        $data = [
            'first_name' => 'Сергій',
            'auth_date'  => 1679130118,
            'id'         => 1082294585,
            'hash'       => '93f1016f2891b100c6f5be101b62dcc840e1f11a7cf18bb4ba6db9cae69b45ad',
            'last_name'  => 'Засадинський',
            'username'   => 'CrazyTapokUA',
            'photo_url'  => 'https://t.me/i/userpic/320/7gMg9ZfoSzMQcLwYiEj4rLAofXXn0wOBV9HXGb6c1T0.jpg'
        ];

        $prepared = $this->validator->prepare($data);

        $this->assertEquals([
            'first_name=Сергій',
            'auth_date=1679130118',
            'id=1082294585',
            'hash=93f1016f2891b100c6f5be101b62dcc840e1f11a7cf18bb4ba6db9cae69b45ad',
            'last_name=Засадинський',
            'username=CrazyTapokUA',
            'photo_url=https://t.me/i/userpic/320/7gMg9ZfoSzMQcLwYiEj4rLAofXXn0wOBV9HXGb6c1T0.jpg'
        ], $prepared);

        return $prepared;
    }

    /**
     * @depends testPrepare
     * @param array<int, string> $prepared
     * @return array<int, string>
     */
    public function testSort(array $prepared): array
    {
        $sorted = $this->validator->sort($prepared);

        $this->assertEquals([
            'auth_date=1679130118',
            'first_name=Сергій',
            'hash=93f1016f2891b100c6f5be101b62dcc840e1f11a7cf18bb4ba6db9cae69b45ad',
            'id=1082294585',
            'last_name=Засадинський',
            'photo_url=https://t.me/i/userpic/320/7gMg9ZfoSzMQcLwYiEj4rLAofXXn0wOBV9HXGb6c1T0.jpg',
            'username=CrazyTapokUA'
        ], $sorted);

        return $sorted;
    }

    /**
     * @depends testSort
     * @param array<int, string> $sorted
     * @return array<int, string>
     */
    public function testRidHash(array $sorted): array
    {
        $withoutHash = $this->validator->ridHash($sorted);

        $this->assertEquals([
            'auth_date=1679130118',
            'first_name=Сергій',
            'id=1082294585',
            'last_name=Засадинський',
            'photo_url=https://t.me/i/userpic/320/7gMg9ZfoSzMQcLwYiEj4rLAofXXn0wOBV9HXGb6c1T0.jpg',
            'username=CrazyTapokUA'
        ], $withoutHash);

        return $withoutHash;
    }

    /**
     * @depends testRidHash
     * @param array<int, string> $withoutHash
     */
    public function testImplode(array $withoutHash): void
    {
        $imploded = $this->validator->implode($withoutHash);

        $this->assertEquals(implode("\n", $withoutHash), $imploded);
    }

    public function testMatchHash(): void
    {
        $hash = '93f1016f2891b100c6f5be101b62dcc840e1f11a7cf18bb4ba6db9cae69b45ad';

        $this->assertTrue($this->validator->matchHash($hash, $hash));
        $this->assertFalse($this->validator->matchHash($hash, ''));
    }
}
