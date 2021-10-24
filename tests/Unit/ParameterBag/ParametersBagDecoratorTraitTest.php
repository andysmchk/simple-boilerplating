<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\ParameterBag;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBagDecoratorTrait;

/**
 * @covers \Rewsam\SimpleBoilerplating\ParameterBag\ParametersBagDecoratorTrait
 */
class ParametersBagDecoratorTraitTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var ParametersBag|ObjectProphecy
     */
    private $bag;

    public function setUp(): void
    {
        parent::setUp();

        $this->bag = $this->prophesize(ParametersBag::class);
    }

    public function testSet(): void
    {
        $key = 'test';
        $value = 'value';
        $this->bag->set($key, $value)->shouldBeCalledOnce();
        $sut = $this->createInstance();
        $sut->set($key, $value);
    }

    public function testAll(): void
    {
        $this->bag->all()->shouldBeCalledOnce();
        $sut = $this->createInstance();
        $sut->all();
    }

    public function testGet(): void
    {
        $key = 'test';
        $this->bag->get($key)->shouldBeCalledOnce();
        $sut = $this->createInstance();
        $sut->get($key);
    }

    public function testHas(): void
    {
        $key = 'test';
        $this->bag->has($key)->shouldBeCalledOnce();
        $sut = $this->createInstance();
        $sut->has($key);
    }

    public function testMerge(): void
    {
        $merge = $this->prophesize(ParametersBag::class)->reveal();
        $this->bag->merge($merge)->shouldBeCalledOnce();
        $sut = $this->createInstance();
        $sut->merge($merge);
    }

    private function createInstance()
    {
        return new class($this->bag->reveal()) {
            use ParametersBagDecoratorTrait;

            public function __construct(ParametersBag $parametersBag)
            {
                $this->setBag($parametersBag);
            }
        };
    }
}
