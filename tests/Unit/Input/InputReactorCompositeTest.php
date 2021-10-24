<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Input;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\Input\InputReactor;
use Rewsam\SimpleBoilerplating\Input\InputReactorComposite;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;

/**
 * @covers \Rewsam\SimpleBoilerplating\Input\InputReactorComposite
 */
class InputReactorCompositeTest extends TestCase
{
    use ProphecyTrait;

    public function testReact(): void
    {
        $bag = $this->prophesize(ParametersBag::class)->reveal();
        $sut = new InputReactorComposite();

        $reactor = $this->prophesize(InputReactor::class);
        $reactor->supports($bag)->shouldBeCalled()->willReturn(true);
        $sut->add($reactor->reveal());
        $reactor->react($bag)->shouldBeCalled();

        $reactor = $this->prophesize(InputReactor::class);
        $reactor->supports($bag)->shouldBeCalled()->willReturn(true);
        $reactor->react($bag)->shouldBeCalled();
        $sut->add($reactor->reveal());

        $sut->react($bag);
    }

    public function testSupports(): void
    {
        $bag = $this->prophesize(ParametersBag::class)->reveal();
        $sut = new InputReactorComposite();

        $reactor = $this->prophesize(InputReactor::class);
        $reactor->supports($bag)->shouldBeCalled()->willReturn(false);
        $sut->add($reactor->reveal());

        $reactor = $this->prophesize(InputReactor::class);
        $reactor->supports($bag)->shouldBeCalled()->willReturn(true);
        $sut->add($reactor->reveal());

        self::assertTrue($sut->supports($bag));
    }
}
