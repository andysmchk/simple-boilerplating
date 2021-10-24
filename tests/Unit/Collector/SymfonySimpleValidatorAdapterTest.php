<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Collector;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\Collector\SymfonySimpleValidatorAdapter;
use Rewsam\SimpleBoilerplating\Input\Constraints;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @covers \Rewsam\SimpleBoilerplating\Collector\SymfonySimpleValidatorAdapter
 */
class SymfonySimpleValidatorAdapterTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var ValidatorInterface|ObjectProphecy
     */
    protected $validator;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = $this->prophesize(ValidatorInterface::class);
    }

    public function testValidate(): void
    {
        $value = 'test';

        $this->validator->validate($value, Argument::type('array'))
            ->willReturn($this->prophesize(ConstraintViolationListInterface::class)->reveal())
            ->shouldBeCalledOnce();
        $sut = new SymfonySimpleValidatorAdapter($this->validator->reveal());
        $sut->validate($value, new Constraints());
    }
}
