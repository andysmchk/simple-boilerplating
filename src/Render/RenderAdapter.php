<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Render;

use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;

/**
 * @codeCoverageIgnore
 */
interface RenderAdapter
{
    public function renderTemplate(string $path, ParametersBag $parametersBag): string;

    public function renderString(string $template, ParametersBag $parametersBag): string;
}