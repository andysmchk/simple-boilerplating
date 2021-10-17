<?php

namespace Rewsam\SimpleBoilerplating;

class TemplateFactory
{
    /**
     * @var ParametrisedRender
     */
    private $render;

    public function __construct(ParametrisedRender $render)
    {
        $this->render = $render;
    }

    public function create(TemplateDefinition $definition): Template
    {
        $content = $this->render->renderTemplate($definition->getSourcePath());
        $destination = $this->render->renderString($definition->getDestinationPath());
        $mode = $definition->getMode();

        switch ($mode) {
            case AppendTemplate::TYPE:
                return new AppendTemplate($destination, $content);
            case DumpTemplate::TYPE:
                return new DumpTemplate($destination, $content);
            default:
                throw new \InvalidArgumentException("Template mode $mode is not supported");
        }
    }
}