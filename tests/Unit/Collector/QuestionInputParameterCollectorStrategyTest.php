<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Collector;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\Collector\QuestionHelperAdapter;
use Rewsam\SimpleBoilerplating\Collector\QuestionInputParameterCollectorStrategy;
use Rewsam\SimpleBoilerplating\Collector\SimpleValidationResult;
use Rewsam\SimpleBoilerplating\Collector\SimpleValidatorAdapter;
use Rewsam\SimpleBoilerplating\Input\Constraints;
use Rewsam\SimpleBoilerplating\Input\InputParameterDefinition;
use Symfony\Component\Console\Question\Question;

/**
 * @covers \Rewsam\SimpleBoilerplating\Collector\QuestionInputParameterCollectorStrategy
 */
class QuestionInputParameterCollectorStrategyTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var QuestionHelperAdapter|ObjectProphecy
     */
    protected $questionHelper;

    /**
     * @var SimpleValidatorAdapter|ObjectProphecy
     */
    protected $validation;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->questionHelper = $this->prophesize(QuestionHelperAdapter::class);
        $this->validation = $this->prophesize(SimpleValidatorAdapter::class);
    }

    public function testFetch(): void
    {
        $value = 'answer';
        $this->questionHelper->ask(Argument::type(Question::class))->willReturn($value);

        $sut = new QuestionInputParameterCollectorStrategy($this->questionHelper->reveal(), $this->validation->reveal());
        $template = $this->prophesize(InputParameterDefinition::class);
        $template->getDescription()->willReturn('Test');

        self::assertSame($value, $sut->fetch($template->reveal()));
    }

    public function testValidatorValid(): void
    {
        $value = 'answer';
        $constraints = new Constraints();

        $validationResult = $this->prophesize(SimpleValidationResult::class);
        $validationResult->getMultilineMessage()->willReturn('');
        $this->validation->validate($value, $constraints)->willReturn($validationResult->reveal());

        $this->questionHelper->ask(Argument::any())->will(function ($args) use ($value) {
            $args[0]->getValidator()($value);

            return $value;
        });

        $template = $this->prophesize(InputParameterDefinition::class);
        $template->getDescription()->willReturn('Test');
        $template->getConstraints()->willReturn(new Constraints);
        $sut = new QuestionInputParameterCollectorStrategy($this->questionHelper->reveal(), $this->validation->reveal());

        self::assertSame($value, $sut->fetch($template->reveal()));
    }

    public function testValidatorInvalid(): void
    {
        $this->expectErrorMessage('error');

        $value = 'answer';
        $constraints = new Constraints();

        $validationResult = $this->prophesize(SimpleValidationResult::class);
        $validationResult->getMultilineMessage()->willReturn('error');
        $this->validation->validate($value, $constraints)->willReturn($validationResult->reveal());

        $this->questionHelper->ask(Argument::any())->will(function ($args) use ($value) {
            $args[0]->getValidator()($value);

            return $value;
        });

        $template = $this->prophesize(InputParameterDefinition::class);
        $template->getDescription()->willReturn('Test');
        $template->getConstraints()->willReturn(new Constraints);
        $sut = new QuestionInputParameterCollectorStrategy($this->questionHelper->reveal(), $this->validation->reveal());

        self::assertSame($value, $sut->fetch($template->reveal()));
    }
}
