<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Input;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\Input\Constraints;
use Symfony\Component\Validator\Constraint;

/**
 * @covers \Rewsam\SimpleBoilerplating\Input\Constraints
 */
class ConstraintsTest extends TestCase
{
    use ProphecyTrait;

    public function testCollectionConstruct(): void
    {
        $values = [$this->createValue(), $this->createValue()];

        $stub = new Constraints(...$values);

        self::assertSame($values, iterator_to_array($stub));
    }

    private function createValue(): Constraint
    {
        return $this->prophesize(Constraint::class)->reveal();
    }
}
