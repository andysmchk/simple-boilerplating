<?php

namespace Rewsam\SimpleBoilerplating\Template;

use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;

/**
 * @codeCoverageIgnore
 */
interface TemplateBuilder
{
    public function build(ParametersBag $bag): Template;
}