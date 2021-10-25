<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Collector;

use ArrayObject;
use BadMethodCallException;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\Collector\SymfonySimpleValidationResult;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * @covers \Rewsam\SimpleBoilerplating\Collector\SymfonySimpleValidationResult
 */
class SymfonySimpleValidationResultTest extends TestCase
{
    use ProphecyTrait;

    public function testGetMultilineMessage(): void
    {
        $violations = [];
        $violation = $this->prophesize(ConstraintViolationInterface::class);
        $violation->getMessage()->shouldBeCalledOnce()->willReturn('test');
        $violations[] = $violation->reveal();

        $violation = $this->prophesize(ConstraintViolationInterface::class);
        $violation->getMessage()->shouldBeCalledOnce()->willReturn('test');
        $violations[] = $violation->reveal();

        $violationList = new class($violations) extends ArrayObject implements ConstraintViolationListInterface {

            public function add(ConstraintViolationInterface $violation)
            {
                throw new BadMethodCallException('Not expected');
            }

            public function addAll(ConstraintViolationListInterface $otherList)
            {
                throw new BadMethodCallException('Not expected');
            }

            public function get($offset)
            {
                throw new BadMethodCallException('Not expected');
            }

            public function has($offset)
            {
                throw new BadMethodCallException('Not expected');
            }

            public function set($offset, ConstraintViolationInterface $violation)
            {
                throw new BadMethodCallException('Not expected');
            }

            public function remove($offset)
            {
                throw new BadMethodCallException('Not expected');
            }
        };

        $sut = new SymfonySimpleValidationResult($violationList);

        self::assertSame("test\ntest", $sut->getMultilineMessage());
    }
}
