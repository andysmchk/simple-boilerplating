<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Collector;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\Collector\InputParameterCollector;
use Rewsam\SimpleBoilerplating\Collector\ReactorInputParameterCollectorDecorator;
use Rewsam\SimpleBoilerplating\Input\InputReactor;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBags;

/**
 * @covers \Rewsam\SimpleBoilerplating\Collector\ReactorInputParameterCollectorDecorator
 */
class ReactorInputParameterCollectorDecoratorTest extends TestCase
{
    use ProphecyTrait;

    protected ObjectProphecy $collector;

    protected ObjectProphecy $reactor;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->collector = $this->prophesize(InputParameterCollector::class);
        $this->reactor = $this->prophesize(InputReactor::class);
    }

    public function testCollect(): void
    {
        $bag = $this->prophesize(ParametersBag::class)->reveal();
        $bags = new ParametersBags();
        $bags->add($bag);
        $this->collector->collect()->willReturn($bags);
        $this->reactor->supports($bag)->willReturn(true)->shouldBeCalledOnce();
        $this->reactor->react($bag)->shouldBeCalledOnce();

        $sut = new ReactorInputParameterCollectorDecorator($this->collector->reveal(), $this->reactor->reveal());
        self::assertSame($bags, $sut->collect());
    }
}
