<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Collector;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\Collector\SymfonyConsoleQuestionHelperAdapter;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

/**
 * @covers \Rewsam\SimpleBoilerplating\Collector\SymfonyConsoleQuestionHelperAdapter
 */
class SymfonyConsoleQuestionHelperAdapterTest extends TestCase
{
    use ProphecyTrait;

    protected ObjectProphecy $questionHelper;

    protected ObjectProphecy $input;

    /**
     * @var OutputInterface|ObjectProphecy
     */
    protected $output;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->questionHelper = $this->prophesize(QuestionHelper::class);
        $this->input = $this->prophesize(InputInterface::class);
        $this->output = $this->prophesize(OutputInterface::class);
    }

    public function testAsk(): void
    {
        $question = new Question('test');
        $input = $this->input->reveal();
        $output = $this->output->reveal();
        $this->questionHelper->ask($input, $output, $question)->willReturn('test');

        $sut = new SymfonyConsoleQuestionHelperAdapter($this->questionHelper->reveal(), $input, $output);
        self::assertSame('test', $sut->ask($question));
    }
}
