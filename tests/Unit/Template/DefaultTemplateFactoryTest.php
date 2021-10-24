<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Template;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;
use Rewsam\SimpleBoilerplating\Render\RenderAdapter;
use Rewsam\SimpleBoilerplating\Template\DefaultTemplateFactory;
use Rewsam\SimpleBoilerplating\Template\Template;
use Rewsam\SimpleBoilerplating\Template\TemplateTypeFactory;
use Rewsam\SimpleBoilerplating\Template\TemplateTypeFactoryRegistry;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinition;

/**
 * @covers \Rewsam\SimpleBoilerplating\Template\DefaultTemplateFactory
 */
class DefaultTemplateFactoryTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var RenderAdapter|ObjectProphecy
     */
    protected $render;

    /**
     * @var TemplateTypeFactoryRegistry|ObjectProphecy
     */
    protected $factoryRegistry;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->render = $this->prophesize(RenderAdapter::class);
        $this->factoryRegistry = $this->prophesize(TemplateTypeFactoryRegistry::class);
    }

    public function testCreate(): void
    {
        $source = 'src';
        $destination = 'dst';
        $mode = 'mode';
        $definition = new TemplateDefinition($source, $destination, $mode);
        $bag = $this->prophesize(ParametersBag::class)->reveal();

        $content = 'txt';
        $this->render->renderTemplate($source, $bag)->willReturn($content)->shouldBeCalledOnce();
        $destinationPath = 'dst/path';
        $this->render->renderString($destination, $bag)->willReturn($destinationPath)->shouldBeCalledOnce();
        $factory = $this->prophesize(TemplateTypeFactory::class);
        $template = $this->prophesize(Template::class)->reveal();
        $factory->create($destinationPath, $content)->willReturn($template)->shouldBeCalledOnce();
        $this->factoryRegistry->get($definition->getMode())->willReturn($factory->reveal())->shouldBeCalledOnce();

        $sut = new DefaultTemplateFactory($this->render->reveal(), $this->factoryRegistry->reveal());
        self::assertSame($template, $sut->create($definition, $bag));
    }
}
