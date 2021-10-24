<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Template;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;
use Rewsam\SimpleBoilerplating\Template\Template;
use Rewsam\SimpleBoilerplating\Template\TemplateBuilder;
use Rewsam\SimpleBoilerplating\Template\TemplateBuilderComposite;
use Rewsam\SimpleBoilerplating\Writer\Writer;

/**
 * @covers \Rewsam\SimpleBoilerplating\Template\TemplateBuilderComposite
 */
class TemplateBuilderCompositeTest extends TestCase
{
    use ProphecyTrait;

    public function testBuild(): void
    {
        $sut = new TemplateBuilderComposite();
        $parameterBag = $this->prophesize(ParametersBag::class)->reveal();

        $writer = $this->prophesize(Writer::class)->reveal();

        $template = $this->prophesize(Template::class);
        $template->write($writer)->shouldBeCalledOnce();
        $builder = $this->prophesize(TemplateBuilder::class);
        $builder->build($parameterBag)->shouldBeCalled()->willReturn($template->reveal());
        $sut->add($builder->reveal());

        $template = $sut->build($parameterBag);
        $template->write($writer);
    }
}
