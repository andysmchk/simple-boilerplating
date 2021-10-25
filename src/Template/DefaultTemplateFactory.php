<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Template;

use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;
use Rewsam\SimpleBoilerplating\Render\RenderAdapter;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinition;

final class DefaultTemplateFactory implements TemplateFactory
{
    public function __construct(
        private RenderAdapter $render,
        private TemplateTypeFactoryRegistry $factoryRegistry
    ) {}

    public function create(TemplateDefinition $definition, ParametersBag $bag): Template
    {
        $content = $this->render->renderTemplate($definition->getSourcePath(), $bag);
        $destination = $this->render->renderString($definition->getDestinationPath(), $bag);
        $factory = $this->factoryRegistry->get($definition->getMode());

        return $factory->create($destination, $content);
    }
}