<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Writer;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\Writer\SymfonyConsoleOutputWriterDecorator;
use Rewsam\SimpleBoilerplating\Writer\Writer;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @covers \Rewsam\SimpleBoilerplating\Writer\SymfonyConsoleOutputWriterDecorator
 */
class SymfonyConsoleOutputWriterDecoratorTest extends TestCase
{
    use ProphecyTrait;

    protected ObjectProphecy $subject;

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

        $this->subject = $this->prophesize(Writer::class);
        $this->output = $this->prophesize(OutputInterface::class);
    }

    public function testExists(): void
    {
        $destination = 'test';
        $this->subject->exists($destination)->shouldBeCalled()->willReturn(true);
        $sut = new SymfonyConsoleOutputWriterDecorator($this->subject->reveal(), $this->output->reveal());
        self::assertTrue($sut->exists($destination));
    }

    public function testDump(): void
    {
        $destination = 'test';
        $content = 'lorem';
        $this->subject->dump($destination, $content)->shouldBeCalled();
        $sut = new SymfonyConsoleOutputWriterDecorator($this->subject->reveal(), $this->output->reveal());
        $sut->dump($destination, $content);
    }

    public function testAppend(): void
    {
        $destination = 'test';
        $content = 'lorem';
        $this->subject->append($destination, $content)->shouldBeCalled();
        $sut = new SymfonyConsoleOutputWriterDecorator($this->subject->reveal(), $this->output->reveal());
        $sut->append($destination, $content);
    }
}
