<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Input;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\Input\InputParameterDefinition;
use Rewsam\SimpleBoilerplating\Input\InputParameterDefinitions;

/**
 * @covers \Rewsam\SimpleBoilerplating\Input\InputParameterDefinitions
 */
class InputParameterDefinitionsTest extends TestCase
{
    use ProphecyTrait;

    public function testAdd(): void
    {
        $values = [$this->prophesize(InputParameterDefinition::class)->reveal()];

        $sut = new InputParameterDefinitions();
        $sut->add(...$values);

        self::assertSame($values, iterator_to_array($sut));
    }
}
