<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Template;

use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;

/**
 * @codeCoverageIgnore
 */
interface TemplateBuilder
{
    public function build(ParametersBag $bag): Template;
}