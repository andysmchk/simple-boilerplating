<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\ParameterBag;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBags;

/**
 * @covers \Rewsam\SimpleBoilerplating\ParameterBag\ParametersBags
 */
class ParametersBagsTest extends TestCase
{
    use ProphecyTrait;

    public function testAdd(): void
    {
        $sut = new ParametersBags();

        $values = [
            $this->prophesize(ParametersBag::class)->reveal(),
            $this->prophesize(ParametersBag::class)->reveal(),
            $this->prophesize(ParametersBag::class)->reveal(),
        ];

        $sut->add(...$values);
        self::assertSame($values, iterator_to_array($sut));
    }

    public function testToSingle(): void
    {
        $sut = new ParametersBags();

        $values = [];

        $bag = $this->prophesize(ParametersBag::class);
        $value = ['first' => 'first val'];
        $values = array_merge($values, $value);
        $bag->all()->willReturn($value);
        $sut->add($bag->reveal());

        $bag = $this->prophesize(ParametersBag::class);
        $value = ['second' => 'second val'];
        $values = array_merge($values, $value);
        $bag->all()->willReturn($value);
        $sut->add($bag->reveal());

        self::assertSame($values, $sut->toSingle()->all());
    }
}
