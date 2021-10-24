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

    /**
     * @var Constraint|ObjectProphecy
     */
    protected $constraint;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->constraint = $this->prophesize(Constraint::class);
    }

    public function test__construct(): void
    {
        $values = [$this->constraint->reveal()];

        $sut = new Constraints(...$values);

        self::assertSame($values, iterator_to_array($sut));
    }
}
