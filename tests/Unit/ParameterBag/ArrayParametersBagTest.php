<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\ParameterBag;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\ParameterBag\ArrayParametersBag;

/**
 * @covers \Rewsam\SimpleBoilerplating\ParameterBag\ArrayParametersBag
 */
class ArrayParametersBagTest extends TestCase
{
    use ProphecyTrait;

    public function testSetGet(): void
    {
        $sut = new ArrayParametersBag();
        $sut->set('Key', 'Value');

        self::assertSame('Value', $sut->get('Key'));
    }

    public function testAll(): void
    {
        $data = [
            'key' => 'val',
            'key1' => 'val1',
            'key2' => 'val2',
        ];

        $sut = new ArrayParametersBag();

        foreach ($data as $key => $val) {
            $sut->set($key, $val);
        }

        self::assertSame($data, $sut->all());
    }

    public function testHas(): void
    {
        $sut = new ArrayParametersBag();
        $sut->set('Key', 'Value');

        self::assertTrue($sut->has('Key'));
    }

    public function testMerge(): void
    {
        $data = [
            'key' => 'val',
            'key1' => 'val1',
            'key2' => 'val2',
        ];
        $first = new ArrayParametersBag();

        foreach ($data as $key => $val) {
            $first->set($key, $val);
        }
        $second = new ArrayParametersBag();
        $second->set('second', 'val');
        $second->merge($first);
        $second->set('second1', 'val1');

        self::assertSame($data, $first->all());
        self::assertSame([
            'second' => 'val',
            'key' => 'val',
            'key1' => 'val1',
            'key2' => 'val2',
            'second1' => 'val1',
        ], $second->all());
    }
}
