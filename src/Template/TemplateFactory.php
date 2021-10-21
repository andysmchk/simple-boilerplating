<?php

namespace Rewsam\SimpleBoilerplating\Template;

use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;
use Rewsam\SimpleBoilerplating\Render\RenderAdapter;

final class TemplateFactory
{
    /**
     * @var RenderAdapter
     */
    private $render;
    /**
     * @var TemplateTypeFactoryRegistry
     */
    private $factoryRegistry;

    public function __construct(RenderAdapter $render, TemplateTypeFactoryRegistry $factoryRegistry)
    {
        $this->render = $render;
        $this->factoryRegistry = $factoryRegistry;
    }

    public function create(TemplateDefinition $definition, ParametersBag $bag): Template
    {
        $content = $this->render->renderTemplate($definition->getSourcePath(), $bag);
        $destination = $this->render->renderString($definition->getDestinationPath(), $bag);
        $factory = $this->factoryRegistry->get($definition->getMode());

        return $factory->create($destination, $content);
    }
}