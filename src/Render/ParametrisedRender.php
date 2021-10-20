<?php

namespace Rewsam\SimpleBoilerplating\Render;

use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;

final class ParametrisedRender implements Render
{
    /**
     * @var RenderAdapter
     */
    private $render;
    /**
     * @var ParametersBag
     */
    private $parametersBag;

    public function __construct(RenderAdapter $render, ParametersBag $parametersBag)
    {
        $this->render = $render;
        $this->parametersBag = $parametersBag;
    }

    public function renderTemplate(string $path): string
    {
        return $this->render->renderTemplate($path, $this->parametersBag);
    }

    public function renderString(string $template): string
    {
        return $this->render->renderString($template, $this->parametersBag);
    }
}