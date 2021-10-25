<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Template;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;
use Rewsam\SimpleBoilerplating\Template\Template;
use Rewsam\SimpleBoilerplating\Template\TemplateAggregate;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinition;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitions;
use Rewsam\SimpleBoilerplating\Template\FromDefinitionsTemplateBuilder;
use Rewsam\SimpleBoilerplating\Template\TemplateFactory;
use Rewsam\SimpleBoilerplating\Writer\Writer;

/**
 * @covers \Rewsam\SimpleBoilerplating\Template\FromDefinitionsTemplateBuilder
 */
class FromDefinitionsTemplateBuilderTest extends TestCase
{
    use ProphecyTrait;

    public function testBuild(): void
    {
        $factory = $this->prophesize(TemplateFactory::class);

        $parameterBag = $this->prophesize(ParametersBag::class)->reveal();

        $definition = new TemplateDefinition('src', 'dsr', 'mode');
        $template = $this->prophesize(Template::class);
        //$writer = $this->prophesize(Writer::class)->reveal();
        //$template->write($writer)->shouldBeCalledOnce();
        $factory->create($definition, $parameterBag)
            ->shouldBeCalled()
            ->willReturn($template->reveal());

        $definitions = new TemplateDefinitions();
        $definitions->add($definition);

        $sut = new FromDefinitionsTemplateBuilder($factory->reveal(), $definitions);
        $template = $sut->build($parameterBag);
        self::assertInstanceOf(TemplateAggregate::class, $template);
        //$template->write($writer);
    }
}
