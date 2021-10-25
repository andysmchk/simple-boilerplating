<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Input;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\Input\Input;
use Rewsam\SimpleBoilerplating\Input\InputBagFactory;
use Rewsam\SimpleBoilerplating\Input\InputRequirement;

/**
 * @covers \Rewsam\SimpleBoilerplating\Input\Input
 */
class InputTest extends TestCase
{
    use ProphecyTrait;

    protected object $inputRequirement;

    protected object $inputBagFactory;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->inputRequirement = $this->prophesize(InputRequirement::class)->reveal();
        $this->inputBagFactory = $this->prophesize(InputBagFactory::class)->reveal();
    }

    public function testGetInputRequirement(): void
    {
        $sut = new Input($this->inputRequirement, $this->inputBagFactory);
        self::assertSame($this->inputRequirement, $sut->getInputRequirement());
    }

    public function testGetInputBagFactory(): void
    {
        $sut = new Input($this->inputRequirement, $this->inputBagFactory);
        self::assertSame($this->inputBagFactory, $sut->getInputBagFactory());
    }
}
