<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Input;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\Input\AbstractInputOperator;
use Rewsam\SimpleBoilerplating\ParameterBag\ArrayParametersBag;

/**
 * @covers \Rewsam\SimpleBoilerplating\Input\AbstractInputOperator
 */
class AbstractInputOperatorTest extends TestCase
{
    use ProphecyTrait;

    public function testInstantiateBag(): void
    {
        $sut = $this->getMockBuilder(AbstractInputOperator::class)
            ->setConstructorArgs([])
            ->getMockForAbstractClass();

        self::assertInstanceOf(ArrayParametersBag::class, $sut->instantiateBag());
    }
}
