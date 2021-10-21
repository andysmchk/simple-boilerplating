<?php

namespace Rewsam\SimpleBoilerplating\Template;

use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;

interface TemplateBuilder
{
    public function build(ParametersBag $bag): Template;
}