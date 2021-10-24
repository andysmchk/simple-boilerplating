<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Input;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\Input\Input;
use Rewsam\SimpleBoilerplating\Input\InputBagFactory;
use Rewsam\SimpleBoilerplating\Input\InputRequirement;
use Rewsam\SimpleBoilerplating\Input\Inputs;

/**
 * @covers \Rewsam\SimpleBoilerplating\Input\Inputs
 */
class InputsTest extends TestCase
{
    use ProphecyTrait;

    public function testAdd(): void
    {
        $requirement = $this->prophesize(InputRequirement::class)->reveal();
        $bagFactory = $this->prophesize(InputBagFactory::class)->reveal();

        $values = [
            new Input($requirement, $bagFactory),
            new Input($requirement, $bagFactory),
            new Input($requirement, $bagFactory),
        ];

        $sut = new Inputs();
        $new = $sut->add(...$values);

        self::assertSame($values, iterator_to_array($new));
        self::assertSame([], iterator_to_array($sut));
    }
}
