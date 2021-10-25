<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\TemplateDefinition;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitions;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitionsBuilder;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitionsBuilderComposite;

/**
 * @covers \Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitionsBuilderComposite
 */
class TemplateDefinitionsBuilderCompositeTest extends TestCase
{
    use ProphecyTrait;

    public function testBuild(): void
    {
        $sut = new TemplateDefinitionsBuilderComposite();

        $builder = $this->prophesize(TemplateDefinitionsBuilder::class);
        $definitions = new TemplateDefinitions();
        $builder->build()->shouldBeCalled()->willReturn($definitions);
        $sut->addBuilder($builder->reveal());
        $definitions = $sut->build();
    }
}
