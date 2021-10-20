<?php

namespace Rewsam\SimpleBoilerplating;

use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;

interface RenderAdapter
{
    public function renderTemplate(string $path, ParametersBag $parametersBag): string;

    public function renderString(string $template, ParametersBag $parametersBag): string;
}