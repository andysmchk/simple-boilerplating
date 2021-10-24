<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\Collector\InputParameterCollector;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBags;
use Rewsam\SimpleBoilerplating\Template\Template;
use Rewsam\SimpleBoilerplating\TemplateWriter;
use Rewsam\SimpleBoilerplating\Template\TemplateBuilder;
use Rewsam\SimpleBoilerplating\Templating;

/**
 * @covers \Rewsam\SimpleBoilerplating\Templating
 */
class TemplatingTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var InputParameterCollector|ObjectProphecy
     */
    protected $collector;

    /**
     * @var TemplateWriter|ObjectProphecy
     */
    protected $writer;

    /**
     * @var TemplateBuilder|ObjectProphecy
     */
    protected $builder;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->collector = $this->prophesize(InputParameterCollector::class);
        $this->writer = $this->prophesize(TemplateWriter::class);
        $this->builder = $this->prophesize(TemplateBuilder::class);
    }

    public function testRun(): void
    {
        $bags = $this->prophesize(ParametersBags::class);
        $bag = $this->prophesize(ParametersBag::class)->reveal();
        $bags->toSingle()->willReturn($bag);
        $bags = $bags->reveal();
        $this->collector->collect()->willReturn($bags)->shouldBeCalled();
        $template = $this->prophesize(Template::class)->reveal();
        $this->builder->build($bag)->willReturn($template)->shouldBeCalled();
        $this->writer->write($template)->shouldBeCalled();
        $sut = new Templating($this->collector->reveal(), $this->writer->reveal(), $this->builder->reveal());
        $sut->run();
    }
}
