<?php

namespace Rewsam\SimpleBoilerplating\Template;

use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinition;

/**
 * @codeCoverageIgnore
 */
interface TemplateFactory
{
    public function create(TemplateDefinition $definition, ParametersBag $bag): Template;
}