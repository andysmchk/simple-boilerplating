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

    public function testCollectionKeepValues(): void
    {
        $values = [$this->createValue(), $this->createValue()];
        $stub = new Inputs();
        $new = $stub->add(...$values);

        self::assertSame($values, iterator_to_array($new));
    }

    public function testCollectionIsImmutable(): void
    {
        $stub = new Inputs();
        $stub->add($this->createValue());

        self::assertSame([], iterator_to_array($stub));
    }

    public function testCollectionConstruct(): void
    {
        $values = [$this->createValue(), $this->createValue()];

        $stub = new Inputs(...$values);

        self::assertSame($values, iterator_to_array($stub));
    }

    private function createValue(): Input
    {
        return new Input($this->prophesize(InputRequirement::class)->reveal(), $this->prophesize(InputBagFactory::class)->reveal());
    }
}
