<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\Collector\InputParameterCollector;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBags;
use Rewsam\SimpleBoilerplating\Template\Template;
use Rewsam\SimpleBoilerplating\Template\TemplateBuilder;
use Rewsam\SimpleBoilerplating\TemplateWriter;
use Rewsam\SimpleBoilerplating\Templating;
use Rewsam\SimpleBoilerplating\Writer\Writer;

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
     * @var Writer|ObjectProphecy
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
        $this->writer = $this->prophesize(Writer::class);
        $this->builder = $this->prophesize(TemplateBuilder::class);
    }

    public function testRun(): void
    {
        $values = ['key' => 'val'];
        $bags = new ParametersBags();
        $bag = $this->prophesize(ParametersBag::class);
        $bag->all()->willReturn($values)->shouldBeCalledOnce();
        $bag = $bag->reveal();
        $bags->add($bag);
        $this->collector->collect()->willReturn($bags)->shouldBeCalled();
        $template = $this->prophesize(Template::class);
        $writer = $this->writer->reveal();
        $template->write($writer);
        $template = $template->reveal();
        $this->builder->build(Argument::that(static function ($arg) use ($values) {
            return $arg->all() === $values;
        }))->willReturn($template)->shouldBeCalled();
        $sut = new Templating($this->collector->reveal(), new TemplateWriter($writer), $this->builder->reveal());
        $sut->run();
    }
}
