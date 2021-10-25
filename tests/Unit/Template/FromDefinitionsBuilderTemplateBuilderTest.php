<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Template;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;
use Rewsam\SimpleBoilerplating\Template\FromDefinitionsTemplateBuilder;
use Rewsam\SimpleBoilerplating\Template\Template;
use Rewsam\SimpleBoilerplating\Template\TemplateAggregate;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinition;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitions;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitionsBuilder;
use Rewsam\SimpleBoilerplating\Template\FromDefinitionsBuilderTemplateBuilder;
use Rewsam\SimpleBoilerplating\Template\TemplateFactory;

/**
 * @covers \Rewsam\SimpleBoilerplating\Template\FromDefinitionsBuilderTemplateBuilder
 */
class FromDefinitionsBuilderTemplateBuilderTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var TemplateFactory|ObjectProphecy
     */
    protected $factory;

    /**
     * @var TemplateDefinitionsBuilder|ObjectProphecy
     */
    protected $definitions;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->factory = $this->prophesize(TemplateFactory::class);
        $this->definitions = $this->prophesize(TemplateDefinitionsBuilder::class);
    }


    public function testBuild(): void
    {
        $parameterBag = $this->prophesize(ParametersBag::class)->reveal();
        $definitionsCollection = new TemplateDefinitions();
        $this->definitions->build()->willReturn($definitionsCollection)->shouldBeCalledOnce();
        $sut = new FromDefinitionsBuilderTemplateBuilder($this->factory->reveal(), $this->definitions->reveal());
        $template = $sut->build($parameterBag);
        self::assertInstanceOf(TemplateAggregate::class, $template);
    }
}
