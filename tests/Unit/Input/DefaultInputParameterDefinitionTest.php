<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Input;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\Input\DefaultInputParameterDefinition;
use Symfony\Component\Validator\Constraint;

/**
 * @covers \Rewsam\SimpleBoilerplating\Input\DefaultInputParameterDefinition
 */
class DefaultInputParameterDefinitionTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $description;

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

        $this->key = '42';
        $this->description = '42';
        $this->constraint = $this->prophesize(Constraint::class);
    }

    public function testGetters(): void
    {
        $constraint = $this->constraint->reveal();
        $sut = new DefaultInputParameterDefinition($this->key, $this->description, $constraint);
        self::assertSame($this->key, $sut->getKey());
        self::assertSame($this->description, $sut->getDescription());

        foreach ($sut->getConstraints() as $item) {
            self::assertSame($constraint, $item);
        }
    }
}
